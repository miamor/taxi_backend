<?php
include 'config.php';
include 'objects/infrienge.php';

$infrienge = new Infrienge();

//$infrienge->taxiid = $_SESSION['taxi'];
$infrienge->taxiid = ($_POST['taxiid']) ? $_POST['taxiid'] : null;
$data = $infrienge->readAllOneTaxi();

echo json_encode($data, JSON_UNESCAPED_UNICODE);
