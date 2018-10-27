<?php

class Users extends Model{

  private $_isLoggedIn, $_sessionName, $_cookieName;
  public static $currentLoggedInUser = null;

  public function __construct($user = ''){
    $table = 'users';
    parent::__construct($table);
    $this->_sessionName = CURRENT_USER_SESSION_NAME;
    $this->_cookieName = REMEMBER_ME_COOKIE_NAME;
    $this->_softDelete = true;
    if ($user != '') {
       if (is_int($user)) {
         $u = $this->_db->findFirst('users',['conditions'=>'id = ?', 'bind' => [$user]]);
       }else {
         $u = $this->_db->findFirst('users',['conditions'=>'username = ?','bind'=>[$user]]);
       }
       if ($u) {
         foreach ($u as $key => $val) {
            $this->$key = $val;
         }
       }
    }
  }

  public function findByUsername($username){
    return $this->findFirst(['conditions'=>"username = ?",'bind'=>[$username]]);
  }
  public function login($rememberMe=false){
    Session::set($this->_sessionName, $this->id);
    if ($rememberMe) {
        $hash = md5(uniqid() + rand(0,100));
        $user_agent = Session::uagent_no_version();
        Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
        $fields = ['session'=>$hash,'user_agent'=>$user_agent, 'user_id' => $this->id];
        $this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?",[$this->id, $user_agent]);
        $this->_db->insert('user_sessions', $fields);
    }
  }
  public function logout(){
    $user_agent = Session::uagent_no_version();
    $this->_db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);
    Session::delete(CURRENT_USER_SESSION_NAME);
    if (Cookie::exist(REMEMBER_ME_COOKIE_NAME)) {
       Cookie::delete(REMEMBER_ME_COOKIE_NAME);
    }
    self::$currentLoggedInUser = null;
    return true;
  }
  public function registerNewUser($params){
    //$this->assign($params);
    $fields = ['firstname'=>$params['firstname'],'lastname'=>$params['lastname'], 'username' => $params['username'],'email'=>$params['email'],'password'=>password_hash($params['password'],PASSWORD_DEFAULT)];
    $this->_db->insert('users', $fields);
    //$this->password = password_hash($this->password, PASSWORD_DEFAULT);
    //$this->save();
  }

}
