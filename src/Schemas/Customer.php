<?php namespace Schemas ; 
 
 class Customer {
 
 	 const COLUMNS = [ 
		'Id_customer'=>['type'=>'varchar(255)', 'nullable'=>0,'default'=>''],
		'first_name'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'last_name'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'email'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'telephone'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'adress'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'is_deleted'=>['type'=>'tinyint(1)', 'nullable'=>1,'default'=>'']

	];


}