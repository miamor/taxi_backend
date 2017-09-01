<?php
include 'config.php';
include 'objects/infrienge.php';

$infrienge = new Infrienge();
$infrienge->id = ($_POST['id']) ? $_POST['id'] : null;
if ($infrienge->id) $data = $infrienge->readOne();
else $data = array();

echo json_encode($data, JSON_UNESCAPED_UNICODE);
