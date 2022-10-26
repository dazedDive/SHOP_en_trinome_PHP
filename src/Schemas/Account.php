<?php namespace Schemas ; 
 
 class Account {
 
 	 const COLUMNS = [ 
		'Id_account'=>['type'=>'int(11)', 'nullable'=>0,'default'=>''],
		'login'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'password'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'is_admin'=>['type'=>'tinyint(1)', 'nullable'=>1,'default'=>''],
		'is_deleted'=>['type'=>'tinyint(1)', 'nullable'=>0,'default'=>'']

	];


}