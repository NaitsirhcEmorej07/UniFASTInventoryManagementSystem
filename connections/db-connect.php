<?php
        
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "inventory_system";
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$db);
        
        
        if(!$conn)
        {
            die('Connection Failed'.mysqli_connect_error());
        }
        else
        {
            return $conn;
        }
?>