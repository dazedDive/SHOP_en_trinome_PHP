<?php namespace Schemas ; 
 
 class Image {
 
 	 const COLUMNS = [ 
		'Id_image'=>['type'=>'int(11)', 'nullable'=>0,'default'=>''],
		'img_src'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'alt'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'is_deleted'=>['type'=>'tinyint(1)', 'nullable'=>1,'default'=>''],
		'Id_flipper'=>['type'=>'int(11)', 'nullable'=>1,'default'=>'']

	];


}