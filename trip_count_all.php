<?php
include 'config.php';
include 'objects/trip.php';

$trip = new Trip();

$trip->taxiID = ($_POST['taxiid']) ? $_POST['taxiid'] : null;

$num = $trip->countAll();

echo $num;
