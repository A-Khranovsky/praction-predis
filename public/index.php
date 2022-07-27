<?php

require_once(__DIR__ . '/../vendor/autoload.php');

session_start();

$redis = new \Predis\Client();
echo '<h3>Using Redis with package \'Predis/predis\'</h3>';

echo'Setting string "value" to DB with key = key by equal NoSQL query: <br />
	<strong>SET key value</strong> <br />';

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

echo '<br />Inputing several values by one query, using equal NoSQL query:<br />
	<strong>MSET fst 1 snd 2 thd 3 fth 4</strong><br />';
$redis->mSet([
    'fst' => 1,
    'snd' => 2,
    'thd' => 3,
    'fth' => 4,
]);

echo '<br /> Reading fst and fth, using equal NoSQL query:<br />
	<strong>MGET fst fst</strong><br />';
echo '<pre>', print_r($redis->mGet('fst', 'fth'), true), '</pre><br />';

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
if (!isset($_SESSION['for_timer'])) {
    $redis->set('timer', '"one minute"');
    $redis->expire('timer', 60);
    $_SESSION['for_timer']  = 1;
}
echo '<br />Reading timer if it\'s time not expired, using equal NoSQL query:<br />
	<strong>GET timer</strong><br />', var_dump($redis->get('timer')), '<br />';

echo '<br /> Setting a new value "timer1" and setting an expiration time for it, using equal NoSQL query:<br />',
    '<strong>SETEX timer1 120 "two minute"</strong><br />';
