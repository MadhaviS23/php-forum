<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
    .maincontainer {
        min-height: 100vh;
    }
    </style>


    <title>WeDiscuss</title>
</head>
<?php include 'partials/dbconnect.php'; ?>
<?php include 'partials/header.php'; ?>

<!-- Search results -->
<div class="container my-3" id="maincontainer">
    <h1 class="py-3 my-3"> Search Results for <em>"<?php echo$_GET['search']; ?>"</em></h1>

    <!-- displaying serach results -->
        <?php
            $noresult=true;
            $search=$_GET['search'];
            $sql="select * from threads where match(thread_title, thread_des) against('$search')";
            $result= mysqli_query($conn,$sql);
            $num_rows= mysqli_num_rows($result);
            while($row=mysqli_fetch_assoc($result)){
                $noresult=false;
                $thread_id=$row['thread_id'];
                $title=$row['thread_title'];
                $desc=$row['thread_des'];
                $title_user=$row['thread_user_id'];
                $url = "thread.php?threadid=".$thread_id;
                echo'
                    <div class="result my-3">  
                        <h3><a href="'.$url.'" class="text-dark"> '.$title.'</a></h3>
                        <p class=" mx-2">'.$desc.'</p>
                    </div>
                ';
            }
            
           if($noresult){

           echo' 
            <div class="jumbotron jumbotron-fluid my-3">
            <div class="container">
              <h1 class="display-4">No Results Found</h1>
              <p class="lead"><ul class="tect-dark">Sugesstions:
                <li>  Make sure that all words are spelled correctly. </li>
                <li>Try different keywords.</li>
                <li>Try more general keywords.</li>
            
              </ul></p>
            </div>
          </div>';
           }
    ?>
    </div>
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