<?php
App::uses('AppController', 'Controller');
/**
 * Threads Controller
 *
 * @property Thread $Thread
 * @property PaginatorComponent $Paginator
 */
class ThreadsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ($this->request->is('get') &&  isset ($this->request->query['callback']) ) {
                        $options = array(
                                'contain' => array (
                                        'Message' => array (
                                                'conditions' => array (
                                                        "OR" => array (
                                                                'Message.msg_to' => $this->Auth->user('username'),
                                                                'Message.msg_from' => $this->Auth->user('username')
                                                        )
                                                )
                                        )
                                ),
                                'recursive' => 1
                        );
                        $out = $this->Thread->find('all', $options);
                        //debug ($out);
                        if ($out){
				// need to put messages inside of threads
 		
                                for ($i = 0; $i < count ($out); $i++){
 					$out[$i]['thread_id'] = $out[$i]['Thread']['thread_id'];
					$out[$i]['thread_user1'] = $out[$i]['Thread']['thread_user1'];
					$out[$i]['thread_user2'] = $out[$i]['Thread']['thread_user2'];
					$out[$i]['created'] = $out[$i]['Thread']['created'];
					$out[$i]['modified'] = $out[$i]['Thread']['modified'];
					unset ($out[$i]['Thread']);
				}
                                //debug ( $out );
		
                                $this->sendReply( "thread data", $out);

                        } else {
                                $this->sendFail( "thread fetch failed" );
                        }
                } else {
			$this->Thread->recursive = 0;
			$this->set('threads', $this->Paginator->paginate());
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null ) {
		if ( array_key_exists("thread_id", $this->request->data) && 
                     $this->request->data['thread_id'] > 0 
                ){
			$out = $this->Thread->find('first', array(
				'conditions' => array(
					'Thread.thread_id' => $this->request->data["thread_id"],
				),
				'recursive' => 1
			));
			if ( $out['Thread']['lastsyncmsgid'] > 0 ){
                                $lastmsg = $out['Thread']['lastsyncmsgid'];
				$msgs = sizeof ( $out['Message'] );
				for ($i = 0; $i <= $msgs ; $i++){
					if ( $out['Message'][$i]['message_id'] < $lastmsg ){
						unset ( $out['Message'][$i] );
					}
				}
				$out['Message'] = array_values( $out['Message'] );
                        }
			debug (  $out  );
                        if ($out){
                                $this->sendReply( "thread data", $out);
                        } else {
                                $this->sendFail( "thread fetch failed" );
                        }
                }
                else {
			if (!$this->Thread->exists($id)) {
				throw new NotFoundException(__('Invalid thread'));
			}
			$options = array('conditions' => array('Thread.' . $this->Thread->primaryKey => $id));
			$this->set('thread', $this->Thread->find('first', $options));
		}
	}

	public function lastsynchok(){
		if (
                        array_key_exists('thread_id', $this->request->data ) &&
                        $this->request->data['thread_id'] > 0 &&
                        array_key_exists('lastsyncmsgid', $this->request->data) &&
			$this->request->data['lastsyncmsgid'] > 0
                ){
			$t = $this->request->data['thread_id'];
			$this->Thread->id = $t;
			
			if ( $this->Thread->saveField('lastsyncmsgid', $this->request->data['lastsyncmsgid']) ) {
				$this->sendReply("lastsyncmsgid", $this->request->data['lastsyncmsgid']);
			} else
				$this->sendFail( "can't save lastsyncmsgid" );
			
                } else
			$this->sendFail( "unable to process" );
        }

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Thread->create();
			if ($this->Thread->save($this->request->data)) {
				$this->Session->setFlash(__('The thread has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The thread could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Thread->exists($id)) {
			throw new NotFoundException(__('Invalid thread'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Thread->save($this->request->data)) {
				$this->Session->setFlash(__('The thread has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The thread could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Thread.' . $this->Thread->primaryKey => $id));
			$this->request->data = $this->Thread->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Thread->id = $id;
		if (!$this->Thread->exists()) {
			throw new NotFoundException(__('Invalid thread'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Thread->delete()) {
			$this->Session->setFlash(__('The thread has been deleted.'));
		} else {
			$this->Session->setFlash(__('The thread could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
