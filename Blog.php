<?php

include "include/db.php";
 require_once("Include/Sessions.php"); 
require_once("Include/Functions.php"); 
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Blogging Now</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
    
    <link rel="stylesheet" href="css/publicstyles.css">
 
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
        <li class="active"><a href="Blog.php">Home</a></li>
           
            <li><a href="Blog.php">Blog</a></li>
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
    <div class="container">
        <div class="blog-header">
            <br><br>
    <h1>Welcome to Blogging Now</h1>
            <p class="lead">Best Blogging Website till Date</p>
    <br><br><br>
        </div>
        
        <div class="row">
        <div class="col-sm-8">
            
            
           <?php
            global $con;
            if(isset($_GET["SearchButton"])){
                
                $Search=$_GET['Search'];
                $ViewQuery="SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%' 
                OR title LIKE '%$Search%' OR post LIKE '%$Search%' ";
                
                
            }
            elseif(isset($_GET["Category"])){
                
                $Category=$_GET["Category"];
                $ViewQuery="Select * from admin_panel where category='$Category' order by datetime desc";
                
                
                
                
            }
            
            
            else{
            
            
            $ViewQuery="Select * from admin_panel order by datetime desc";} 
           $Execute= mysqli_query($con,$ViewQuery);
            while($DataRows=mysqli_fetch_array($Execute)){
                
               $PostId= $DataRows["id"];
                $DateTime=$DataRows["datetime"];
                $Title=$DataRows["title"];
                $Category=$DataRows["category"];
                $Admin=$DataRows["author"];
            $Image=    $DataRows["image"];
            $Post=$DataRows["post"];
                
            
            
            
            
            ?>
            
            
         <div class="blogpost thumbnail">
         <img class="img-responsive img-rounded" src="Upload/<?php echo $Image ?>" >
             
             
             <div class="caption">
             
             <h1 id="heading"><?php echo htmlentities($Title);?></h1>
                 <p class="description">Category:&nbsp;<?php echo htmlentities($Category); ?> Published on <?php echo htmlentities($DateTime);?>
                 <?php 
                   $con;
                   $QueryApproved="Select count(*) from comments where admin_panel_id='$PostId' and status='ON' ";
                   $ExecuteApproved=mysqli_query($con,$QueryApproved);
                   $RowsApproved=mysqli_fetch_array($ExecuteApproved);
                   $TotalApproved=array_shift($RowsApproved);
                 if($TotalApproved>0){
                        ?>
                <span class="badge pull-right">   Comments:<?php echo $TotalApproved; ?>
                   </span>
                   
                  <?php } ?> 
                   
                 
                 
                 
                 </p>
                 <p class="post"><?php if(strlen($Post)>150){
                $Post=substr($Post,0,150).'...';}
                echo $Post; 
             ?></p>
             
             
             </div>
            <a href="FullPost.php?id=<?php echo $PostId; ?>"><span class="btn btn-info">Read More &rsaquo; &rsaquo;</span>
             </a>
            
            </div>
            <br><br><br><br><br>
            <?php }?></div>
        <div class="col-sm-offset-1 col-sm-3">
            <h4>About me</h4>
<img class="img-responsive img-circle imageicon" src="icon/images.jpg">
            <p>Ignorant saw her her drawings marriage laughter. Case oh an that or away sigh do here upon. Acuteness you exquisite ourselves now end forfeited. Enquire ye without it garrets up himself. Interest our nor received followed was. Cultivated an up solicitude mr unpleasant. 

</p>
            <br><br><br><br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                <h2 class="panel-title">Categories</h2>
                
                
                
                </div>
                
                <div class="panel-body">
                
                <?php
                    $con;
                    $ViewQuery="Select * from category order by datetime desc";
                   $Execute=mysqli_query($con,$ViewQuery);
                while($DataRows=mysqli_fetch_array($Execute)){
                    
                    $Id=$DataRows['id'];
                    $Category=$DataRows['name'];
                    
                    
                
                   ?>
                    <a href="Blog.php?Category=<?php echo $Category;?>">
                    <span id="heading"><?php echo $Category."<br>"; ?></span></a>
                    <?php } ?>
                    
                </div>
                <div class="panel-footer">
                
                
                
                
                </div>
            
            </div>
        
            
            
            </div>
            
            
            
        
        </div>
        
        
        
        
        
        
        
        
        
    </div>
    
    <br><br><br>
    
    
    <div id="Footer">
<hr><p>Theme By | Sambhav Jain |&copy;2019 --- ALL right reserved.</p>
    <p>This site is only for study purpose and all rights have been reserved &trade;</p>
    <hr>
    
    </div>
    <div style="height:10px; background:#27AAE1;"></div>
    
    
    
    </div>
    
    
    </body>
</html>