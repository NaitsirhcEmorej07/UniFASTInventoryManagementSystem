<?php
        $TBL_UNIFAST_STAFF = "tbl_unifast_staff";
        $TBL_INVENTORY = "tbl_ims_items";
        $TBL_END_USER = "tbl_ims_end_user";
        $TBL_LOGS = "tbl_ims_logs";
        $TBL_UNIFAST_USER ="tbl_unifast_user";


        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "inventory_system";


        // $dbhost = "localhost";
        // $dbuser = "unifastgov_lmpc";
        // $dbpass = "7_d[MJB(#l8A";
        // $db = "unifastgov_ufdb";
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