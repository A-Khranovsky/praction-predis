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
SET "key" "new_value"

Reading an updated value with key = key, using equal NoSQL query:
GET key:
"new_value"
```