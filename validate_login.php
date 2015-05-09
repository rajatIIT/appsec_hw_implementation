<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();


$login_user_id = $_GET["user_id"];

$login_hash = $_GET["user_hash"];

//echo "Input Hash: ".$login_hash;

$login_mysql_server = "localhost:2023";
$login_mysql_username = "appsecproject";
$login_mysql_password = "appsecpass";


$login_mysql_conn = new mysqli($login_mysql_server,$login_mysql_username,$login_mysql_password);

if ($login_mysql_conn->connect_error){
    echo "connection failed !";
    die("Connection Failed: ". $login_mysql_conn->connect_error);
}



//echo "<br>";
// selecct the proper database
$login_select_db_query = "use appsecserver";

if ($login_mysql_conn->query($login_select_db_query)=== TRUE)
{
  //  echo "selected database";
} else {
    echo "unable to select database";
}

//echo "<br>";

// check the hash

$login_fetch_hashquery= "select hash from users where userid= \""
        . $login_user_id."\";";
//echo "query is: ".$login_fetch_hashquery;

//echo "<br>";

$login_query_execution_result  = $login_mysql_conn->query($login_fetch_hashquery);

$login_fetch_query_result = $login_query_execution_result->fetch_assoc();

$login_fetch_qury_first_row = $login_fetch_query_result["hash"];

//echo "Fetched hash: ".$login_fetch_qury_first_row;

//echo "<br>";
if ($login_fetch_qury_first_row===$login_hash)
{
    echo "you are authenticated";
    $_SESSION["current_user"]=$login_user_id;
    
} else {
    echo "unable to authenticate";
    $_SESSION["current_user"]=null;
}
    
?>
