<?php
function Redirect_to($New_Location){
    header("Location:".$New_Location);
    exit;
}
function Login(){
    if(isset($_SESSION["User_Id"]
    )){
        return true;
    }
}
function Confirm_Login(){
    if(!Login()){
        $_SESSION["ErrorMessage"]="Login Required";
        Redirect_to("Login.php");
    }
}






?>