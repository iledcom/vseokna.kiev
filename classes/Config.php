<?php
namespace Classes;
abstract class Config {

	//const SITENAME = "MyRusakov.ru";

	const ADDRESS = "http://vseokna.kiev";
	const ADM_NAME = "Коренев Константин";
	const ADM_EMAIL = "korenev@iled.com.ua";
	
	
	const DB_HOST = "localhost";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_NAME = "test_db";
	const CHARSET = "utf8";

	//const DB_PREFIX = "xyz_";
	//const DB_SYM_QUERY = "?";
	
	const DIR_CLASS = "/home/vseokna.kiev/classes/";
	//const DIR_IMG = "/images/";
	//const DIR_IMG_ARTICLES = "/images/articles/";
	//const DIR_AVATAR = "/images/avatars/";
	//const DIR_TMPL = "/home/vseokna.kiev/www/tmpl/";
	//const DIR_EMAILS = "/home/vseokna.kiev/www/tmpl/emails/";
	
	//const FILE_MESSAGES = "/home/mysite.local/www/text/messages.ini";
	
	const FORMAT_DATE = "%d.%m.%Y %H:%M:%S";
		
	//const DEFAULT_AVATAR = "default.png";
	//const MAX_SIZE_AVATAR = 51200;
}

?>