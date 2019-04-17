<?php require_once("Include/DB.php"); ?>
<?php 
require_once("Include/Functions.php");
require_once("Include/Sessions.php");
include "include/db.php";?>
<?php Confirm_Login(); ?>
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
    <br><br>
    
        <ul id="Side_Menu" class="nav nav-pills nav-stacked">
        <li ><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>
            &nbsp;Dashboard</a></li>
        <li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Add New Post</a></li>
        <li><a href="Categories.php">
            <span class="glyphicon glyphicon-tags"></span>        &nbsp;Categories</a></li>
            <li><a href="Admins.php">
                <span class="glyphicon glyphicon-user"></span> &nbsp;Manage Admins</a></li>
        <li class="active"><a href="Comments.php">
            <span class="glyphicon glyphicon-comment"></span> &nbsp;Comments</a></li>
            <li><a href="#">
                <span class="glyphicon glyphicon"></span> &nbsp;Live Blog</a></li>
            <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> &nbsp;Logout</a></li>
        
        
        </ul>
        
    
    
    </div>
    
    
    
    <div class="col-sm-10">
    <div><?php echo Message(); 
       echo SuccessMessage();?></div>
        
        <h1>Un-Approved Comments</h1>
        
       <div class="table-responsive">
           
           <table class="table table-striped table-hover">
           
           <tr>
               <th>No.</th>
               <th>Name</th>
               <th>Date</th>
               <th>Comment</th>
               <th>Approve</th>
               <th>Delete Comment</th>
               <th>Details</th>
               
               
               </tr>
           
               
               <?php
               $con;
               $Query="Select * from comments where status='OFF' order by datetime desc";
               $Excute=mysqli_query($con,$Query);
               
               $SrNo=0;
                   while($DataRows=mysqli_fetch_array($Excute)){
                   $CommentId=$DataRows['id'];
                   
                   
                   
                   $DateTimeofComment=$DataRows['datetime'];
                   
                   
                   $PersonName=$DataRows['name'];
                   
                   $PersonComment=$DataRows['comment'];
                   
                   
                   $CommentedPostId=$DataRows['admin_panel_id'];
                   
                   
                   $SrNo++;
                       
if(strlen($PersonComment)>18){
    $PersonComment =substr($PersonComment,0,10).'..';}
                       if(strlen($PersonName)>10){
                           $PersonName =substr($PersonName,0,10).'..';
                       }

                       
                       
                       ?>
               <tr>
               <td><?php echo $SrNo;?></td>
               
                   <td style="color:#5e5eff";><?php echo $PersonName;?></td>
                   <td><?php echo $DateTimeofComment;?></td>
               
                   <td><?php echo $PersonComment;?></td>
                   <td><a href="ApproveComments.php?id=<?php echo $CommentId; ?>"><span class="btn btn-success">Approve</span></a></td>
                   
                   
                   
                   <td><a href="DeleteComments.php?id=<?php echo $CommentId;?>"><span class="btn btn-danger">Delete</span></a></td>
                   
                   
                   <td><a href="?id=<?php echo $CommentedPostId; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
                   
                   
                   <?php } ?>
               
               
               
               
               </tr>
                   
                   
                   
                   
               
               
               
               
               
               
               
               
           
           </table>
           
           
        
        
        
        
        
    </div>
        
        
        
        
        
        <h1>Approved Comments</h1>
        
       <div class="table-responsive">
           
           <table class="table table-striped table-hover">
           
           <tr>
               <th>No.</th>
               <th>Name</th>
               <th>Date</th>
               <th>Comment</th>
               <th>Approved by</th>
               <th>Revert Approve</th>
               <th>Delete Comment</th>
               <th>Details</th>
               
               
               </tr>
           
               
               <?php
               $con;
               $Admin="Jazeb Akram";
               $Query="Select * from comments where status='ON' order by datetime desc";
               $Excute=mysqli_query($con,$Query);
               
               $SrNo=0;
                   while($DataRows=mysqli_fetch_array($Excute)){
                   $CommentId=$DataRows['id'];
                   
                   
                   
                   $DateTimeofComment=$DataRows['datetime'];
                   
                   
                   $PersonName=$DataRows['name'];
                   
                   $PersonComment=$DataRows['comment'];
                   
                   
                   $CommentedPostId=$DataRows['admin_panel_id'];
                   
                   
                   $SrNo++;
                       if(strlen($PersonComment)>18){
    $PersonComment =substr($PersonComment,0,10).'..';}
                       if(strlen($PersonName)>10){
                           $PersonName =substr($PersonName,0,10).'..';
                       }

                       ?>
               <tr>
               <td><?php echo $SrNo;?></td>
               
                   <td style="color:#5e5eff";><?php echo $PersonName;?></td>
                   <td><?php echo $DateTimeofComment;?></td>
               
                   <td><?php echo $PersonComment; ?></td>
                   <td><?php echo $Admin;?></td>
                   <td><a href="DisApproveComments.php?id=<?php echo $CommentId; ?> "><span class="btn btn-warning">Dis-Approve</span></a></td>
                   
                   
                   
                   <td><a href="DeleteComments.php?id=<?php echo $CommentId;?>"><span class="btn btn-danger">Delete</span></a></td>
                   
                   
                   <td><a href="FullPost.php?id=<?php echo $CommentedPostId; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a></td>
                   
                   
                   <?php }?>
               
               
               
               
               </tr>
                   
                   
                   
                   
               
               
               
               
               
               
               
               
           
           </table>
           
           
        
        
        
        
        
    </div>
    
    
    

</div>
</div><br><br><br><br><br>
<div id="Footer">
<hr><p>Theme By | Sambhav Jain |&copy;2019 --- ALL right reserved.</p>
    <p>This site is only for study purpose and all rights have been reserved &trade;</p>
    <hr>
    
    </div>
    <div style="height:10px; background:#27AAE1;"></div>
    
    
    
    </div>





</body>
</html>
