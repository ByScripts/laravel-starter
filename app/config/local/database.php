<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/

	'connections' => [

        'mysql' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => '/* BYSCRIPTS_SETUP:DB Name:@getDefaultDbName */',
            'username'  => '/* BYSCRIPTS_SETUP:DB User:root */',
            'password'  => '/* BYSCRIPTS_SETUP:DB Pass:root */',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '/* BYSCRIPTS_SETUP:DB Table Prefix: */',
        ],

	],

);