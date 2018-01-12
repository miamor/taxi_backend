<?php
include 'config.php';
//if (!$_SESSION['taxi']) {
    include 'objects/taxi.php';
    $taxi = new Taxi();

    $taxi->id = isset($_POST['id']) ? $_POST['id'] : null;
    $data = array();

    if ($taxi->id) {
        $data = $taxi->readOneByID();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else echo -1;
//} else echo -2;
