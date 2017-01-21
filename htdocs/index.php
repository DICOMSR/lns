<?php
// TODO エラー処理
ini_set('display_errors', 1);

require_once('../lib/common/Define.php');
require_once('../lib/common/Dispatcher.php');

$oDispatcher = new Dispatcher();
$oDispatcher->dispatch();
