<?php
include 'config.php';
include 'objects/paycoin.php';

$paycoin = new Paycoin();
$paycoin->id = ($_POST['id']) ? $_POST['id'] : null;
if ($paycoin->id) $data = $paycoin->readOne();
else $data = array();

echo json_encode($data, JSON_UNESCAPED_UNICODE);