if (!isset($_SESSION['for_timer1'])) {
    $redis->setEx('timer1', 120, '"two minutes"');
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
$redis->hSet('admin', 'login', 'root');
$redis->hSet('admin', 'pass', 'password');
$redis->hSet('admin', 'registered_at', date('Y-m-d H:i:s'));
echo '<br />Reading hash admin login, using equal NoSQL query:<br />',
    '<strong>HGET admin login</strong><pre>', var_dump($redis->hGet('admin', 'login')), '</pre>',
    '<strong>HGET admin pass</strong><pre>', var_dump($redis->hGet('admin', 'pass')), '</pre>',
    '<strong>HGET admin registered_at</strong><pre>', var_dump($redis->hGet('admin', 'registered_at')), '</pre>';

echo 'Deleting the hash admin, using equal NoSQL query:<br />',
    '<strong>DEL admin</strong><br />';
$redis->del('admin');

echo '<br />Inputing several values to the hash, using equal NoSQL query:<br />',
    '<strong>HMSET admin login root pass password registered_at current_date</strong><br />';
$redis->hmSet('admin', [
    'login' => 'root',
    'pass' => 'password',
    'registered_at' => date('Y-m-d H:i:s')
]);

echo '<br />Reading values of hash admin, using equal NoSQL query:<br />',
    '<strong>HVALS admin</strong>',
    '<pre>', var_dump($redis->hVals('admin')), '</pre><br />';

echo 'Reading one value of the hash admin, using equal NoSQL query:<br />',
    '<strong>HGET admin login</strong><br />';
echo $redis->hGet('admin', 'login'), '<br />';

echo '<br />Checking if hash value with key login exists, using equal NoSQL query:<br />',
    '<strong>HEXISTS admin login</strong><br />',
    var_dump($redis->hExists('admin', 'login')), '<br />';

echo '<br />Checking if hash value with key none exists, using equal NoSQL query:<br />',
    '<strong>HEXISTS admin none</strong><br />',
    var_dump($redis->hExists('admin', 'none')), '<br />';

echo '<br />Watching all the keys of hash admin, using equal NoSQL query:<br />',
    '<strong>HKEYS admin</strong><br />',
    '<pre>', var_dump($redis->hKeys('admin')), '</pre>';

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
$redis->sAdd('email', 'alex@ukr.net');
$redis->sAdd('email', 'alex@gmail.com');
$redis->sAdd('email', 'jack@gmail.com');

echo '<br />Watching members of set email, using equal NoSQL query:<br />',
    '<strong>SMEMBERS email</strong><br />';
echo '<pre>', var_dump($redis->sMembers('email')), '</pre>';

echo '<br />Watching amount of elements of set, using equal NoSQL query:<br />',
    '<strong>SCARD email</strong><br />';
echo '<pre>', var_dump($redis->sCard('email')), '</pre>';

echo '<br />Deleting the element of set, using equal NoSQL query:<br />',
    '<strong>SREM email alex@ukr.net</strong><br />';
$redis->sRem('email', 'alex@ukr.net');

echo '<br />Watching members of set email, using equal NoSQL query:<br />',
    '<strong>SMEMBERS email</strong><br />';
echo '<pre>', var_dump($redis->sMembers('email')), '</pre>';

echo '<br />Getting random value of set, using equal NoSQL query:<br />',
    '<strong>SPOP email</strong><br />';
echo '<pre>', var_dump($redis->sPop('email')), '</pre>';

echo '<br />Creating new set subscribers, using equal NoSQL query:<br />',
    '<strong>SADD subscribers your_name@example.com your_name@example.net your_name@example.info alex@gamil.com</strong><br />';
$redis->sAdd('subscribers', 'your_name@example.com', 'your_name@example.net', 'your_name@example.info', 'alex@gmail.com');

echo '<br />Watching members of set subscribers, using equal NoSQL query:<br />',
    '<strong>SMEMBERS subscribers</strong><br />';
echo '<pre>', var_dump($redis->sMembers('subscribers')), '</pre>';

echo '<br />Watching members of set email, using equal NoSQL query:<br />',
    '<strong>SMEMBERS email</strong><br />';
echo '<pre>', var_dump($redis->sMembers('email')), '</pre>';

echo '<br />Watching result of intersection of sets email and subscribers, using equal NoSQL query:<br />',
    '<strong>SINTER email subscribers</strong><br />';
echo '<pre>', var_dump($redis->sInter('email', 'subscribers')), '</pre>';

echo '<br />Watching members of sets email & subscribers, using equal NoSQL query:<br />',
    '<strong>SMEMBERS email</strong><br />',
    '<strong>SMEMBERS subscribers</strong><br />';
echo '<pre>', var_dump($redis->sMembers('email')),
        var_dump($redis->sMembers('subscribers')), '</pre>';

echo '<br />Watching result of differention of sets email and subscribers, using equal NoSQL query:<br />',
    '<strong>SDIFF subscribers email</strong><br />';
echo '<pre>', var_dump($redis->sDiff('subscribers', 'email')), '</pre>';

echo '<br />Watching members of sets email & subscribers, using equal NoSQL query:<br />',
    '<strong>SMEMBERS email</strong><br />',
    '<strong>SMEMBERS subscribers</strong><br />';
echo '<pre>', var_dump($redis->sMembers('email')),
        var_dump($redis->sMembers('subscribers')), '</pre>';

echo '<br />Watching result of union of sets email and subscribers, using equal NoSQL query:<br />',
    '<strong>SUNION subscribers email</strong><br />';
echo '<pre>', var_dump($redis->sUnion('subscribers', 'email')), '</pre>';

echo '<br />Saving result of union of sets email & subscribers in result set, using equal NoSQL query:<br />',
    '<strong>SUNIONSTORE result email subscribers</strong><br />';
$redis->sUnionStore('resultUnion', 'email', 'subscribers');

echo '<br />Watching members of set resultUnion, using equal NoSQL query:<br />',
    '<strong>SMEMBERS resultUnion</strong><br />';
echo '<pre>', var_dump($redis->sMembers('resultUnion')), '</pre>';

echo '<br />Saving result of intersection of sets email & subscribers in resultInter set, using equal NoSQL query:<br />',
    '<strong>SINTERSTORE resultInter email subscribers</strong><br />';
$redis->sInterStore('resultInter', 'email', 'subscribers');

echo '<br />Watching members of set resultInter, using equal NoSQL query:<br />',
    '<strong>SMEMBERS resultInter</strong><br />';
echo '<pre>', var_dump($redis->sMembers('resultInter')), '</pre>';

echo '<br />Watching members of sets email & subscribers, using equal NoSQL query:<br />',
    '<strong>SMEMBERS email</strong><br />',
    '<strong>SMEMBERS subscribers</strong><br />';
echo '<pre>', var_dump($redis->sMembers('email')),
        var_dump($redis->sMembers('subscribers')), '</pre>';

echo '<br />Saving result of differention of sets email & subscribers in resultDiff set, using equal NoSQL query:<br />',
    '<strong>SDIFFSTORE resultDiff subscribers email</strong><br />';
$redis->sDiffStore('resultDiff', 'subscribers', 'email');

echo '<br />Watching members of set resultDiff, using equal NoSQL query:<br />',
    '<strong>SMEMBERS resultDiff</strong><br />';
echo '<pre>', var_dump($redis->sMembers('resultDiff')), '</pre>';

echo '<br />Watching members of sets email & subscribers, using equal NoSQL query:<br />',
    '<strong>SMEMBERS email</strong><br />',
    '<strong>SMEMBERS subscribers</strong><br />';
echo '<pre>', var_dump($redis->sMembers('email')),
        var_dump($redis->sMembers('subscribers')), '</pre>';

echo 'Moving element your_name@example.net form set subscribers to set new, using equal NoSQL query:<br />',
    '<strong>SMOVE subscribers new your_name@example.net</strong><br />';
$redis->sMove('subscribers', 'new', 'your_name@example.net');

echo '<br />Watching members of sets new & subscribers, using equal NoSQL query:<br />',
    '<strong>SMEMBERS new</strong><br />',
    '<strong>SMEMBERS subscribers</strong><br />';
echo '<pre>', var_dump($redis->sMembers('new')),
        var_dump($redis->sMembers('subscribers')), '</pre>';

echo '<hr><h3>Sorted set</h3>';

echo '<br />Inputing to sorted set, using equal NoSQL query:<br />',
    '<strong>ZADD words 200 hello 150 wet 100 world 50 base</strong><br />';
$redis->zAdd('words', '200', 'hello', '150', 'wet', '100', 'world', '50', 'base');

echo '<br />Watching the output, using equal NoSQL query:<br />',
        '<strong>ZRANGE words 0 4</strong>',
        '<pre>', var_dump($redis->zRange('words', '0', '4')), '</pre>';

echo '<br />Watching the length, using equal NoSQL query:<br />',
        '<strong>ZCARD words</strong>',
        '<pre>', var_dump($redis->zCard('words')), '</pre>';

echo 'Counting elements between keys 100 and 150 inclusive, using equal NoSQL query:<br />',
    '<strong>ZCOUNT words 100 150</strong>',
    '<pre>', var_dump($redis->zCount('words', 100, 150)), '</pre>';

echo 'Changing the key of hello, using equal NoSQL query:<br />',
    '<strong>ZINCRBY words -60 hello</strong>',
    '<pre>', var_dump($redis->zIncrBy('words', -60, 'hello')), '</pre>';

echo 'View order, using equal NoSQL query:<br />',
    '<strong>ZRANK words hello</strong>',
    '<pre>', $redis->zRank('words', 'hello'), '</pre>';

echo '<br />Watching all elements of sorted set "words", using equal NoSQL query:<br />',
    '<pre>', var_dump($redis->zRange('words', 0, -1)), '</pre>';

echo 'Deleting the element hello, using equal NoSQL query:<br />',
    '<strong>ZREM words hello</strong>';
$redis->zRem('words', 'hello');

echo '<br /><br />Watching all elements of sorted set "words", using equal NoSQL query:<br />',
    '<pre>', var_dump($redis->zRange('words', 0, -1)), '</pre>';

echo 'Deleting the range of elemnets, using equal NoSQL query:<br />',
    '<storng>ZREMRANGEBYRANK words 0 1</strong><br />';
$redis->zRemRangeByRank('words', 0, 1);

echo '<br /><br />Watching all elements of sorted set "words", using equal NoSQL query:<br />',
    '<pre>', var_dump($redis->zRange('words', 0, -1)), '</pre>';

echo '<br />Inputing to sorted sets, using equal NoSQL queries:<br />',
    '<strong>
		ZADD colors 10 red 20 green 30 blue <br />
		ZADD colors1 100 white 20 green
	</strong><br />';

$redis->zAdd('colors', '10', 'red', '20', 'green', '30', 'blue');
$redis->zAdd('colors1', '100', 'white', '20', 'green');

echo '<br />Output of 2 sorted sets "color" and "color1", using equal NoSQL queries:<br />',
    '<strong>
		ZRANGE color 0 -1<br />
		ZRANGE color1 0 -1<br />
	</strong>',
    '<pre>', var_dump($redis->zRange('colors', 0, -1)), var_dump($redis->zRange('colors1', 0, -1)), '</pre>';

echo '<br />Saving intersection of "colors" and "colors1" in resultZInter, using equal NoSQL query: <br />',
    '<strong>ZINTERSTORE resultZInter colors colors1</strong>';
$redis->zInterStore('resultZInter', ['colors', 'colors1']);

echo '<br /><br />Watching output of resultZInter, using equal NoSQL query:<br />',
    '<strong>ZRANGE resultZInter 0 -1</strong><br />',
    '<pre>', var_dump($redis->zRange('resultZInter', 0, -1)), '</pre>';

echo '<br />Output of 2 sorted sets "color" and "color1", using equal NoSQL queries:<br />',
    '<strong>
		ZRANGE color 0 -1<br />
		ZRANGE color1 0 -1<br />
	</strong>',
    '<pre>', var_dump($redis->zRange('colors', 0, -1)), var_dump($redis->zRange('colors1', 0, -1)), '</pre>';

echo '<br />Saving union of "colors" and "colors1" in resultZUnion, using equal NoSQL query: <br />',
    '<strong>ZUNIONSTORE resultZUnion colors colors1</strong>';
$redis->zUnionStore('resultZUnion', ['colors', 'colors1']);

echo '<br /><br />Watching output of resultZUnion, using equal NoSQL query:<br />',
    '<strong>ZRANGE resultZUnion 0 -1</strong><br />',
    '<pre>', var_dump($redis->zRange('resultZUnion', 0, -1)), '</pre>';
