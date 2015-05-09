<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

Retrieve and show the tweets of the user; 

-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <!--Create the UI of the page -->
        
        <p id="welcome"></p>
        
        <br>
        
        <p> Your Tweets :
        <?php
        // put your code here
        
        // create a connection to mysql, fetch the list of tweets and disply the tweets.
        session_start();
        
        function sanitize($input){
        $input = mysql_real_escape_string($input); // escapes \x00, \n, \r, \, ', " and \x1a
        return $input;
        }
        
        $home_current_user = $_SESSION["current_user"];
        
        if ($home_current_user!==null) {
        
        $home_server = "localhost:2023";
        $home_user= "appsecproject";
        $home_password= "appsecpass";
        
        $home_mysql_connection = new mysqli($home_server,$home_user,$home_password);
        
        if ($home_mysql_connection->connect_error){
            echo "Connection Failed !";
            die("Connection Failed: ".$home_mysql_connection->connect_error);
        }
        
        //echo "user is ".$home_current_user;
        $home_sanitized_current_user = sanitize($home_current_user);
        
        
        $home_select_db_query= "use appsecserver";
        
        if ($home_mysql_connection->query($home_select_db_query)===TRUE){
          //  echo "selected database";
        }  else {
            echo "unable to select database";
        }
        
        
        $home_select_tweets_query = "select tweet from tweets where userid = \"".$home_current_user."\";";
        
       // echo "query is ".$home_select_tweets_query;
        
        $home_tweets_select_results = $home_mysql_connection->query($home_select_tweets_query);
        
        
        if ($home_tweets_select_results->num_rows > 0){
            echo "<ul style=\"list-style-type:disc\">";
            while($row = $home_tweets_select_results->fetch_assoc()) {
            echo "<li>";    
             echo $row["tweet"];
            echo "</li>";    
            }
            echo "</ul>";
        } else {
            echo "You have zero tweets !";
        }
        
        }
        
        ?>
            
        </p>
        
        <script>
        
        var php_user = <?php echo json_encode($home_current_user) ?>;
        document.getElementById("welcome").innerHTML="Welcome, " +php_user +" .";

        </script>
        
        <textarea rows="3" style="position: absolute; width: 90%;" id="input_tweet"></textarea>
        <br><br><br>
        <button id="add_tweet" onclick="posttweet()" >Tweet</button>
        <br><br><br>
        <p id="status"></p>
        <br><br><br>
        <button id="image_upload" onclick="upload_image()">Upload Image</button>
        <br><br><br>
        <button id="log_out" onclick="logout()">Logout</button>
        
        <script>
        
        function posttweet() {
        var user_tweet = document.getElementById("input_tweet").value;
        var encoded_tweet =    encodeURIComponent(user_tweet);
        
        var xmlhttp;
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                      
                      var ajax_response = xmlhttp.responseText;
                      console.log("Executed post tweet script: " + ajax_response);  
                      if (ajax_response==="tweet added!"){
                          location.reload();
                          document.getElementById("status").innerHTML="Bravo ! Your tweet was posted! ";
                      }
                    }
            }
            xmlhttp.open("GET","post_tweet.php?tweet=" + encoded_tweet,true);
            xmlhttp.send();
        
    }
    
    
    function logout() {
        
        var myxmlhttp;
        if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                myxmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                myxmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            
            myxmlhttp.onreadystatechange=function() {
                   console.log("Logged Out! "); 
            }
            myxmlhttp.open("GET","logout.php",true);
            myxmlhttp.send();
            location.reload();
        
    }
    
    function upload_image(){
        window.open("fileupload.php");
    }
    
         </script>
        
        
    </body>
</html>
