<?php namespace Schemas ; 
 
 class Artist_kid {
 
 	 const COLUMNS = [ 
		'Id_artist_kid'=>['type'=>'varchar(255)', 'nullable'=>0,'default'=>''],
		'name'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'biographie'=>['type'=>'text', 'nullable'=>1,'default'=>''],
		'img_src'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'img_alt'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'is_deleted'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>'']

	];


}