<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	/**
	 * Add in the DebugKit toolbar
	 */
	public $components = array('DebugKit.Toolbar');

	public function sendJsonp($data = array())
    {
        $this->autoRender = false;
        $this->response->type('json');
        $return = sprintf('%s(%s)', h($this->request->query('callback')), json_encode($data));
        $this->response->body($return);
    }
   public function sendReply( $msg, $payload=""){
      $this->autoRender = false; // no view to render
      $this->response->type('json');

      $reply = array(
           'message' => $msg,
           'success' => true,
           'version' => '0.1',
           'payload' => $payload
      );
      $ret = json_encode($reply);
      if ($ret == '[]'){
         $ret = json_encode(array('success'=>'false'));
      }  
	  if ( array_key_exists('callback', $this->request->query) ){
		$return = sprintf('%s(%s)', h($this->request->query('callback')), json_encode($ret));
        $this->response->body($return);
	  } else {
		$this->response->body( json_encode( $ret ));          
	  }
	   
   } 

   public function sendFail( $reason ){
		$this->autoRender = false; // no view to render
		$this->response->type('json');
		$reply = array(
			'message' => $reason,
			'success' => false,
			'version' => '0.1'
		);
		$ret = json_encode($reply);
		if ($ret == '[]'){
			$ret = json_encode(array('success'=>'false'));
		} 
		if ( array_key_exists('callback', $this->request->query) ){
			$return = sprintf('%s(%s)', h($this->request->query('callback')), json_encode($data));
			$this->response->body($return);
		} else {
			$this->response->body( json_encode( $ret ));          
		}
   }

}
