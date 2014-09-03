<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 */
class MessagesController extends AppController {

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
		$this->Message->recursive = 0;
		$this->set('messages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
       		if ($this->request->is('get')) {
                        if (
                                array_key_exists("message_id", $this->request->data) &&
                                $this->request->data['message_id'] > 0
                        ){
                                $options = array(
                                        'conditions' => array('Message.' . $this->Message->primaryKey => $message_id),
                                        'recursive' => 2
                                );
                                $out = $this->Message->find('first', $options);
                                if ($out){
                                        $this->sendReply( "message", $out);
                                } else {
                                        $this->sendFail( "message fetch failed" );
                                }
                        }
                }
                else {		
			if (!$this->Message->exists($id)) {
				throw new NotFoundException(__('Invalid message'));
			}
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->set('message', $this->Message->find('first', $options));
		}
	}

	public function lastsynchok(){

		 if ($this->request->is('get')) {
                        if (
                                array_key_exists("thread_id", $this->request->data) &&
                                $this->request->data['thread_id'] > 0
                        ){
                                $this->Thread->id = $this->request->data['thread_id'];
                                $this->Thread->saveField('lastsyncmsgid', $this->request->data['lastsyncmsgid']); 
                                $this->sendReply( "lastsyncmsgid", $this->Thread);
                        }
                }
	}

/**
 * add method
 *
 * @return void
 */

	public function add( ) {
		if ($this->request->is('get') {
			if ( array_key_exists("special", $this->request->data['Message'])){
				$special = $this->request->data['Message'];
				if ( $special > 0 && $special < 1000){
			    		for ($i=0; $i < $special; $i++){
        	        			$this->request->data['Message'] = array(
							'thread_id' => 7,
							'msg_from' => "seth",
							'msg_to' => "ilya",
	                        			'message' => "test".$i
				  		);
						$this->Message->create();
                	        		$this->Message->save($this->request->data);
					}
				} 
			} else
                        if ( 	array_key_exists("thread_id", $this->request->data['Message']) &&
	                        $this->request->data['Message']['thread_id'] > 0
        	        ){
                	        $this->Message->create();
                        	if ($this->Message->save($this->request->data)){
                                	$m = $this->Message->find("first", array(
                                        	'conditions' => array(
                                                	'message_id' => $this->Message->getLastInsertId()                       )
	                                ));
        	                        $this->sendReply("msg saved", $m );
                	        }
                        	else
	                                $this->sendFail("couldn't save msg");
                	}
		} else {
			if ($this->request->is('post')) {
				$this->Message->create();
				if ($this->Message->save($this->request->data)) {
					$this->Session->setFlash(__('The message has been saved.'));
					//return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The message could not be saved. Please, try again.'));
				}
			}
		}
		$threads = $this->Message->Thread->find('list');
		$this->set(compact('threads'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
		}
		$threads = $this->Message->Thread->find('list');
		$this->set(compact('threads'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if ($this->request->is('get') {
                        if ( array_key_exists("special", $this->request->data['Message'])){
				$this->Message->deleteAll( array( 'message_id < ' => 58 ));
				// do I need to reset the lastsync?
                    	}    
		} else {
			$this->Message->id = $id;
			if (!$this->Message->exists()) {
				throw new NotFoundException(__('Invalid message'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->Message->delete()) {
				$this->Session->setFlash(__('The message has been deleted.'));
			} else {
				$this->Session->setFlash(__('The message could not be deleted. Please, try again.'));
			}
			return $this->redirect(array('action' => 'index'));
		}
	}
