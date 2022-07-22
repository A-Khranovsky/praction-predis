<?php 

require_once(__DIR__ . '/../vendor/autoload.php');

$redis = new \Predis\Client();
echo 'Using Redis with package \'Predis/predis\'<br /><br />';

echo'Setting to collection of associative array with key = key a value = value by equal NoSQL query: <br /><strong>SET key value</strong> <br />';
$redis->set('key', 'value');

echo '<br />Reading a value from item with key = key by equal NoSQL query:<br />
	<strong>GET key</strong><br />';
echo $redis->get('key'), '<br /><br />';

echo 'Reading value by key = key from another DB, using equal NoSQL code:<br />
	<strong>SELECT 1</strong><br />';
$redis->select('1');
var_dump($redis->get('key'));

echo '<br /><br />Has come back by equal NoSQL query: SELECT 0 <br />';
$redis->select('0'); // Come back to pervious DB

echo '<br />Inputing several values to collection of associative array, using equal NoSQL query:<br />
	<strong>MSET fst 1 snd 2 thd 3 fth 4</strong><br />';
$redis->mset([
	'fst' => 1,
	'snd' => 2,
	'thd' => 3,
	'fth' => 4,
]);

echo '<br /> Reading fst and fth from collection of associative array, using equal NoSQL query:<br />
	<strong>MGET fst fst</strong><br />';
echo '<pre>', print_r ($redis->mget('fst', 'fth'), true), '</pre><br />';

echo 'Reading only fst key, using equal NoSQL query:<br />
	<strong>GET fst</strong><br />';
echo $redis->get('fst'), '<br /><br />';

echo 'Updating value with key = key - setting \'new_value\' using equal NoSQL query:<br />
	<strong>SET "key" "new_value" </strong>';
$redis->set('key', '"new_value"');
echo '<br /><br />Reading an updated value with key = key, using equal NoSQL query:<br />
	<strong>GET key</strong>: <br />', $redis->get('key');
