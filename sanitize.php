<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



//$sanitized_string = FILTER_SANITIZE_STRING($_GET["str"]);
function sanitize($input){
    

       // $input = htmlentities($input); // convert symbols to html entities
     //   $input = addslashes($input); // server doesn't add slashes, so we will add them to escape ',",\,NULL
        $input = mysql_real_escape_string($input); // escapes \x00, \n, \r, \, ', " and \x1a
        return $input;
    
}

$user = $_GET["user"];
//$hash = $_GET["hash"];

$mysql_servername = "localhost:2023";
$mysql_user = "appsecproject";
$mysql_pass = "appsecpass";


$mysql_conn = new mysqli($mysql_servername,$mysql_user,$mysql_pass);


if ($mysql_conn->connect_error) {
    echo "Connection failed";
    die("Connection failed: " . $mysql_conn->connect_error);
}


$select_db_query = "USE appsec"; 



if($mysql_conn->query($select_db_query)===TRUE)
{
    echo "selected database.";
} else {
    echo "unable to select database: ".$mysql_conn->error;
}
    

$select_query= "select di,pass from myusers where di= "
        ."'".$user
        ."'";

$sanitized_select_query = sanitize($select_query);

echo " executing string: ".$sanitized_select_query;

$select_result = $mysql_conn->query($select_query);





    // output data of each row
$row = $select_result->fetch_assoc();
        
//echo "id: " . $row["di"];




//echo " - Name: " . $row["pass"];
    


$mysql_conn->close();


/*

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>

*/