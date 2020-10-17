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

<!-- Carousel / slider -->
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://source.unsplash.com/1600x600/?programming,code" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://source.unsplash.com/1600x600/?apple,computer" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://source.unsplash.com/1600x600/?code,microsoft" class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!--end carousel -->

<!-- category container starts -->

<div class="container my-4">
    <h2 class="text-center my-3"> WeDiscuss-All Categories</h2>

    <!-- cards -->
    <div class="row my-5">

      <!-- fetch categories from database -->
        <?php
        
          $sql = "SELECT * FROM `categories`";
          $result = mysqli_query($conn, $sql);
          //using a while loop to iterate through categories
          while($row =  mysqli_fetch_assoc($result)){
            $cat_id = $row['cat_id'];
            $cat_name = $row['cat_name'];
            $cat_description = $row['cat_description'];
            echo'
            <a href="/php_projects/wediscuss/thread_list.php?cat_id='.$cat_id.'">
              <div class="col-md-4">
                <div class="card my-2" style="width: 17rem;">
                    <img src="https://source.unsplash.com/400x300/?programming,'.$cat_name.'" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">'.$cat_name.'</h5></a>
                        <p class="card-text">'. substr($cat_description, 0 ,100).'...</p>
                        <a href="/php_projects/wediscuss/thread_list.php?cat_id='.$cat_id.'" class="btn btn-primary">Explore</a>
                      </div>
                </div>
            </div>';
          } //end while loop

        ?>
    </div> 
</div>

<!-- category container ends -->

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