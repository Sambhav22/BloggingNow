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
        <li class="active"><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>
            &nbsp;Dashboard</a></li>
        <li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Add New Post</a></li>
        <li><a href="Categories.php">
            <span class="glyphicon glyphicon-tags"></span>        &nbsp;Categories</a></li>
            <li><a href="Admins.php">
                <span class="glyphicon glyphicon-user"></span> &nbsp;Manage Admins</a></li>
        <li><a href="Comments.php">
            <span class="glyphicon glyphicon-comment"></span> &nbsp;Comments
            <?php 
                   $con;
                   $QueryTotal="Select count(*) from comments where status='OFF' ";
                   $ExecuteTotal=mysqli_query($con,$QueryTotal);
                   $RowsTotal=mysqli_fetch_array($ExecuteTotal);
                   $TotalTotal=array_shift($RowsTotal);
                 if($TotalTotal>0){
                        ?>
                <span class="label label-warning pull-right">   <?php echo $TotalTotal; ?>
                   </span>
                   
                  <?php } ?>     
               
            
            
            </a></li>
            <li><a href="#">
                <span class="glyphicon glyphicon"></span> &nbsp;Live Blog</a></li>
            <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> &nbsp;Logout</a></li>
        
        
        </ul>
        
    
    
    </div>
    
    
    
    <div class="col-sm-10">
    <div><?php echo Message(); 
       echo SuccessMessage();?></div>
        
        <h1>Admin Dashboard</h1>
        
        <div class="table-responsive">
        
            <table class="table table-striped table-hover">
            <tr>
                
                <th>No</th>
                <th>Post Title</th>
                <th>Date & Time</th>
                <th>Author</th>
                <th>Category</th>
                <th>Banner</th>
                <th>Comments</th>
                <th>Action</th>
                <th>Details</th>
                
                
                <?php
                $con;
                $ViewQuery ="select * from admin_panel order by datetime desc";
                $Execute=mysqli_query($con,$ViewQuery);
               $SrNo=0; while($DataRows=mysqli_fetch_array($Execute)){
                 $Id=$DataRows["id"];
                    $DateTime=$DataRows["datetime"];
                    $Title=$DataRows["title"];
                    $Category=$DataRows["category"];
                    $Admin=$DataRows["author"];
                    $Image=$DataRows["image"];
                    $Post=$DataRows["post"];
                    $SrNo++;
                ?>
                <tr>
                
                <td><?php echo $SrNo; ?></td>
                    <td style="color:blue"><?php 
                   
                   if(strlen($Title)>20){
                       $Title=substr($Title,0,20).'..';
                   }
                   echo $Title; ?></td>
                    <td><?php
                   
                    if(strlen($DateTime)>11){
                       $DateTime=substr($DateTime,0,11).'..';
                   }

                   
                   echo $DateTime; ?></td>
                    <td><?php 
                    if(strlen($Admin)>6){
                       $Admin=substr($Admin,0,6).'..';
                   }
                   
                   echo $Admin; ?></td>
                
                    
                    <td><?php
                   if(strlen($Category)>8){
                       $Category=substr($Admin,0,8).'..';
                   }
                   
                   
                   echo $Category; ?></td>
                    
                   
                    
                    <td><img src="Upload/<?php echo $Image; ?>" width="170px"; height="50px"></td>
                    
                    <td>
                    
                    
                    <?php 
                   $con;
                   $QueryApproved="Select count(*) from comments where admin_panel_id='$Id' and status='ON' ";
                   $ExecuteApproved=mysqli_query($con,$QueryApproved);
                   $RowsApproved=mysqli_fetch_array($ExecuteApproved);
                   $TotalApproved=array_shift($RowsApproved);
                 if($TotalApproved>0){
                        ?>
                <span class="label pull-right label-success">   <?php echo $TotalApproved; ?>
                   </span>
                   
                  <?php } ?> 
                   
                   
               <?php 
                   $con;
                   $QueryUnApproved="Select count(*) from comments where admin_panel_id='$Id' and status='OFF' ";
                   $ExecuteUnApproved=mysqli_query($con,$QueryUnApproved);
                   $RowsUnApproved=mysqli_fetch_array($ExecuteUnApproved);
                   $TotalUnApproved=array_shift($RowsUnApproved);
                 if($TotalUnApproved>0){
                        ?>
                <span class="label label-danger">   <?php echo $TotalUnApproved; ?>
                   </span>
                   
                  <?php } ?>     
                   
                    
                    
                    
                    
                    
                    
                    
                    
                    </td>

                    
                    <td>
                        <a href="EditPost.php?Edit=<?php echo $Id; ?>" >
                            <span class="btn btn-warning">Edit</span></a>  <a href="DeletePost.php?Delete=<?php echo $Id; ?>" >
                        <span class="btn btn-danger">delete</span></a></td>
                    
                    <td><a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary">Live Preview</a></span></td>
                
                
                
                
                    
                    
                    
                </tr>
                
  <?php         }     ?>
                
                
                
                
                
                
                
                
                
                </tr>
            
            
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
