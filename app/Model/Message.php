<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *
 * @property Thread $Thread
 */
class Message extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'message_id';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'message_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Thread' => array(
			'className' => 'Thread',
			'foreignKey' => 'message_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
