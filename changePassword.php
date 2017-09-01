<?php
include 'config.php';
//if (!$_SESSION['taxi']) {
    include 'objects/taxi.php';
    $taxi = new Taxi();

    $taxi->id = isset($_POST['taxiid']) ? $_POST['taxiid'] : null;
    $taxi->password = isset($_POST['password']) ? $_POST['password'] : null;

//    echo $_POST['username'];

    if ($taxi->id && $taxi->password) {
        $do = $taxi->updatePassword();
        echo ($do ? $taxi->passwordHash : 0);
    } else echo -1;
//} else echo -2;
