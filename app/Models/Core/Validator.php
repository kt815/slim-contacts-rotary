<?php

namespace Models\Core;

	class Validator {
		static $_true = true;
		static $_false = false;

		public static function checkName($str) {
			if (preg_match('/^[^\W|\d]{1}[\w\s]{2,11}$/u', $str))
				// && iconv_strlen($str,'UTF-8') > 3		
				return self::$_true;
			else
				return self::$_false;}

		public static function checkLastname($str) {
			if (preg_match('/^[^\W|\d]{1}[\w\s]{1,11}$/u', $str))
				return self::$_true;	
			else
				return self::$_false;}

		public static function checkEmail($str) {
			if(filter_var($str, FILTER_VALIDATE_EMAIL))
				return self::$_true;	
			else
				return self::$_false;}

		public static function checkPhone($str) {
			if (preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/", $str))
				return self::$_true;
			else
				return self::$_false;}

		public static function checkSubject($str) {
			if (iconv_strlen($str,'UTF-8') > 3)
				return self::$_true;
			else
				return self::$_false;}

		public static function checkMessage($str) {
			if (iconv_strlen($str,'UTF-8') > 10)
				return self::$_true;
			else
				return self::$_false;}
}