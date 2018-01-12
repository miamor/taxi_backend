<?php
include 'config.php';

//echo $_SESSION['taxi'];


include 'objects/taxi.php';
include 'objects/trip.php';

$taxi = new Taxi();
$trip = new Trip();
$trip->id = ($_POST['id']) ? $_POST['id'] : null;
$taxi->id = ($_POST['taxiid']) ? $_POST['taxiid'] : null;
if ($trip->id) {
    $tripData = $trip->readOneFull();
    $end_time = new DateTime($trip->time);
    $now = new DateTime("now");

    if ($end_time > $now) {
        $taxi->getCoin();
        //echo $taxi->coin.'~'.$tripData['coin'];
        if ($trip->id && $tripData['status'] == 0) {
            if ($taxi->coin >= $tripData['coin']) {
                $trip->taxiID = $taxi->id;
                $taxi->substractCoin($tripData['coin']);
                $data = $trip->buy($tripData['coin']);
                echo $data;
            } else echo -1; // not enough money
        } else echo -3; // trip is taken or not exist
    } else echo -4; // out of date
}
else echo -2; // no trip found

// echo json_encode($data, JSON_UNESCAPED_UNICODE);
