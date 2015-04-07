<?php
class UserIdentity extends CUserIdentity
{
    public $user;
    private $_id;
    
    public function authenticate()
    {
        $user = User::model()->findByAttributes(array(
            'email' => $this->username
        ));
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($user->password != $this->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $user->id;
            $this->setUser($user);
            $this->errorCode = self::ERROR_NONE;
        }
        unset($user);
        return !$this->errorCode;
    }
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function setUser(CActiveRecord $user)
    {
        $this->user = $user->attributes;
    }
    
    public function getId()
    {
        return $this->_id;
    }
    
}