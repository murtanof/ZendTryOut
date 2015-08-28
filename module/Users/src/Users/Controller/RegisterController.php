<?php
namespace Users\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Form\RegisterForm;
use Users\Form\RegisterFilter;
use Users\Model\User;
use Users\Model\UserTable;

class RegisterController extends AbstractActionController{
	public function indexAction(){
		$form = new RegisterForm();
		$view = new ViewModel(array('form'=>$form, 'test'=>'this is a test'));
		return $view;
	}
	public function confirmAction(){
		$view = new ViewModel();
		return $view;
	}
	public function processAction(){
		if (!$this->request->isPost()){
			return $this->redirect()->toRoute(null, array('controller'=>'register','action'=>'index'));
		}
		$post=$this->request->getPost();
		$form = new RegisterForm();
		$inputFilter = new RegisterFilter();
		$form->setinputfilter($inputFilter);
		$form->setdata($post);
		if (!$form->isvalid()){
			$model = new ViewModel(array('error'=>true, 'form'=>$form));
			$model->setTemplate('users/register/index');
			return $model;
		}
		//ddd($form->getData());
		$this->createUser($form->getData());
		return $this->redirect()->toRoute(null,array('controller'=>'register','action'=>'confirm'));
	}
	protected function createUser(array $data){
		$sm = $this->getServiceLocator();
		$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		// ddd($dbAdapter->getdriver()->getconnection()->isconnected());
		$resultPrototype = new \Zend\Db\ResultSet\ResultSet();
		$tableGateway = new \Zend\Db\TableGateway\TableGateway('user', $dbAdapter,
			null, $resultPrototype);
		$user = new User();
		$user->exchangeArray($data);
		//ddd($tableGateway);
		$usrTable = new UserTable($tableGateway);
		$usrTable->saveUser($user);
		return true;
	}
}
?>
