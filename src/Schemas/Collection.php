<?php namespace Schemas ; 
 
 class Collection {
 
 	 const COLUMNS = [ 
		'Id_collection'=>['type'=>'varchar(255)', 'nullable'=>0,'default'=>''],
		'name'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'description'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'img_src'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'img_alt'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'is_deleted'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>'']

	];


}