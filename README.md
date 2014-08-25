nosqlphp 1.0
========

nosql php mini framework.
it makes nosql very simple with php.

for example:

//search:
$user = $nodb->get("user-uid-123");

//insert or update:
$nodb->set("user-uid-123", $user);

//delete:
$nodb->delete("user-uid-123");

//count:
$n = $nodb->count('user');

test php example:

<?php

define('FRAMEWORK_PATH', './');
include FRAMEWORK_PATH.'db/db.interface.php';
include FRAMEWORK_PATH.'db/db_mongodb.class.php';

        $nodbconf = array(
                        'master' => array (
                                        'host' => '127.0.0.1:27017',
                                        'user' => '',
                                        'password' => '',
                                        'name' => 'test',
                                        'tablepre' => '',
                        ),
                        'slaves' => array (
                        )
        );


$nodb = new db_mongodb($nodbconf);

$nodb->truncate('user');
$nodb->maxid('user', 0);
$nodb->count('user', 0);

$uid = $nodb->maxid('user', '+1');

$r = $nodb->set("user-uid-$uid", array('username'=>'admin1', 'email'=>'xxx1@xxx.com', 'posts'=>1));

$uid = $nodb->maxid('user', '+1');
$r = $nodb->set("user-uid-$uid", array('username'=>'admin2', 'email'=>'xxx2@xxx.com', 'posts'=>2));

$uid = $nodb->maxid('user', '+1');
$r = $nodb->set("user-uid-$uid", array('username'=>'admin3', 'email'=>'xxx3@xxx.com', 'posts'=>3));

$n = $nodb->count('user', 3);

$arr = $nodb->get('user-uid-1');

$n = $nodb->index_update('user', array('uid'=>array('>='=>1)), array('posts'=>123));
$user = $nodb->get('user-uid-1');

$r = $nodb->delete("user-uid-1");

$n = $nodb->count('user', 2);

$n = $nodb->count('user');

$userlist = $nodb->index_fetch('user', array('uid'), array('uid' => array('>'=>0)), array(), 0, 10);
print_r($userlist);

?>


