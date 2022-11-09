<?php namespace Schemas ; 
 
 class Command {
 
 	 const COLUMNS = [ 
		'Id_command'=>['type'=>'varchar(255)', 'nullable'=>0,'default'=>''],
		'date_of_order'=>['type'=>'date', 'nullable'=>1,'default'=>''],
		'transport_mode'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'transport_price'=>['type'=>'decimal(15,2)', 'nullable'=>1,'default'=>''],
		'is_completed'=>['type'=>'tinyint(1)', 'nullable'=>1,'default'=>''],
		'Id_customer'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>'']

	];


}