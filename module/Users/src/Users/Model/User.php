<?php
namespace Users\Model;
class User{
  public $id;
  public $name;
  public $email;
  public $password;

  //assign md5 enc to store password in db
  public function setPassword($clr_pass){
    $this->password = md5($clr_pass);
  }

  public function exchangeArray($data){
    $this->name = (isset($data['name']))?$data['name'] : null;
    $this->email = (isset($data['email']))?$data['email'] : null;
    if (isset($data['password']))
      $this->setPassword($data['password']);
  }
}
?>
