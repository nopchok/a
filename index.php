<?php

$ch =  curl_init('https://bittrex.com/api/v1.1/public/getmarketsummaries');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
$bittrex = curl_exec($ch);
$bit = json_decode($bittrex,true)['result'];

$ch =  curl_init('https://poloniex.com/public?command=returnTicker');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
$poloniex = curl_exec($ch);
$polo = json_decode($poloniex,true);

foreach( $bit as $k => $v ){
    $bitnew[ $bit[$k]['MarketName'] ][0] = $bit[$k]['Bid'];
    $bitnew[ $bit[$k]['MarketName'] ][1] = $bit[$k]['Ask'];
}
foreach( $polo as $k => $v ){
    if( substr($k,0,3) === 'BTC' ){
        $alt = str_replace("_","-",$k);
        if( $polo[$k]['highestBid'] > $bitnew[$alt][1] && $bitnew[$alt][1]>0 ){
            echo $alt.' '.($polo[$k]['highestBid']-$bitnew[$alt][1])/$bitnew[$alt][1].'<br>';
            }
    }
}

//print_r($bittrex);
