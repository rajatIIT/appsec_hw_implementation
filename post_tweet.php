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

$post_tweet = $_GET["tweet"];
$post_current_user = $_SESSION["current_user"];

$post_server_name= "localhost:2023";
$post_server_user = "appsecproject";
$post_server_password = "appsecpass";


$post_mysql_conn = new mysqli($post_server_name,$post_server_user,$post_server_password);
        
if  (!$post_mysql_conn){
    die("Conection Failed: ".$post_mysql_conn->connect_error);
}


// select database
$post_select_query = "use appsecserver";


if ($post_mysql_conn->query($post_select_query)=== TRUE) {
    
} else {
    echo "unable to select database";
}

$post_sanitized_user_name = sanitize($post_current_user);

// commit result to table;

$post_commit_tweet_query = "insert into tweets(userid,tweet) values"
        ."(\""
        .$post_sanitized_user_name
        ."\",\""
        .$post_tweet 
        ."\");";

//echo "executing query: ".$post_commit_tweet_query;

if ($post_mysql_conn->query($post_commit_tweet_query)=== TRUE)
echo "tweet added!";



