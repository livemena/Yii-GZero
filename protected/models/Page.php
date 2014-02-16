<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property integer $id
 * @property string $slug
 * @property string $title_en
 * @property string $title_ar
 * @property string $body_en
 * @property string $body_ar
 * @property string $created_at
 */
class Page extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	 
	public $title;
	public $body;
	 
	public function tableName()
	{
		return 'page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title_en', 'required'),
			array('slug, title_en, title_ar', 'length', 'max'=>128),
			array('body_ar, body_en', 'length', 'max'=>512),
			array('slug','unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, slug, title_en, title_ar, body_en, body_ar, created_at', 'safe', 'on'=>'search'),
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
			'slug' => 'Slug',
			'title_en' => 'Title En',
			'title_ar' => 'العنوان',
			'body_en' => 'Body En',
			'body_ar' => 'النص',
			'created_at' => Yii::t('app','created_at'),
		);
	}
	
	public function afterFind()
	{
		parent::afterFind();
		
		$this->title = $this->title_en;
		$this->body = $this->body_en;
		
		if(Yii::app()->language=='ar'){
			$this->title = $this->title_ar;
			$this->body = $this->body_ar;
		}
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
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('title_en',$this->title_en,true);
		$criteria->compare('title_ar',$this->title_ar,true);
		$criteria->compare('body_en',$this->body_en,true);
		$criteria->compare('body_ar',$this->body_ar,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Page the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
