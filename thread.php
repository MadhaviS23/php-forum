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
<?php include 'partials/header.php'; ?>
<?php include 'partials/dbconnect.php'; ?>


<?php
$id = $_GET['threadid'];
$userid = $_SESSION['user_id'];
$showAlert= false;
$method = $_SERVER['REQUEST_METHOD'];
if($method=='POST'){
    $content= $_POST['comment'];
    $content= str_replace("<","&lt;", $content);
    $content= str_replace(">","&gt;", $content);
    $sql = "INSERT INTO `comments` (`com_id`, `com_content`, `thread_id`, `user_id`, `timestamp`)
             VALUES ('NULL', '$content ', '$id', '$userid', CURRENT_TIMESTAMP)";
    $result = mysqli_query($conn, $sql);
    $showAlert=true;
    if($showAlert==true){
        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Reply is posted. Thank you for your response...!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }

}

?>

<?php
        $id = $_GET['threadid'];         
          $sql = "SELECT * FROM `threads` WHERE thread_id=$id ";
          $result = mysqli_query($conn, $sql);
          //using a while loop to iterate through categories
          while($row =  mysqli_fetch_assoc($result)){
            $title = $row['thread_title'];
            $desc = $row['thread_des'];
            $id = $row['thread_id'];
            $date = $row['timestamp'];
          }
?>

<div class="container my-4">
    <div class="jumbotron">
        <h1 class="display-6"><?php echo $title; ?></h1>
        <p class="lead"><?php echo $desc ?>.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <p>Posted by:<b> Madhavi23 </b> Date: <b><?php echo $date ?></b></p>
        <!-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
    </div>
</div>

<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']=="true"){
    echo'
        <div class="container my-4">
            <h1 class="py-2"> Post Comment </h1>
            <form action=" '.$_SERVER["REQUEST_URI"].' " method="post">
                
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Type your Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success" name="submit" id="submit">Post comment</button>
            </form>
        </div>';
    }
    else{
        echo'
            <div class="container">
                <h1 class="py-2"> Post Comment </h1>

                <p class="lead">You arent logged in. To reply login</p>
            </div>';

    }
?>

<div class="container" style=" min-height:433px;">
    <h2 class="py-3"> Discussions:</h2>
    <!-- browsing questions // bootstrap-Media heading -->

    <?php
        $id = $_GET['threadid'];         
          $sql = "SELECT * FROM `comments` WHERE thread_id=$id ";
          $result = mysqli_query($conn, $sql);
          $noresult=true;
          //using a while loop to iterate through categories
          while($row =  mysqli_fetch_assoc($result)){
              $noresult=false;
            $id = $row['com_id'];
            $content = $row['com_content'];
            $user = $row['user_id'];
            $curent_time = $row['timestamp'];
            $sql2 = "SELECT email FROM `users` WHERE sno='$user'";
            $result2 = mysqli_query($conn,$sql2);
            $userinfo = mysqli_fetch_assoc($result2);
          
            echo'
            <div class="media my-4">
                <img src="img/user-default.png" class="mr-4" alt="..." width ="80px">
                <div class="media-body">
                    <p class = "font-weight-bold my-0"> '.$userinfo['email'].' at '.$curent_time.'</p>
                    '. $content . '
                </div>
            </div>';
          }

          if($noresult==true){
            echo'<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h3 class="display-4"> No posts found</h3>
              <p class="lead"> Be the first one to post...</p>
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