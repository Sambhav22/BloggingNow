<?php

include "include/db.php";
 require_once("Include/Sessions.php"); 
require_once("Include/Functions.php"); 
?>
<?php
if(isset($_GET['id'])){
    
  $idfromURL=$_GET['id'];
    $con;
    $Query="Update comments SET status='ON' where id='$idfromURL' ";
    
$Execute=mysqli_query($con,$Query);
    if($Execute){
        $_SESSION["SuccessMessage"]="Comments Approved Successfully";
        Redirect_to("Comments.php");
    }
    else{
        if($Execute){
        $_SESSION["ErrorMessage"]="Something went wrong.Try again";
        Redirect_to("Comments.php");
    }
    }
    
    
}



?>