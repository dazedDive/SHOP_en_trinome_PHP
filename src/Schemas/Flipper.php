<?php namespace Schemas ; 
 
 class Flipper {
 
 	 const COLUMNS = [ 
		'Id_flipper'=>['type'=>'int(11)', 'nullable'=>0,'default'=>''],
		'name'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'description'=>['type'=>'text', 'nullable'=>1,'default'=>''],
		'price'=>['type'=>'int(11)', 'nullable'=>1,'default'=>''],
		'first_argument'=>['type'=>'varchar(50)', 'nullable'=>0,'default'=>'option1'],
		'second_argument'=>['type'=>'varchar(50)', 'nullable'=>0,'default'=>'option2'],
		'third_argument'=>['type'=>'varchar(50)', 'nullable'=>0,'default'=>'option3'],
		'fourth_argument'=>['type'=>'varchar(50)', 'nullable'=>0,'default'=>'option4'],
		'is_available'=>['type'=>'tinyint(1)', 'nullable'=>1,'default'=>''],
		'is_deleted'=>['type'=>'tinyint(1)', 'nullable'=>1,'default'=>'']

	];


}