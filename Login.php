<?php

include "include/db.php";
 require_once("Include/Sessions.php"); 
require_once("Include/Functions.php"); 
?>

<?php
if(isset($_POST['Submit'])){

    $Username=$_POST["UserName"];
    $Password=$_POST["Password"];
    
    if(empty($Username) || empty($Password)){
        
        $_SESSION['ErrorMessage']= "All fields must be filled out";
        Redirect_to("Login.php");
        exit;
    }
    
    
    else
    {
        global $con;
        $Query="Select * from registration where username='$Username' and password='$Password'";
        $Execute=mysqli_query($con,$Query);
if($admin=mysqli_fetch_assoc($Execute)){
           $_SESSION["User_Id"]=$admin['id'];
    
    $_SESSION["Username"]=$admin['username'];
    
    
    
    
    $_SESSION["SuccessMessage"]="Welcome back"." ".$admin['username'];
           
        Redirect_to("Dashboard.php");
            }
        else{
            $_SESSION["ErrorMessage"]="Invalid username/password";
           }
           
        }
    }
           
           

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Manage Admins</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
    
    <link rel="stylesheet" href="css/adminstyles.css">
 <style>
     .FieldInfo{
         color:rgb(251,174,44);
         font-family: Bitter,Georgia,"Times New Roman",Times,serif;
         font-size:1.2em;
         
     }
     body{
      background-color: #ffffff;   
     }
    
    
    </style>
   </head>
<body>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <div style="height:10px background:#27aae1;"></div>
    
    <nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        
        <div class="navbar-header">
            
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
            <span class="sr-only">
                Toggle navigation
                </span><span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            
            </button>
            
       <a class="navbar-brand" href="Blog.php"> <img src="icon/Free_Sample_By_Wix.jpg" width=200; height=30;></a>
        
        </div>
        <div id="collapse" class="collapse navbar-collapse" >
        <ul class="nav navbar-nav">
        <li><a href="#">Home</a></li>
           
            <li class="active"><a href="Blog.php">Blog</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Features</a></li>
        
        
        
        
        </ul>
            
        <form action="Blog.php" class="navbar-form navbar-right">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search" name="Search">
            
            
            
            </div>
        
        <button class="btn btn-default" name="SearchButton">Go</button>
        </form>
        
        </div>
        </div>
    
    
    
    </nav>
    
<div class="container-fuild">
<div class="row">
    
    
        
    
    <div class="col-sm-offset-4 col-sm-4"><br><br>
        <?php echo Message(); 
       echo SuccessMessage();?>
    
    
        <h2>Welcome back</h2>
<div>        
  <form  method="post" action="Login.php">
      <fieldset>
          <div class="form-group">
              
              <label for="UserName"><span class="FieldInfo">UserName:</span></label>
               <div class="input-group input-group-lg">   
                  <span class="input-group-addon">
                   <span class="glyphicon-envelope"></span>
                   </span>
      <input class="form-control" type="text" name="UserName" id="UserName" placeholder="UserName">
          </div>
              </div>
          
    
          <div class="form-group">
              <label for="Password"><span class="FieldInfo">Password:</span></label>
              
              <div class="input-group input-group-lg">   
                  <span class="input-group-addon">
                   <span class="glyphicon glyphicon-eye-close"></span>
                   </span>

              
              
      <input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
          </div>
          
          
          
          
          
          
          </div>          
              <br>
          <div>   
          <input class="btn btn-info btn-block" type="submit" name="Submit" value="Login">
      <br>
              
      </div>
      
      </fieldset>
    
    
    
    
    
    </form>      
        
        
  
    
<br><br>
    <br><br>
    

</div>
</div>
    </div>
    
<div id="Footer">

    <hr>
    <p><br>Theme By | Sambhav Jain |&copy;2019 --- ALL right reserved.</p>
    <p>This site is only for study purpose and all rights have been reserved &trade;</p>
    <hr>
    
    </div>
    <div style="height:10px; background:#27AAE1;"></div>
    
    
    
    </div>





</body>
</html>
