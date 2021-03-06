<?php

class Register extends Controller {

  public function __construct($controller, $action){
    parent::__construct($controller,$action);
    $this->load_model('Users');
    $this->view->setLayout('default');
  }

  public function loginAction(){
      $validation = new Validate();
      if ($_POST) {
        //form validations
        $validation->check($_POST, [
          'username'=>[
            'display' => "Username",
            'required' => true
          ],
          'password'=>[
            'display' => 'Password',
            'required' => true,
            'min' => 6
          ]
        ]);
        if ($validation->passed()) {
            $user = $this->UsersModel->findByUsername($_POST['username']);
            if ($user && password_verify(Input::get('password'), $user->password)) {
                $rememberMe = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;
                $user->login($rememberMe);
                Router::redirect('');
            }
        } else {
           $validation->addError("There is an error with your username or password.");
        }
      }
      $this->view->displayErrors = $validation->display_errors();
      $this->view->render('register/login');
  }
  public function logoutAction(){
     if (currentUser()) {
         currentUser()->logout();
     }
  }
  public function registerAction(){
    $validation = new Validate();
    $posted_values = ['firstname'=>'', 'lastname'=>'','email'=>'', 'username'=>'','password'=>'','confirm'=>''];
    if ($_POST) {
       $posted_values = posted_values($_POST);
       $validation->check($_POST, [
         'firstname' => [
           'display' => 'First Name',
           'required' => true
         ],
         'lastname' => [
           'display' => 'Last Name',
           'required' => true
         ],
         'username' => [
           'display' => 'Username',
           'required' => true,
           'unique' => 'users',
           'min' => 6,
           'max' => 150
         ],
         'email' => [
           'display' => 'Email',
           'required' => true,
           'unique' => 'users',
           'max' => 150,
           'valid_email' => true
         ],
         'password' => [
           'display' => 'Password',
           'required' => true,
           'min' => 6
         ],
         'confirm' => [
           'display' => 'Confirm password',
           'required' => true,
           'matches' => 'password'
         ],
       ]);
       if ($validation->passed()) {
          $newUser = new Users();
          $newUser->registerNewUser($_POST);
          $newUser->login();
          Router::redirect('');
       }
    }
    $this->view->post = $posted_values;
    $this->view->displayErrors = $validation->display_errors();
     $this->view->render('register/register');
  }

}
