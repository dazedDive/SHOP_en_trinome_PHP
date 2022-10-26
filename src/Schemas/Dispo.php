<?php namespace Schemas ; 
 
 class Dispo {
 
 	 const COLUMNS = [ 
		'Id_dispo'=>['type'=>'int(11)', 'nullable'=>0,'default'=>''],
		'date_debut'=>['type'=>'date', 'nullable'=>1,'default'=>''],
		'date_fin'=>['type'=>'date', 'nullable'=>1,'default'=>''],
		'is_deleted'=>['type'=>'tinyint(1)', 'nullable'=>1,'default'=>''],
		'Id_Flipper'=>['type'=>'int(11)', 'nullable'=>1,'default'=>'']

	];


}