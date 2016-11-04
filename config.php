<?php
require_once 'MysqliDb.php';
$db = new MysqliDb ('localhost', 'root', 'p@$$w0rd', 'mer_system');
$GLOBALS['db']=$db;
