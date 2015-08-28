<?php
namespace Users\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Form\RegisterForm;

class IndexController extends AbstractActionController{

	public function indexAction(){
		$view = new ViewModel();
		$view->setVariables(array('mssg'=>'It Really works!!',
															'erroring'=>'this will say error!'
														));
		return $view;
	}
	public function newuserAction(){
		$view = new ViewModel();
		$view->setVariables(array('mssg'=>'Register Form!'));
		$view->setTemplate('users\index\new-user');
		return $view;
	}
	public function loginAction(){
		$form = new RegisterForm();
		$view = new ViewModel(array('form'=>$form));
		return $view;
		/*$view = new ViewModel();
			$view->setVariables(array('mssg'=>'Log-in Form!'));
		$view->setTemplate('users\index\login');
		return $view;*/
	}
}

?>
