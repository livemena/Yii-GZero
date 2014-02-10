<?php
class UserIdentity extends CUserIdentity
{
    private $_id;
    private $_email;
	
    public function authenticate()
    {
        $record=User::model()->findByAttributes(array('email'=>$this->email));
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password!==md5($this->password,$record->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$record->id;
            $this->setState('title', $record->title);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

	function getEmail(){
		$user = $this->loadUser(Yii::app()->user->id);
		if($user){
			$this->_email = $user->email; return $this->_email;
			}
		else{
			return 'none';
		}
	}

    public function getId()
    {
        return $this->_id;
    }
}