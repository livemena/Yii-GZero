<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property integer $gender
 * @property string $birth
 * @property string $facebook_id
 * @property string $google_id
 * @property string $twitter_id
 * @property string $key
 */
class User extends CActiveRecord
{

	public $name;
	public $verifyPassword;
	public $rememberMe;

	public $_identity;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password', 'required','on'=>'login'),
			array('email', 'required','on'=>'forgotPassword'),
			array('email, password, verifyPassword', 'required', 'on'=>'register'),
			array('gender', 'numerical', 'integerOnly'=>true),
			array('verifyPassword', 'compare', 'on' => 'register', 'compareAttribute' => 'password'),
			array('email, password, key', 'length', 'max'=>255),
			array('first_name, last_name', 'length', 'max'=>128),
			array('facebook_id, google_id, twitter_id', 'length', 'max'=>20),
			array('email', 'email'),
			array('email', 'unique','on'=>'register'),
			array('rememberMe', 'boolean','on'=>'login'),
			// password needs to be authenticated
			array('password', 'authenticate','on'=>'login'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, password, first_name, last_name, gender, birth, facebook_id, google_id, twitter_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'password' => 'Password',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'gender' => 'Gender',
			'birth' => 'Birth',
			'facebook_id' => 'Facebook',
			'google_id' => 'Google',
			'twitter_id' => 'Twitter',
			'name' => 'Name',
			'verifyPassword' => 'Confirm Password',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('birth',$this->birth,true);
		$criteria->compare('facebook_id',$this->facebook_id,true);
		$criteria->compare('google_id',$this->google_id,true);
		$criteria->compare('twitter_id',$this->twitter_id,true);
		$criteria->compare('key',$this->key,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->email,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect email or password.');
		}
	}
	
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->email,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}

	public function afterFind()
	{
		parent::afterFind();
		
		$this->name = $this->first_name.' '.$this->last_name;
	}
	
	public function beforeSave()
	{
		$this->password = md5($this->password);
		return true;
	}

	public function afterSave()
	{
		if($this->isNewRecord)
		{
			Yii::app()->authManager->assign('user', $this->id);
		}
		return true;
	}

	public function beforeDelete()
	{
		if($this->isNewRecord)
		{
			Yii::app()->authManager->revoke('user', $this->id);
		}
		return true;
	}
	
}
