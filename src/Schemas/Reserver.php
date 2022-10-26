<?php namespace Schemas ; 
 
 class Reserver {
 
 	 const COLUMNS = [ 
		'Id_Flipper'=>['type'=>'int(11)', 'nullable'=>1,'default'=>''],
		'Id_customer'=>['type'=>'int(11)', 'nullable'=>1,'default'=>''],
		'Id_reserver'=>['type'=>'int(11)', 'nullable'=>0,'default'=>''],
		'année'=>['type'=>'int(11)', 'nullable'=>1,'default'=>''],
		'moi'=>['type'=>'int(11)', 'nullable'=>1,'default'=>''],
		'weekend'=>['type'=>'varchar(50)', 'nullable'=>1,'default'=>''],
		'durée'=>['type'=>'varchar(50)', 'nullable'=>1,'default'=>''],
		'multiplicateur_prix_durée'=>['type'=>'decimal(3,2)', 'nullable'=>1,'default'=>''],
		'prixFlipper'=>['type'=>'int(11)', 'nullable'=>1,'default'=>''],
		'prixTransport'=>['type'=>'int(11)', 'nullable'=>1,'default'=>''],
		'Tva'=>['type'=>'decimal(4,2)', 'nullable'=>1,'default'=>''],
		'PrixTotal'=>['type'=>'decimal(5,2)', 'nullable'=>1,'default'=>''],
		'adresse_livraison'=>['type'=>'varchar(255)', 'nullable'=>1,'default'=>''],
		'cp_livraison'=>['type'=>'int(11)', 'nullable'=>1,'default'=>''],
		'ville_livraison'=>['type'=>'varchar(50)', 'nullable'=>1,'default'=>''],
		'is_deleted'=>['type'=>'tinyint(1)', 'nullable'=>1,'default'=>''],
		'is_reserved'=>['type'=>'tinyint(1)', 'nullable'=>1,'default'=>''],
		'is_payed'=>['type'=>'tinyint(1)', 'nullable'=>1,'default'=>'']

	];


}