<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $full_name
 * @property string $email
 * @property string $password
 * @property string $facebook_id
 * @property string $google_id
 * @property string $twitter_id
 * @property string $key
 */
class User extends CActiveRecord
{
	public $_identity;
	public $rememberMe;
	public $verifyPassword;
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
			array('email, password, verifyPassword', 'required', 'on'=>'update'),
			array('verifyPassword', 'compare', 'on' => 'register', 'compareAttribute' => 'password'),
			array('email, password, key', 'length', 'max'=>255),
			array('full_name', 'length', 'max'=>128),
			array('facebook_id, google_id, twitter_id', 'length', 'max'=>20),
			array('email', 'email'),
			array('email', 'unique','on'=>'register'),
			array('rememberMe', 'boolean','on'=>'login'),
			// password needs to be authenticated
			array('password', 'authenticate','on'=>'login'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, password, full_name, facebook_id, created_at, google_id, twitter_id, key', 'safe', 'on'=>'search'),
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
			'id'=>Yii::t('app','user.id'),
			'full_name'=>Yii::t('app','user.full_name'),
			'email'=>Yii::t('app','user.email'),
			'password'=>Yii::t('app','user.password'),
			'facebook_id'=>Yii::t('app','user.facebook_id'),
			'google_id'=>Yii::t('app','user.google_id'),
			'twitter_id'=>Yii::t('app','user.twitter_id'),
			'key'=>Yii::t('app','user.key'),
			'created_at'=>Yii::t('app','user.created_at'),
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
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
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
	
	public function beforeSave()
	{
		if($this->isNewRecord)
		{
				$this->created_at = time();
		}
		return true;
	}

	public function afterSave()
	{
		if($this->isNewRecord)
		{
			Yii::app()->authManager->assign('user', $this->id);
		}
		$this->password = md5($this->password);
		$this->save();
		
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
