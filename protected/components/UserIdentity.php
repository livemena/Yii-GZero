<?php
class UserIdentity extends CUserIdentity
{
    public $_id;
    public $email;
    public $password;

 	/**
	 * Constructor.
	 * @param string $email email
	 * @param string $password password
	 */
	public function __construct($email,$password)
	{
		$this->email=$email;
		$this->password=$password;
	}
	
    public function authenticate()
    {
        $record=User::model()->findByAttributes(array('email'=>$this->email));
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password!==md5($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$record->id;
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
 
    public function getId(){
        return $this->_id;
    }
}