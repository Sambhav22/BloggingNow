<?php

include "include/db.php";
 require_once("Include/Sessions.php"); 
require_once("Include/Functions.php"); 
?>

<?php Confirm_Login(); ?>
<?php
if(isset($_POST['Submit'])){

    $Name=$_POST["Name"];
         $Email=$_POST["Email"];
   $Comment=$_POST["Comment"]; date_default_timezone_set("Asia/Karachi");
$CurrentTime=time();

$DateTime=strftime("%B-%d-%Y  %H:%M:%S",$CurrentTime);
    $DateTime;
    $PostId=$_GET["id"];
    
    
    
    
    if(empty($Name)||empty($Email)||empty($Comment)){
        
        $_SESSION['ErrorMessage']= "All Fields are required";
        
    }
    elseif(strlen($Comment)>500){
        $_SESSION['ErrorMessage']= "Only 500 Characters are allowed in Comment";
            
    }else{
        
        global $con;
        $PotIDFromURL=$_GET['id'];
        $Query="Insert into comments (datetime,name,email,comment,status,admin_panel_id)
        values ('$DateTime','$Name','$Email','$Comment','OFF','$PotIDFromURL')";
        
        $Execute=mysqli_query($con,$Query);
         if($Execute){
        $_SESSION['SuccessMessage']= "Comment Submitted Successfully";
        Redirect_to("FullPost.php?id= {$PostId}");
            
        }else{
            
            $_SESSION['ErrorMessage']= "Something went wrong.Try Again";
             
        Redirect_to("FullPost.php?id= {$PostId}");
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
  <title>Full Blog Post</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
    
    <link rel="stylesheet" href="css/publicstyles.css">
    <style>
    .col-sm-3{
                background-color:green;
                }
        .FieldInfo{
            color:rgb(251,174,44);
            font-family: Bitter,Georgia,"Times New Roman",Times,serif;
            font-size: 1.2em;
        }
        
        .CommentBlock{
            
            background-color: #F6F7F9;
            
            
            
        }
        .comment-info{
            color:#365899;
            font-family: sans-serif;
            font-size:1.1em;
            font-weight: bold;
            padding-top: 10px;
        }
        .comment{
            margin-top:-2px;
            padding-bottom: 10px;
            font-size:1.1em;
            
            
            
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
    
    <div class="Line" style="height:10px; background:#27aae1;"></div>
    <div class="container">
        <div class="blog-header">
    <h1>Welcome to Blogging Now</h1>
            <p class="lead">Best Blogging Website till Date</p>
    </div>
        
        <div class="row">
        <div class="col-sm-8">
            <?php echo Message();
            echo SuccessMessage();
            ?>
            
           <?php
            global $con;
            if(isset($_GET["SearchButton"])){
                
                $Search=$_GET['Search'];
                $ViewQuery="SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%' 
                OR title LIKE '%$Search%' OR post LIKE '%$Search%' ";
                
                
            }else{
            
            $postIdFromUrl=$_GET["id"];
            $ViewQuery="Select * from admin_panel where id='$postIdFromUrl' order by datetime desc";} 
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
                 <p class="description">Category:&nbsp;<?php echo htmlentities($Category); ?> Published on <?php echo htmlentities($DateTime);?> </p>
                 <p class="post"><?php                 echo $Post; 
             ?></p>
             
             
             </div>
            
            </div>
            
            <?php }?>
            
        <span class="FieldInfo">Comments </span>
            <br>
        
            
                        
            <?php
            
            $con;
            $PostIdForComments=$_GET['id'];
            $ExtractingCommentsQuery="SELECT * from comments where admin_panel_id =
            '$PostIdForComments' AND status='ON'";
            $Execute=mysqli_query($con,$ExtractingCommentsQuery);
            while($DataRows=mysqli_fetch_array($Execute)){
                $CommentDate=$DataRows["datetime"];
                
                 $CommenterName=$DataRows["name"];
                
                 $CommentbyUsers=$DataRows["comment"];
                
                
        ?>
            
            <div class="CommentBlock">
            <img style="margin-left:10px; margin-top:10px;" class="pull-left" src="icon/comment.png" width=70px; height=70px; >
            <p style="margin-left:90px;" class="comment-info"><?php echo $CommenterName; ?></p>
           
                 <p style="margin-left:90px; class="description"><?php echo $CommentDate; ?></p>
           
                 <p style="margin-left:90px; class="comment"><?php echo $CommentbyUsers; ?></p>
           
            
            
            
            </div>
            
            <hr>
            <?php } ?>
            
            
            
            
        
        
        
        
        
        <span class="FieldInfo">Share your thoughts about this post</span>
            <br>
          <br>
        
        
        
        
        
        
        
        
    
           
  <form  method="post" action="FullPost.php?id=<?php echo $PostId; ?>"
                               enctype="multipart/form-data">
      <fieldset>
         

          
          <div class="form-group">
              <label for="Name"><span class="FieldInfo">Name:</span></label>
      <input class="form-control" type="text" name="Name" id="Name" placeholder="Name">
                       
      </div>

          
          
           <div class="form-group">
              <label for="Email"><span class="FieldInfo">Email:</span></label>
      <input class="form-control" type="email" name="Email" id="Email" placeholder="Email">
                       
      </div>

          
          
          
          <div class="form-group">
              <label for="Commentarea"><span class="FieldInfo">Comment</span></label>
              <textarea class="form-control" name="Comment" id="commentarea"></textarea>
          </div>
               
          
          
          
          
              <br>
              <input class="btn btn-primary" type="submit" name="Submit" value="Submit">
      
     
      </fieldset>
    
    <br>
    
    
    
    </form>      
        
        
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