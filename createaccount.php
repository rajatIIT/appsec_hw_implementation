<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

function sanitize($input){
       $input = mysql_real_escape_string($input); // escapes \x00, \n, \r, \, ', " and \x1a
        return $input;
}

$user = $_GET["userid"];
        
$hash =  $_GET["hash"];

$mysql_servername = 'localhost:2023';
$mysql_user = 'appsecproject';
$mysql_pass = 'appsecpass';

$mysql_conn = new mysqli($mysql_servername,$mysql_user,$mysql_pass);

// Check connection
if (!$mysql_conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$select_db_query = "use appsecserver";


if ($mysql_conn->query($select_db_query)=== TRUE){
    echo "selected database";
} else {
    echo "unable to select database";
}


$sanitized_user = sanitize($user);

$sanitized_hash = sanitize($hash);

$create_account_query = "insert into users(userid,hash) "
        . "values (\""
        . $sanitized_user
        . "\", \""
        . $sanitized_hash."\");";

echo "The query is ".$create_account_query;

echo "<br>";

//$sanitized_create_account_query = sanitize($create_account_query);

echo "The sanitized query is ".$create_account_query;

echo "<br>";

if ($mysql_conn->query($create_account_query) === TRUE) {
    echo "created account";
    
}