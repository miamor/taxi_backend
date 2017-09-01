<?php
include 'config.php';
include 'objects/paycoin.php';

$paycoin = new Paycoin();

//$paycoin->taxiid = $_SESSION['taxi'];
$paycoin->taxiid = ($_POST['taxiid']) ? $_POST['taxiid'] : null;
$data = $paycoin->readAllOneTaxi();

echo json_encode($data, JSON_UNESCAPED_UNICODE);
