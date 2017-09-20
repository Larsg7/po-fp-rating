<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

require "./IO.php";

use FP_RATING\IO;
const RATING_FILE = "./rating.dat";
const PASSPHRASE = "eeec021898eec14f9c7c888c5899a81ad4dbf1ae";

$passphrase = $_POST['passphrase'];

$io = new IO(RATING_FILE);
if ($passphrase == PASSPHRASE)
{
    if (isset($_POST['stars']))
    {
        $stars = $_POST['stars'];
        $feedback = $_POST['feedback'];
        $io->writeRating($stars, $feedback);
        echo "SUCCESS";
    }
} else {
    echo $io->readRatings();
}