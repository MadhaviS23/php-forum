<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>WeDiscuss</title>
</head>
<?php include 'partials/dbconnect.php'; ?>
<?php include 'partials/header.php'; ?>

<?php
        $id = $_GET['cat_id'];         
          $sql = "SELECT * FROM `categories` WHERE cat_id=$id";
          $result = mysqli_query($conn, $sql);
          //using a while loop to iterate through categories
          while($row =  mysqli_fetch_assoc($result)){
            $cat_name = $row['cat_name'];
            $cat_description = $row['cat_description'];
          }
?>

<?php

$showAlert= false;
$userid = $_SESSION['user_id'];
$method = $_SERVER['REQUEST_METHOD'];
echo(var_dump($method));
if($method=='POST'){
    $th_title= $_POST['title'];
    $th_title= str_replace("<","&lt;",$th_title);
    $th_title= str_replace(">","&gt;",$th_title);
    $th_desc= $_POST['desc'];
    $th_desc= str_replace("<","&lt;",$th_desc);
    $th_desc= str_replace(">","&gt;",$th_desc);

    $sql = "INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_des`, `thread_cat_id`, 
    `thread_user_id`, `timestamp`) VALUES (NULL, '$th_title','$th_desc', '$id', '$userid', CURRENT_TIMESTAMP)";
    $result = mysqli_query($conn, $sql);
    $showAlert=true;
    if($showAlert==true){
        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Question is posted.Please wait till community responds...!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }

}

?>

<div class="container my-4">
    <div class="jumbotron">
        <h1 class="display-4"> WELCOME TO <?php echo strtoupper($cat_name); ?> FORUM!</h1>
        <p class="lead"><?php echo $cat_description ?>.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
    </div>
</div>




<!-- div for form -->
<?php

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=="true"){
        echo'
            <div class="container my-4">
                <h1 class="py-2"> Ask Question</h1>
                <form action=" '.$_SERVER['REQUEST_URI'].' " method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail">Title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
                        <small id="emailhelp" class="form-text text-muted">Keep your title as crisp as possible.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Elaborate Your concern</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success" name="submit" id="submit">Submit</button>
                </form>


            </div>';
        }
else{
    echo'
    <div class="container">
        <h1 class="py-2"> Ask Question</h1>

        <p class="lead">You arent logged in. To ask a question login</p>
    </div>';

}

?>



<!-- end form -->




<div class="container" style=" min-height:433px;">
    <h2 class="py-3"> Browse Questions</h2>
    <!-- browsing questions // bootstrap-Media heading -->

    <?php
        $id = $_GET['cat_id']; 
        $noresult = true;        
          $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id ";
          $result = mysqli_query($conn, $sql);
          //using a while loop to iterate through categories
          while($row =  mysqli_fetch_assoc($result)){
            $noresult= false;
            $title = $row['thread_title'];
            $desc = $row['thread_des'];
            $id = $row['thread_id'];
            $thread_time= $row['timestamp'];
            $thread_userid= $row['thread_user_id'];
            $sql2 = "SELECT email FROM `users` WHERE sno='$thread_userid'";
            $result2 = mysqli_query($conn,$sql2);
            $userinfo = mysqli_fetch_assoc($result2);
          
            echo'
            <div class="media my-4">
                <img src="img/user-default.png" class="mr-4" alt="..." width ="80px">
                <div class="media-body">
                <p class = "font-weight-bold my-0"> '. $userinfo['email'].' at '.$thread_time.'</p>
                    <h5 class="mt-0"> <a class="text-dark" href="thread.php?threadid='.$id.'">'. $title .'</a></h5>
                    '. $desc . '
                </div>
            </div>';
          }
          if($noresult==true){
              echo'<div class="jumbotron jumbotron-fluid">
              <div class="container">
                <h2 class="display-4"> No Questions found</h2>
                <p class="lead"> Be the first one to ask a question...</p>
                </div>
            </div>';
          }
  ?>
    <!-- end questions -->


</div>


<?php include 'partials/footer.php'; ?>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
</script>
</body>

</html>