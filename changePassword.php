<?php
include 'config.php';
//if (!$_SESSION['taxi']) {
    include 'objects/taxi.php';
    $taxi = new Taxi();

    $taxi->id = isset($_POST['taxiid']) ? $_POST['taxiid'] : 1;
    $taxi->password = isset($_POST['password']) ? $_POST['password'] : 'abc123';

//    echo $_POST['username'];

    if ($taxi->id && $taxi->password) {
        $do = $taxi->updatePassword();
        $data = array('newPassword'=>$taxi->passwordHash);
        echo ($do ? $data : 0);
    } else echo -1;
//} else echo -2;
