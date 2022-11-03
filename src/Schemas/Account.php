<?php namespace Schemas ; 
 
 class Account {
 
 	 const COLUMNS = [ 
		'Id_account'=>['type'=>'varchar(255)', 'nullable'=>0,'default'=>''],
		'pseudo'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'password'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'is_admin'=>['type'=>'tinyint(1)', 'nullable'=>1,'default'=>''],
		'is_deleted'=>['type'=>'tinyint(1)', 'nullable'=>1,'default'=>''],
		'Id_customer'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>'']

	];


}