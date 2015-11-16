<?php

class Constants {
	
  // Value constants (boolean)
  const VALUE_NO = 0;
  const VALUE_YES = 1;

  private static $_value = array(
		self::VALUE_NO => 'NO',
		self::VALUE_YES => 'YES',
  );
  private static $_value_ar = array(
		self::VALUE_NO => 'لا',
		self::VALUE_YES => 'نعم',
  );

  public static function getValue() {
		if (yii::app()->language == "ar") {
				return self::$_value_ar;
		}
		return self::$_value;
  }

  public static function value($id) {
		if (yii::app()->language == "ar") {
			if (isset(self::$_value_ar[$id]))
					return self::$_value_ar[$id];
			return '';
		}
		if (isset(self::$_value[$id]))
				return self::$_value[$id];
		return '';
  }
  
  // Gender constants
  const GENDER_MALE = 0;
  const GENDER_FEMALE = 1;

  private static $_gender = array(
      self::GENDER_MALE => 'Male',
      self::GENDER_FEMALE => 'Female',
  );
  private static $_gender_ar = array(
      self::GENDER_MALE => 'ذكر',
      self::GENDER_FEMALE => 'انثى',
  );

  public static function getGenders() {
      if (yii::app()->language == "ar") {
          return self::$_gender_ar;
      }
      return self::$_gender;
  }

  public static function gender($id) {
      if (yii::app()->language == "ar") {
          if (isset(self::$_gender_ar[$id]))
              return self::$_gender_ar[$id];
          return '';
      }
      if (isset(self::$_gender[$id]))
          return self::$_gender[$id];
      return '';
  }

}
