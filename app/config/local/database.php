<?php

return [

	'fetch' => PDO::FETCH_CLASS,

	'default' => 'mysql',

	'connections' => [

		'mysql' => [
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'auth',
			'username'  => 'root',
			'password'  => '',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		]


	]

];
