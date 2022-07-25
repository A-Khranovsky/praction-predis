<?php 

require_once(__DIR__ . '/../vendor/autoload.php');

$redis = new \Predis\Client();
echo '<h3>Using Redis with package \'Predis/predis\'</h3>';

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
	<strong>SET "key" "new_value </strong>';
$redis->set('key', '"new_value');
echo '<br /><br />Reading an updated value with key = key, using equal NoSQL query:<br />
	<strong>GET key</strong>: <br />', $redis->get('key'), '<br />';

//$redis->set('"key"', '"value"');
echo '<br />Appending new value to value has already exist with key = key. Using equal NoSQL query:<br />
	<strong>APPEND key and new item"</strong><br />';
$redis->append('key', ' and new_item"');
echo '<br />Reading an updated value with key = key, using equal NoSQL query:<br />
	<strong>GET key</strong>: <br />', $redis->get('key'), '<br />';

echo '<br />Setting value = 0 with key = count. Using equal NoSQL query:<br />
	<strong>SET count 0</strong><br />';
$redis->set('count', 0);
echo '<br />Reading the value with key = count, using equal NoSQL query:<br />
	<strong>GET count</strong><br />', $redis->get('count'), '<br />';

echo '<br />Incrementing the count, using equal NoSQL query:<br />
	<strong>INCR count</strong><br />';
$redis->incr('count');

echo '<br />Reading the value with key = count, using equal NoSQL query:<br />
	<strong>GET count</strong><br />', $redis->get('count'), '<br />';

echo '<br />Incrementing the count by the specified number: 5, using equal NoSQL query:<br />
	<strong>INCRBY count 5</strong><br />';

$redis->incrBy('count', 5);
echo '<br />Reading the value with key = count, using equal NoSQL query:<br />
	<strong>GET count</strong><br />', $redis->get('count'), '<br />';

echo 'Decrementing the count, using equal NoSQL query:<br />
	<strong>DECR count</strong><br />';
$redis->decr('count');

echo '<br />Reading the value with key = count, using equal NoSQL query:<br />
	<strong>GET count</strong><br />', $redis->get('count'), '<br />';

echo 'Decrementing the count by specified number, using equal NoSQL query:<br />
	<strong>DECRBY count 3</strong><br />';
$redis->decrBy('count', 3);

echo '<br />Reading the value with key = count, using equal NoSQL query:<br />
	<strong>GET count</strong><br />', $redis->get('count'), '<br />';

echo '<br />Incrementing the count by specified float number, using equal NoSQL query:<br />
	<strong>INCRBYFLOAT count 0.5</strong><br />';
$redis->incrByFloat('count', 0.5);

echo '<br />Reading the value with key = count, using equal NoSQL query:<br />
	<strong>GET count</strong><br />', $redis->get('count'), '<br />';

echo '<br />Incrementing the count by specified negative float number, using equal NoSQL query:<br />
	<strong>INCRBYFLOAT count -0.5</strong><br />';
$redis->incrByFloat('count', -0.5);

echo '<br />Reading the value with key = count, using equal NoSQL query:<br />
	<strong>GET count</strong><br />', $redis->get('count'), '<br />';

echo '<br /> Deleting values with keys: key and count, using equal NoSQL query:<br />
	<strong>DEL key</strong><br />
	<strong>DEL count</strong><br />';
$redis->del('key');
$redis->del('count');

echo '<br />Reading the value with key = key and key = count, using equal NoSQL query:<br />
	<strong>GET key</strong><br />', var_dump($redis->get('key')), '<br />',
	'<strong>GET count</strong><br />', var_dump($redis->get('count'));

echo '<hr>', '<h3>Manipulates with keys</h3>';
echo 'Selecting of all the keys of DB, using equal NoSQL query:<br />
	<strong>KEYS *</strong>';
echo '<pre>', print_r($redis->keys('*'), true), '</pre>';

echo 'Selecting of the keys strats from letter \'f\' of DB, using equal NoSQL query:<br />
	<strong>KEYS f*</strong>';
echo '<pre>', print_r($redis->keys('f*'), true), '</pre>';

echo 'Renaming the key fst to first, using equal NoSQL query:<br />
	<strong>RENAME fst first </strong><br />';
echo 'Selecting of the keys strats from letter \'f\' of DB, using equal NoSQL query:<br />
	<strong>KEYS f*</strong>';
echo '<pre>', print_r($redis->keys('f*'), true), '</pre>';

echo '<hr>', '<h3>Key lifetime manipulation</h3>';