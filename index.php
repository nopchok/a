<?php

$ch =  curl_init('https://poloniex.com/public?command=returnTicker');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
$poloniex = curl_exec($ch);

$ch =  curl_init('https://bittrex.com/api/v1.1/public/getmarketsummaries');
$bittrex = curl_exec($ch);

print_r($bittrex);
