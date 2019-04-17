<?php

include "include/db.php";
 require_once("Include/Sessions.php"); 
require_once("Include/Functions.php"); 
?>
<?php Confirm_Login(); ?>
<?php
if(isset($_POST['Submit'])){

    $Category=$_POST["Category"];
         
    date_default_timezone_set("Asia/Karachi");
$CurrentTime=time();

$DateTime=strftime("%B-%d-%Y  %H:%M:%S",$CurrentTime);
    $Admin=$_SESSION["Username"];
    
    if(empty($Category)){
        
        $_SESSION['ErrorMessage']= "All fields must be filled out";
        Redirect_to("Categories.php");
        exit;
    }
    elseif(strlen($Category)>99){
        $_SESSION['ErrorMessage']= "Too long Name for Category";
        Redirect_to("Categories.php");
        
    }else{
        
        global $con;
        $Query="Insert into category(datetime,name,creatorname) values('$DateTime','$Category','$Admin')";
        $Execute=mysqli_query($con,$Query);
        if($Execute){
        $_SESSION['SuccessMessage']= "Category Added Successfully";
        Redirect_to("Categories.php");
            
        }else{
            
            $_SESSION['ErrorMessage']= "Category failed to add";
        Redirect_to("Categories.php");
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
  <title>Admin Dashboard</title>
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
        <li class="active"><a href="Categories.php">
            <span class="glyphicon glyphicon-tags"></span>        &nbsp;Categories</a></li>
            <li><a href="Admins.php">
                <span class="glyphicon glyphicon-user"></span> &nbsp;Manage Admins</a></li>
        <li><a href="Comments.php">
            <span class="glyphicon glyphicon-comment"></span> &nbsp;Comments</a></li>
            <li><a href="#">
                <span class="glyphicon glyphicon"></span> &nbsp;Live Blog</a></li>
            <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> &nbsp;Logout</a></li>
        
        
        </ul>
        
    
    
    </div>
    
    
    
    <div class="col-sm-10">
    
        <h1>Manage Categories</h1>
<div>        
  <form  method="post" action="Categories.php">
      <fieldset>
          <div class="form-group">
              <label for="categoryname"><span class="FieldInfo">Name:</span></label>
      <input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name">
              <br>
              <input class="btn btn-success btn-block" type="submit" name="Submit" value="Add New Category">
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
                <th>Category Name</th>
            <th>Creator Name</th>
            </tr>
            <?php
            global $con;
            $ViewQuery="Select *from category order by datetime desc";
           $SrNo=0; $Execute=mysqli_query($con,$ViewQuery);
            while($DataRows=mysqli_fetch_array($Execute)){
                
                
                $Id=$DataRows["id"];
                $DateTime=$DataRows["datetime"];
                $CategoryName=$DataRows["name"];
                 $CreatorName=$DataRows["creatorname"];
                
            $SrNo++;
            
            
            
            
            ?>
            
            <tr>
            <td><?php echo $SrNo; ?></td>
            <td><?php echo $DateTime; ?></td>
                <td><?php echo $CategoryName; ?></td>
                <td><?php echo $CreatorName; ?></td>
            
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
