## Vocation
Practiion with Redis.

## Description
The working environment has a redis server configured. Project uses packege predis to work with redis server. Project
inputs data, process it and outputs. There are tricks with entering multiple data through one request. There are 
techniques for saving the resulting data after operations on sets, movement data to another set, deletion the data. 

Used to store data:
* scalars
* hashes
* sets
* sorted sets

## To run do:
* docker-compose up -d
* docker exec -it 36_php-apache_1 bash
* service redis-server restart
* open "http://localhost"

```
Using Redis with package 'Predis/predis'
Setting to collection of associative array with key = key a value = value by equal NoSQL query:
SET key value

Reading a value from item with key = key by equal NoSQL query:
GET key
value

Reading value by key = key from another DB, using equal NoSQL code:
SELECT 1
NULL

Has come back by equal NoSQL query: SELECT 0

Inputing several values to collection of associative array, using equal NoSQL query:
MSET fst 1 snd 2 thd 3 fth 4

Reading fst and fth from collection of associative array, using equal NoSQL query:
MGET fst fst

Array
(
    [0] => 1
    [1] => 4
)


Reading only fst key, using equal NoSQL query:
GET fst
1

Updating value with key = key - setting 'new_value' using equal NoSQL query:
SET "key" "new_value

Reading an updated value with key = key, using equal NoSQL query:
GET key:
"new_value

Appending new value to value has already exist with key = key. Using equal NoSQL query:
APPEND key and new item"

Reading an updated value with key = key, using equal NoSQL query:
GET key:
"new_value and new_item"

Setting value = 0 with key = count. Using equal NoSQL query:
SET count 0

Reading the value with key = count, using equal NoSQL query:
GET count
0

Incrementing the count, using equal NoSQL query:
INCR count

Reading the value with key = count, using equal NoSQL query:
GET count
1

Incrementing the count by the specified number: 5, using equal NoSQL query:
INCRBY count 5

Reading the value with key = count, using equal NoSQL query:
GET count
6
Decrementing the count, using equal NoSQL query:
DECR count

Reading the value with key = count, using equal NoSQL query:
GET count
5
Decrementing the count by specified number, using equal NoSQL query:
DECRBY count 3

Reading the value with key = count, using equal NoSQL query:
GET count
2

Incrementing the count by specified float number, using equal NoSQL query:
INCRBYFLOAT count 0.5

Reading the value with key = count, using equal NoSQL query:
GET count
2.5

Incrementing the count by specified negative float number, using equal NoSQL query:
INCRBYFLOAT count -0.5

Reading the value with key = count, using equal NoSQL query:
GET count
2

Deleting values with keys: key and count, using equal NoSQL query:
DEL key
DEL count

Reading the value with key = key and key = count, using equal NoSQL query:
GET key
NULL
GET count
NULL
Manipulates with keys
Selecting of all the keys of DB, using equal NoSQL query:
KEYS *

Array
(
    [0] => fst
    [1] => thd
    [2] => fth
    [3] => snd
)

Selecting of the keys strats from letter 'f' of DB, using equal NoSQL query:
KEYS f*

Array
(
    [0] => fst
    [1] => fth
)

Renaming the key fst to first, using equal NoSQL query:
RENAME fst first
Selecting of the keys strats from letter 'f' of DB, using equal NoSQL query:
KEYS f*

Array
(
    [0] => first
    [1] => fth
)

Key lifetime manipulation
Setting a new value "timer" and setting an expiration time for it, using equal NoSQL query:
SET timer "one minute"
EXPIRE timer 60

Reading timer if it's time not expired, using equal NoSQL query:
GET timer
string(12) ""one minute""

Setting a new value "timer1" and setting an expiration time for it, using equal NoSQL query:
SETEX timer1 120 "two minute"

Reading timer if it's time not expired, using equal NoSQL query:
GET timer
string(13) ""two minutes""

Watching expiration time of timer and timer1, using equal NoSQL query:
TTL timer
int(60)
TTL timer1
int(120)
Disabling expiration time of the timer1, using equal NoSQL query:
PERSIST timer1

Watching expiration time of timer1, using equal NoSQL query:
TTL timer1
int(-1)
Data types
Watching data type of value with key = first, using equal NoSQL query:
TYPE first

object(Predis\Response\Status)#10 (1) {
  ["payload":"Predis\Response\Status":private]=>
  string(6) "string"
}

Hash
Setting the hash, using equal NoSQL query:
HSET admin login root
HSET admin pass password
HSET admin registered_at


Reading hash admin login, using equal NoSQL query:
HGET admin login

string(4) "root"

HGET admin pass

string(8) "password"

HGET admin registered_at

string(19) "2022-07-27 14:33:25"

Deleting the hash admin, using equal NoSQL query:
DEL admin

Inputing several values to the hash, using equal NoSQL query:
HMSET admin login root pass password registered_at current_date

Reading values of hash admin, using equal NoSQL query:
HVALS admin

array(3) {
  [0]=>
  string(4) "root"
  [1]=>
  string(8) "password"
  [2]=>
  string(19) "2022-07-27 14:33:25"
}


Reading one value of the hash admin, using equal NoSQL query:
HGET admin login
root

Checking if hash value with key login exists, using equal NoSQL query:
HEXISTS admin login
int(1)

Checking if hash value with key none exists, using equal NoSQL query:
HEXISTS admin none
int(0)

Watching all the keys of hash admin, using equal NoSQL query:
HKEYS admin

array(3) {
  [0]=>
  string(5) "login"
  [1]=>
  string(4) "pass"
  [2]=>
  string(13) "registered_at"
}


Watching all info (keys and values) of hash admin, using equal NoSQL query:
HGETALL admin

array(3) {
  ["login"]=>
  string(4) "root"
  ["pass"]=>
  string(8) "password"
  ["registered_at"]=>
  string(19) "2022-07-27 14:33:25"
}


Watching the length of hash admin, using equal NoSQL query:
HLEN admin

int(3)

Set
Inputting to the set, using equal NoSQL query:
SADD email alex@ukr.net
SADD email alex@gmail.com
SADD email jack@gmail.com

Watching members of set email, using equal NoSQL query:
SMEMBERS email

array(3) {
  [0]=>
  string(12) "alex@ukr.net"
  [1]=>
  string(14) "jack@gmail.com"
  [2]=>
  string(14) "alex@gmail.com"
}


Watching amount of elements of set, using equal NoSQL query:
SCARD email

int(3)


Deleting the element of set, using equal NoSQL query:
SREM email alex@ukr.net

Watching members of set email, using equal NoSQL query:
SMEMBERS email

array(2) {
  [0]=>
  string(14) "jack@gmail.com"
  [1]=>
  string(14) "alex@gmail.com"
}


Getting random value of set, using equal NoSQL query:
SPOP email

string(14) "jack@gmail.com"


Creating new set subscribers, using equal NoSQL query:
SADD subscribers your_name@example.com your_name@example.net your_name@example.info alex@gamil.com

Watching members of set subscribers, using equal NoSQL query:
SMEMBERS subscribers

array(4) {
  [0]=>
  string(22) "your_name@example.info"
  [1]=>
  string(14) "alex@gmail.com"
  [2]=>
  string(21) "your_name@example.com"
  [3]=>
  string(21) "your_name@example.net"
}


Watching members of set email, using equal NoSQL query:
SMEMBERS email

array(1) {
  [0]=>
  string(14) "alex@gmail.com"
}


Watching result of intersection of sets email and subscribers, using equal NoSQL query:
SINTER email subscribers

array(1) {
  [0]=>
  string(14) "alex@gmail.com"
}


Watching members of sets email & subscribers, using equal NoSQL query:
SMEMBERS email
SMEMBERS subscribers

array(1) {
  [0]=>
  string(14) "alex@gmail.com"
}
array(4) {
  [0]=>
  string(22) "your_name@example.info"
  [1]=>
  string(14) "alex@gmail.com"
  [2]=>
  string(21) "your_name@example.com"
  [3]=>
  string(21) "your_name@example.net"
}


Watching result of differention of sets email and subscribers, using equal NoSQL query:
SDIFF subscribers email

array(3) {
  [0]=>
  string(22) "your_name@example.info"
  [1]=>
  string(21) "your_name@example.com"
  [2]=>
  string(21) "your_name@example.net"
}


Watching members of sets email & subscribers, using equal NoSQL query:
SMEMBERS email
SMEMBERS subscribers

array(1) {
  [0]=>
  string(14) "alex@gmail.com"
}
array(4) {
  [0]=>
  string(22) "your_name@example.info"
  [1]=>
  string(14) "alex@gmail.com"
  [2]=>
  string(21) "your_name@example.com"
  [3]=>
  string(21) "your_name@example.net"
}


Watching result of union of sets email and subscribers, using equal NoSQL query:
SUNION subscribers email

array(4) {
  [0]=>
  string(22) "your_name@example.info"
  [1]=>
  string(21) "your_name@example.com"
  [2]=>
  string(14) "alex@gmail.com"
  [3]=>
  string(21) "your_name@example.net"
}


Saving result of union of sets email & subscribers in result set, using equal NoSQL query:
SUNIONSTORE result email subscribers

Watching members of set resultUnion, using equal NoSQL query:
SMEMBERS resultUnion

array(4) {
  [0]=>
  string(22) "your_name@example.info"
  [1]=>
  string(21) "your_name@example.com"
  [2]=>
  string(14) "alex@gmail.com"
  [3]=>
  string(21) "your_name@example.net"
}


Saving result of intersection of sets email & subscribers in resultInter set, using equal NoSQL query:
SINTERSTORE resultInter email subscribers

Watching members of set resultInter, using equal NoSQL query:
SMEMBERS resultInter

array(1) {
  [0]=>
  string(14) "alex@gmail.com"
}


Watching members of sets email & subscribers, using equal NoSQL query:
SMEMBERS email
SMEMBERS subscribers

array(1) {
  [0]=>
  string(14) "alex@gmail.com"
}
array(4) {
  [0]=>
  string(22) "your_name@example.info"
  [1]=>
  string(14) "alex@gmail.com"
  [2]=>
  string(21) "your_name@example.com"
  [3]=>
  string(21) "your_name@example.net"
}


Saving result of differention of sets email & subscribers in resultDiff set, using equal NoSQL query:
SDIFFSTORE resultDiff subscribers email

Watching members of set resultDiff, using equal NoSQL query:
SMEMBERS resultDiff

array(3) {
  [0]=>
  string(22) "your_name@example.info"
  [1]=>
  string(21) "your_name@example.com"
  [2]=>
  string(21) "your_name@example.net"
}


Watching members of sets email & subscribers, using equal NoSQL query:
SMEMBERS email
SMEMBERS subscribers

array(1) {
  [0]=>
  string(14) "alex@gmail.com"
}
array(4) {
  [0]=>
  string(22) "your_name@example.info"
  [1]=>
  string(14) "alex@gmail.com"
  [2]=>
  string(21) "your_name@example.com"
  [3]=>
  string(21) "your_name@example.net"
}

Moving element your_name@example.net form set subscribers to set new, using equal NoSQL query:
SMOVE subscribers new your_name@example.net

Watching members of sets new & subscribers, using equal NoSQL query:
SMEMBERS new
SMEMBERS subscribers

array(1) {
  [0]=>
  string(21) "your_name@example.net"
}
array(3) {
  [0]=>
  string(22) "your_name@example.info"
  [1]=>
  string(14) "alex@gmail.com"
  [2]=>
  string(21) "your_name@example.com"
}

Sorted set

Inputing to sorted set, using equal NoSQL query:
ZADD words 200 hello 150 wet 100 world 50 base

Watching the output, using equal NoSQL query:
ZRANGE words 0 4

array(4) {
  [0]=>
  string(4) "base"
  [1]=>
  string(5) "world"
  [2]=>
  string(3) "wet"
  [3]=>
  string(5) "hello"
}


Watching the length, using equal NoSQL query:
ZCARD words

int(4)

Counting elements between keys 100 and 150 inclusive, using equal NoSQL query:
ZCOUNT words 100 150

int(2)

Changing the key of hello, using equal NoSQL query:
ZINCRBY words -60 hello

string(3) "140"

View order, using equal NoSQL query:
ZRANK words hello

2


Watching all elements of sorted set "words", using equal NoSQL query:

array(4) {
  [0]=>
  string(4) "base"
  [1]=>
  string(5) "world"
  [2]=>
  string(5) "hello"
  [3]=>
  string(3) "wet"
}

Deleting the element hello, using equal NoSQL query:
ZREM words hello

Watching all elements of sorted set "words", using equal NoSQL query:

array(3) {
  [0]=>
  string(4) "base"
  [1]=>
  string(5) "world"
  [2]=>
  string(3) "wet"
}

Deleting the range of elemnets, using equal NoSQL query:
ZREMRANGEBYRANK words 0 1


Watching all elements of sorted set "words", using equal NoSQL query:

array(1) {
  [0]=>
  string(3) "wet"
}


Inputing to sorted sets, using equal NoSQL queries:
ZADD colors 10 red 20 green 30 blue
ZADD colors1 100 white 20 green

Output of 2 sorted sets "color" and "color1", using equal NoSQL queries:
ZRANGE color 0 -1
ZRANGE color1 0 -1

array(3) {
  [0]=>
  string(3) "red"
  [1]=>
  string(5) "green"
  [2]=>
  string(4) "blue"
}
array(2) {
  [0]=>
  string(5) "green"
  [1]=>
  string(5) "white"
}


Saving intersection of "colors" and "colors1" in resultZInter, using equal NoSQL query:
ZINTERSTORE resultZInter colors colors1

Watching output of resultZInter, using equal NoSQL query:
ZRANGE resultZInter 0 -1

array(1) {
  [0]=>
  string(5) "green"
}


Output of 2 sorted sets "color" and "color1", using equal NoSQL queries:
ZRANGE color 0 -1
ZRANGE color1 0 -1

array(3) {
  [0]=>
  string(3) "red"
  [1]=>
  string(5) "green"
  [2]=>
  string(4) "blue"
}
array(2) {
  [0]=>
  string(5) "green"
  [1]=>
  string(5) "white"
}


Saving union of "colors" and "colors1" in resultZUnion, using equal NoSQL query:
ZUNIONSTORE resultZUnion colors colors1

Watching output of resultZUnion, using equal NoSQL query:
ZRANGE resultZUnion 0 -1

array(4) {
  [0]=>
  string(3) "red"
  [1]=>
  string(4) "blue"
  [2]=>
  string(5) "green"
  [3]=>
  string(5) "white"
}

```