<?php

/* Db configuration */

/*$dbname 	= 'ixmaps';
$dbuser		= 'postgres';
$dbpassword	= 'anto123';
$dbport		= '5432';
*/
$dbname 	= 'ixmaps';
$dbuser		= 'ixmaps';
/*$dbpassword	= 'Utor1939';*/
$dbport		= '5432';

// Connecting, selecting database
$dbconn = pg_connect("host=localhost dbname=$dbname user=$dbuser password=$dbpassword")
    or die('Could not connect to DB: ' . pg_last_error());

//$webUrl = "http://localhost/mywebapps/ixmaps.ca/dev.ixmaps.ca";
$webUrl = "http://dev.ixmaps.ischool.utoronto.ca";

//$savePath = '/Applications/XAMPP/htdocs/mywebapps/ixmaps.ca/dev.ixmaps.ca/gm-temp';
$savePath = '/var/www/dev.ixmaps.ca/gm-temp';

$trNumLimit=1500; // 1000 is a safe num with the new approach

$ixmaps_debug_mode = true;

$ixmaps_hands_off_config = array(	
		
);

$ixmaps_filter_data = array(
	array(
		'constraint1'=>'does',
		'constraint2'=>'originate',
		'constraint3'=>'city',
		'constraint4'=>'Toronto',
		'constraint5'=>'AND'
	),
	array(
		'constraint1'=>'does',
		'constraint2'=>'goesVia',
		'constraint3'=>'city',
		'constraint4'=>'Chicago',
		'constraint5'=>'AND'
	),
	array(
		'constraint1'=>'does',
		'constraint2'=>'terminate',
		'constraint3'=>'city',
		'constraint4'=>'Vancouver',
		'constraint5'=>'NULL'
	)
);

//echo json_encode($ixmaps_filter_data);

$ixmaps_config = array(
	'hands_off' => array(

	),

	'actions' => array(
		array(
			'name' => 'originate',
			'description' => 'Originate in'
		),
		array(
			'name' => 'terminate',
			'description' => 'Terminate in'
		),
		/*
		array(
			'name' => 'passThrough',
			'description' => 'Pass through'
		),
		*/
		array(
			'name' => 'goesvia',
			'description' => 'Goes via'
		)),
	'inclusion'=> array(
		array(
			'name'=>'yes',
			'description'=>'does'
		),
		array(
			'name'=>'no',
			'description'=>'doesNot'
		)),
	'locations' => array(
		array(
			'name'=>'country',
			'description'=>'Country'
		),
		array(
			'name'=>'city',
			'description'=>'City'
		),
		array(
			'name'=>'ISP',
			'description'=>'ISP'
		),
		array(
			'name'=>'NSA',
			'description'=>'NSA'
		)),

		//'name'=>'country','city','ISP','NSA'),
	'operand'=> array(
		array(
			'name'=>null,
			'description'=>'AND/OR'
		),
		array(
			'name'=>'and',
			'description'=>'AND'
		),
		array(
			'name'=>'or',
			'description'=>'OR')
		)
	);

$coordExclude = array(
	'60,-95',
	'38,-97'
	);

//print_r($as_num_color);
?>
