<?php namespace Schemas ; 
 
 class Drawing {
 
 	 const COLUMNS = [ 
		'Id_drawing'=>['type'=>'varchar(255)', 'nullable'=>0,'default'=>''],
		'name'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'description'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'size'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'price'=>['type'=>'decimal(15,2)', 'nullable'=>1,'default'=>''],
		'is_top_selection'=>['type'=>'tinyint(1)', 'nullable'=>1,'default'=>''],
		'is_deleted'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'Id_artist_kid'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'Id_command'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'Id_collection'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>'']

	];


}