<?php
require_once 'MysqliDb.php';
$db = new MysqliDb ('localhost', 'root', '', 'mer_system');
$GLOBALS['db']=$db;