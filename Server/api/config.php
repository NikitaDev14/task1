<?php
	define('DEFAULT_RESPONSE_FORMAT', 'json'); // available: json, xml, html, txt

	/*                                 //for GFL server
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'user10');
	define('DB_USER', 'user10');
	define('DB_PASS', 'tuser10');
	define('CLASSNAME_POS_IN_REQUEST', 5);
	*/                                 //for home server
	define('DB_NAME', 'car_shop');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '1234');
	define('CLASSNAME_POS_IN_REQUEST', 5);

	define('NAME_TEMPLATE', '/[A-Za-z\- ]{3,}/');
	define('EMAIL_TEMPLATE', '/[0-9a-z_]+@[0-9a-z_]+\\.[a-z]{1,3}/i');
	define('PASSWORD_TEMPLATE', '/.{4,}/');

	define('COOKIE_EXPIRE', 60 * 15);

	define('HEADER_HTML', 'Content-Type: text/html; charset=utf-8');
	define('HEADER_JSON', 'Content-Type: application/json; charset=utf-8');