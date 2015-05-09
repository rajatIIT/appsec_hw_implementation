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
        <?php
        // put your code here
        ?>
        
        <input id="login_userid" style="position: absolute; top: 40%; left: 50%" type="text" value="ID">
        <input id="login_pass" style="position: absolute; top: 45%; left: 50%" type="password" value="password">
        
        <button id="login_button" style="position: absolute; top: 50%; left: 50%" onclick="check()">Login</button>
        <p id="status" style="position: absolute; top: 60%; left: 50%"></p>
        
        
        <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/sha3.js"></script>
        <script>
        
        function check() {
        var login_uname = document.getElementById("login_userid").value;
        var login_pass = document.getElementById("login_pass").value;
        var login_hash = CryptoJS.SHA3(login_pass);
        
        // now check if this value actuually exists ? 
        
        
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
                var result_text=xmlhttp.responseText;
                
                console.log("result text is " + result_text);
                
                if (result_text==="you are authenticated"){
                    
                    window.open("home.php");
                    
                } else {
                    
                    document.getElementById("status").innerHTML="Unable to authenticate !";
                    
                }
                
        }
        };
        

        
        xmlhttp.open("GET","validate_login.php?user_id="+ login_uname + "&user_hash=" + login_hash,true);
        
    
        xmlhttp.send();
        
        
        
    }
        
        </script>
        

        
        
        
    </body>
</html>
