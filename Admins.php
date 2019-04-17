<?php

include "include/db.php";
 require_once("Include/Sessions.php"); 
require_once("Include/Functions.php"); 
?>
<?php Confirm_Login(); ?>

<?php
if(isset($_POST['Submit'])){

    $Username=$_POST["UserName"];
    $Password=$_POST["Password"];
    $ConfirmPassword=$_POST["ConfirmPassword"];
         
    date_default_timezone_set("Asia/Karachi");
$CurrentTime=time();

$DateTime=strftime("%B-%d-%Y  %H:%M:%S",$CurrentTime);
    $Admin=$_SESSION["Username"];
    
    if(empty($Username) || empty($Password) || empty($ConfirmPassword)){
        
        $_SESSION['ErrorMessage']= "All fields must be filled out";
        Redirect_to("Admins.php");
        exit;
    }
    elseif(strlen($Password)<4){
        $_SESSION['ErrorMessage']= "Atleast 4 characters needed";
        Redirect_to("Admins.php");
        
    }
    elseif($Password !==$ConfirmPassword){
        $_SESSION['ErrorMessage']= "Confirm Password does not match";
        Redirect_to("Admins.php");
        
    }
    
    
    else{
        
        global $con;
        $Query="Insert into registration(datetime,username,password,addedby) values('$DateTime','$Username','$Password','$Admin')";
        $Execute=mysqli_query($con,$Query);
        if($Execute){
        $_SESSION['SuccessMessage']= "Admin Added Successfully";
        Redirect_to("Admins.php");
            
        }else{
            
            $_SESSION['ErrorMessage']= "Category failed to add";
        Redirect_to("Admin.php");
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
        <li><a href="Blog.php">Home</a></li>
           
            <li class="active"><a href="Blog.php" target="_blank">Blog</a></li>
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
    <div class="Line" style="height:10px; background:#27aae1;"></div>
<div class="container-fuild">
<div class="row">
    
    
    <div class="col-sm-2">
    
    <?php echo Message(); 
       echo SuccessMessage();?>
        <ul id="Side_Menu" class="nav nav-pills nav-stacked">
        <li><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>
            &nbsp;Dashboard</a></li>
        <li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Add New Post</a></li>
        <li><a href="Categories.php">
            <span class="glyphicon glyphicon-tags"></span>        &nbsp;Categories</a></li>
            <li class="active" ><a href="Admins.php">
                <span class="glyphicon glyphicon-user"></span> &nbsp;Manage Admins</a></li>
        <li><a href="Comments.php">
            <span class="glyphicon glyphicon-comment"></span> &nbsp;Comments</a></li>
            <li><a href="#">
                <span class="glyphicon glyphicon"></span> &nbsp;Live Blog</a></li>
            <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> &nbsp;Logout</a></li>
        
        
        </ul>
        
    
    
    </div>
    
    
    
    <div class="col-sm-10">
    
        <h1>Manage Admins</h1>
<div>        
  <form  method="post" action="Admins.php">
      <fieldset>
          <div class="form-group">
              <label for="UserName"><span class="FieldInfo">UserName:</span></label>
      <input class="form-control" type="text" name="UserName" id="UserName" placeholder="UserName">
          </div>
          
    
          <div class="form-group">
              <label for="Password"><span class="FieldInfo">Password:</span></label>
      <input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
          </div>
          <div class="form-group">
              <label for="ConfirmPassword"><span class="FieldInfo">Confirm Password:</span></label>
      <input class="form-control" type="password" name="ConfirmPassword" id="ConfirmPassword" placeholder="Confirm Password">
          </div>
          
          
          
          
          
          
          
              <br>
          <div>   
          <input class="btn btn-success btn-block" type="submit" name="Submit" value="Add New Admin">
      <br>
              
      </div>
      
      </fieldset>
    
    
    
    
    
    </form>      
        
        
       
    </div>
        <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr>
            
            <th>Sr No.</th>
                <th>Date & Time</th>
                <th>Admin Name</th>
            <th>Added By</th>
                
            </tr>
            <?php
            global $con;
            $ViewQuery="Select *from registration order by datetime desc";
           $SrNo=0; $Execute=mysqli_query($con,$ViewQuery);
            while($DataRows=mysqli_fetch_array($Execute)){
                
                
                $Id=$DataRows["id"];
                $DateTime=$DataRows["datetime"];
                $Username=$DataRows["username"];
                 $Admin=$DataRows["addedby"];
                
            $SrNo++;
            
            
            
            
            ?>
            
            <tr>
            <td><?php echo $SrNo; ?></td>
            <td><?php echo $DateTime; ?></td>
                <td><?php echo $Username; ?></td>
                <td><?php echo $Admin; ?></td>
            
            </tr>
            <?php }?>
            </table>
        
        
        
        </div>
    
    

</div>
</div>
<div id="Footer">
<hr><p>Theme By | Sambhav Jain |&copy;2019 --- ALL right reserved.</p>
    <p>This site is only for study purpose and all rights have been reserved &trade;</p>
    <hr>
    
    </div>
    <div style="height:10px; background:#27AAE1;"></div>
    
    
    
    </div>





</body>
</html>
