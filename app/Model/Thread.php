<?php
App::uses('AppModel', 'Model');
/**
 * Thread Model
 *
 * @property Message $Message
 */
class Thread extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'thread_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'thread_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'message_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
