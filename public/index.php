<?php 

require_once(__DIR__ . '/../vendor/autoload.php');

session_start();

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
$redis->rename('fst', 'first');
echo 'Selecting of the keys strats from letter \'f\' of DB, using equal NoSQL query:<br />
	<strong>KEYS f*</strong>';
echo '<pre>', print_r($redis->keys('f*'), true), '</pre>';

echo '<hr>', '<h3>Key lifetime manipulation</h3>';
echo 'Setting a new value "timer" and setting an expiration time for it, using equal NoSQL query:<br />',
	'SET timer "one minute"<br />
	EXPIRE timer 60<br />';
if(!isset($_SESSION['for_timer'])) {
	$redis->set('timer', '"one minute"');
	$redis->expire('timer', 60);
	$_SESSION['for_timer']  = 1;
}
echo '<br />Reading timer if it\'s time not expired, using equal NoSQL query:<br />
	<strong>GET timer</strong><br />', var_dump($redis->get('timer')), '<br />';

echo '<br /> Setting a new value "timer1" and setting an expiration time for it, using equal NoSQL query:<br />',
	'<strong>SETEX timer1 120 "two minute"</strong><br />';
if(!isset($_SESSION['for_timer1'])) {
	$redis->setex('timer1', 120, '"two minutes"');	
	$_SESSION['for_timer1']  = 1;
}	
echo '<br />Reading timer if it\'s time not expired, using equal NoSQL query:<br />
	<strong>GET timer</strong><br />', var_dump($redis->get('timer1')), '<br />';

echo '<br />Watching expiration time of timer and timer1, using equal NoSQL query:<br />
	<strong>TTL timer </strong>', '<br />', var_dump($redis->ttl('timer')), '<br />',
	'<strong>TTL timer1 </strong>', '<br />', var_dump($redis->ttl('timer1')), '<br />';

echo 'Disabling expiration time of the timer1, using equal NoSQL query:<br />
	<strong>PERSIST timer1</strong><br />';
$redis->persist('timer1');
echo '<br />Watching expiration time of timer1, using equal NoSQL query:<br />',	
	'<strong>TTL timer1 </strong>', '<br />', var_dump($redis->ttl('timer1')), '<br />';

echo '<hr><h3>Data types</h3>';
echo 'Watching data type of value with key = first, using equal NoSQL query:<br />',
	'<strong>TYPE first</strong><br />',
	'<pre>', var_dump($redis->type('first')), '</pre>';

echo '<hr><h3>Hash</h3>';
echo 'Setting the hash, using equal NoSQL query:<br />',
	'<strong>
		HSET admin login root<br />
		HSET admin pass password<br />
		HSET admin registered_at<br /> 
	</strong><br />';
$redis->hset('admin', 'login', 'root');
$redis->hset('admin', 'pass', 'password');
$redis->hset('admin', 'registered_at', date('Y-m-d H:i:s'));
echo '<br />Reading hash admin login, using equal NoSQL query:<br />',
	'<strong>HGET admin login</strong><pre>', var_dump($redis->hget('admin', 'login')), '</pre>',
	'<strong>HGET admin pass</strong><pre>', var_dump($redis->hget('admin', 'pass')), '</pre>',
	'<strong>HGET admin registered_at</strong><pre>', var_dump($redis->hget('admin', 'registered_at')), '</pre>';

echo 'Deleting the hash admin, using equal NoSQL query:<br />',
	'<strong>DEL admin</strong><br />';
$redis->del('admin');

echo '<br />Inputing several values to the hash, using equal NoSQL query:<br />',
	'<strong>HMSET admin login root pass password registered_at current_date</strong><br />';
$redis->hmset('admin', [
	'login' => 'root',
	'pass' => 'password',
	'registered_at' => date('Y-m-d H:i:s')
]);

echo '<br />Reading values of hash admin, using equal NoSQL query:<br />',
	'<strong>HVALS admin</strong>',
	'<pre>', var_dump($redis->hvals('admin')), '</pre><br />';

echo 'Reading one value of the hash admin, using equal NoSQL query:<br />',
	'<strong>HGET admin login</strong><br />';
echo $redis->hget('admin', 'login'), '<br />';

echo '<br />Checking if hash value with key login exists, using equal NoSQL query:<br />',
	'<strong>HEXISTS admin login</strong><br />',
	var_dump($redis->hexists('admin', 'login')), '<br />';

echo '<br />Checking if hash value with key none exists, using equal NoSQL query:<br />',
	'<strong>HEXISTS admin none</strong><br />',
	var_dump($redis->hexists('admin', 'none')), '<br />';

echo '<br />Watching all the keys of hash admin, using equal NoSQL query:<br />',
	'<strong>HKEYS admin</strong><br />',
	'<pre>', var_dump($redis->hkeys('admin')), '</pre>';

echo '<br />Watching all info (keys and values) of hash admin, using equal NoSQL query:<br />',
	'<strong>HGETALL admin</strong><br />',
	'<pre>', var_dump($redis->hGetAll('admin')), '</pre>';

echo '<br />Watching the length of hash admin, using equal NoSQL query:<br />',
	'<strong>HLEN admin</strong><br />',
	'<pre>', var_dump($redis->hLen('admin')), '</pre>';

echo '<hr><h3>Set</h3>';
echo 'Inputting to the set, using equal NoSQL query:<br />',
	'<strong>SADD email alex@ukr.net</strong><br />',
	'<strong>SADD email alex@gmail.com</strong><br />',
	'<strong>SADD email jack@gmail.com</strong><br />';
$redis->sadd('email', 'alex@ukr.net');
$redis->sadd('email', 'alex@gmail.com');
$redis->sadd('email', 'jack@gmail.com');

echo '<br />Watching members of set email, using equal NoSQL query:<br />',
	'<strong>SMEMBERS email</strong><br />';
echo '<pre>', var_dump($redis->smembers('email')), '</pre>';

echo '<br />Watching amount of elements of set, using equal NoSQL query:<br />',
	'<strong>SCARD email</strong><br />';
echo '<pre>', var_dump($redis->scard('email')), '</pre>';

echo '<br />Deleting the element of set, using equal NoSQL query:<br />',
	'<strong>SREM email alex@ukr.net</strong><br />';
$redis->srem('email', 'alex@ukr.net');

echo '<br />Watching members of set email, using equal NoSQL query:<br />',
	'<strong>SMEMBERS email</strong><br />';
echo '<pre>', var_dump($redis->smembers('email')), '</pre>';

echo '<br />Getting random value of set, using equal NoSQL query:<br />',
	'<strong>SPOP email</strong><br />';
echo '<pre>', var_dump($redis->spop('email')), '</pre>';

echo '<br />Creating new set subscribers, using equal NoSQL query:<br />',
	'<strong>SADD subscribers your_name@example.com your_name@example.net your_name@example.info alex@gamil.com</strong><br />';
$redis->sadd('subscribers', 'your_name@example.com', 'your_name@example.net', 'your_name@example.info', 'alex@gmail.com');

echo '<br />Watching members of set subscribers, using equal NoSQL query:<br />',
	'<strong>SMEMBERS subscribers</strong><br />';
echo '<pre>', var_dump($redis->smembers('subscribers')), '</pre>';

echo '<br />Wathing result of intersection of sets email and subscribers, using equal NoSQL query:<br />',
	'<strong>SINTER email subscribers</strong><br />';
echo '<pre>', var_dump($redis->sinter('email', 'subscribers')), '</pre>';
