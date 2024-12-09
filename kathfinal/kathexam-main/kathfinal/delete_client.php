<?php

//start session
session_start();

if(!isset($_SESSION['username']) || $_SESSION ['role'] != 'admin')
{
    header("Location: index.php");
    exit();
}

//include connection string
include('db/connection.php');

//check if client ID is provided in the URL

if(isset($_GET['ID'])){
    //Get the ID value
    $client_id = $_GET ['ID'];
    //Delete the client from the database
    $delete_sql ="DELETE FROM users WHERE ID='$client_id'";

    if($conn->query($delete_sql) === TRUE){
        header("Location: admin_dashboard.php?deletesuccess");
    }
    else{
        echo "Error Deleting Client:  ".$conn->error;
    }

}
else{
    //no client ID redirect to admin dashboard
    header("Location: admin_dashboard.php");
}

?>