<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        
        
        <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha3.js"></script>
        <script>
        function createaccount() {
            
            // fire a request to the server with the hash
            
            var supplied_username = document.getElementById("userid").value;
            var supplied_password = document.getElementById("pass").value;
            var computed_hash = CryptoJS.SHA3(supplied_password);
            console.log("Hash is " + computed_hash);
            
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
                        
                      console.log("Executed account creation script: " + xmlhttp.responseText);  
                      document.getElementById("status").innerHTML="Registration Complete!";
                        
                    }
            }
            xmlhttp.open("GET","createaccount.php?userid=" + supplied_username + "&hash=" + computed_hash,true);
            xmlhttp.send();
            
            
            
            
            
            
        }
        
        
        </script>
        
        <input id="userid" style="position: absolute; top: 40%; left: 50%" type="text" value="user id">
        Password: <input id="pass" style="position: absolute; top: 45%; left: 50%" type="password" value="password">
        
        <button id="registerbutton" style="position: absolute; top: 50%; left: 50%" onclick="createaccount()">Register</button>
        <p id="status" style="position: absolute; top: 60%; left: 50%"></p>
        
        <?php
        // put your code here
        ?>
        
        
        
    </body>
</html>
