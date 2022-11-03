<?php namespace Schemas ; 
 
 class Images {
 
 	 const COLUMNS = [ 
		'Id_images'=>['type'=>'varchar(255)', 'nullable'=>0,'default'=>''],
		'img_src'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'image_alt'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'is_deleted'=>['type'=>'tinyint(1)', 'nullable'=>1,'default'=>''],
		'Id_drawing'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>'']

	];


}