<?php
namespace Users\Controller;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Users\Form\RegisterForm;

class LoginController extends AbstractActionController{
  public function getAuthService(){
    if (! isset($this->authService)){
      $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
      $dbTable = new DbTable($dbAdapter, 'user', 'email','password','MD5(?)');
      $authService = new AuthenticationService();
      $authService->setAdapter($dbTable);
      $this->authService = $authService;
    }
    return $this->authService;
  }

  public function processAction(){
    $this->getAuthService()->getAdapter()->setIdentity($this->request->getPost('email'))
                                      ->setCredential($this->request->getPost('password'));
    $result = $this->getAuthService()->authenticate();
    if ($result->isValid()){
      $this->getAuthService()->getStorage()->write($this->request->getPost('email'));
      return $this->redirect()->toRoute(NULL, array(
                                            'controller'=>'login',
                                            'action'=>'confirm'
                                          ));
    }
  }

  public function confirmAction(){
    $user = $this->getAuthService()->getStorage()->read();
    $viewModel = new ViewModel(array('user_email'=>$user));
    return $viewModel;
  }

  public function loginAction(){
    $form = new RegisterForm();
    $view = new ViewModel(array('form'=>$form));
    return $view;
  }
}
?>
