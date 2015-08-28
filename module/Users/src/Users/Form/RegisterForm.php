<?php
namespace Users\Form;

use Zend\Form\Form;

class RegisterForm extends Form{
	public function __construct($name=null){
		parent::__construct('Register');
		$this->setAttribute('method', 'post');
		$this->setAttribute('enctype', 'multipart/form-data');
		$this->add(array(
			'name'=>'name',
			'type'=>'text',
			'options'=>array('label'=>'Full Name'),
		));
		$this->add(array(
			'name'=>'email',
			'type'=>'email',
			'options'=>array('label'=>'Email'),
			'attributes'=>array('required'=>'required'),
			'filters'=>array('name'=>'StringTrim'),
			'validators'=>array(
				array('name'=>'EmailAddress','options'=>array(
					'messages'=>array(
						\Zend\Validator\EmailAddress::INVALID_FORMAT=>'Email invalid')))
			)
		));
		$this->add(array(
			'name'=>'password',
			'type'=>'password',
			'attributes'=>array('required'=>'required'),
			'options'=>array('label'=>'Password'),
		));
		$this->add(array(
			'name'=>'confirm',
			'type'=>'password',
			'attributes'=>array('required'=>'required'),
			'options'=>array('label'=>'Confirm Password'),
		));
		$this->add(array(
			'name'=>'submit', 
			'options'=>array('label'=>'submit'),
			'attributes'=>array(
				'type'=>'submit',
				'value'=>'Register',
			),
		));
	}
}