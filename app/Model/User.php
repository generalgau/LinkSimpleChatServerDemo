<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {


/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

	
	
	public $validate = array(
		'username' => array(
                        'unique' => array(
                            'rule' => 'isUnique',
                            'required' => 'create'
                        ),
		'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'password' => array(
			'at least 6 characters' => array(
				'rule' => array('minLength', '6'),
			),
		)
	);
}
