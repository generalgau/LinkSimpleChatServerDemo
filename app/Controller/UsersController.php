<?php 
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

	public $components = array('Paginator', 'Cookie','RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
		$this->Auth->allow('loggedin','login','add');
    }

	public function logout() {
		$this->Auth->logout();
		$this->sendReply( "logout successful");
	}
	
	public function loggedin() {
		$username = $this->Auth->user('username');
		if ( $username !== null ) 
			$this->sendReply ( "Login ok", $username );
		else
			$this->sendFail ("Unable to fetch user. Sorry, try again later.");
		
	}

	public function login() {
		$this->Auth->logout();
		if ($this->request->is('ajax')){
			if ($this->Auth->login()) {
			  $this->sendReply( "Login ok", $this->Auth->user('username') ); 
			} else {
			  $this->sendFail( "Login failed.." ); 
			}   
		} 

		else if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect(
					array('controller' => 'threads', 'action' => "view")
				);
			} 
		}

	}
        
        

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			$this->Session->setFlash(__('Invalid user'));
			$this->set('user', null);
			return;
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
        if ($this->request->is('post')) {
        	$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('controller' => 'threads', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
            
		}
	}
}

