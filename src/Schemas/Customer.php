<?php namespace Schemas ; 
 
 class Customer {
 
 	 const COLUMNS = [ 
		'Id_customer'=>['type'=>'int(11)', 'nullable'=>0,'default'=>''],
		'first_name'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'last_name'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'telephone'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'mail'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'adresse_facturation'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'is_deleted'=>['type'=>'tinyint(1)', 'nullable'=>1,'default'=>''],
		'Id_account'=>['type'=>'int(11)', 'nullable'=>1,'default'=>'']

	];


}