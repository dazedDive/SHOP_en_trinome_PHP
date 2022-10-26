<?php namespace Schemas ; 
 
 class Statistique {
 
 	 const COLUMNS = [ 
		'Id_statistique'=>['type'=>'int(11)', 'nullable'=>0,'default'=>''],
		'homepage_text'=>['type'=>'text', 'nullable'=>0,'default'=>''],
		'sales_revenue'=>['type'=>'decimal(15,2)', 'nullable'=>1,'default'=>''],
		'order_count'=>['type'=>'int(11)', 'nullable'=>0,'default'=>'0'],
		'price_by_kilometer'=>['type'=>'decimal(15,2)', 'nullable'=>1,'default'=>''],
		'multiplier_saturday'=>['type'=>'float(15,2)', 'nullable'=>1,'default'=>''],
		'multiplier_sunday'=>['type'=>'float(15,2)', 'nullable'=>1,'default'=>''],
		'multiplier_both'=>['type'=>'float(15,2)', 'nullable'=>1,'default'=>''],
		'is_deleted'=>['type'=>'tinyint(1)', 'nullable'=>0,'default'=>'0']

	];


}