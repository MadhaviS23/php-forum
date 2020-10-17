<?php
$login=false;
$showerror= "false";
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    include 'dbconnect.php ';
    $user_email = $_POST['emailid'];
    $password = $_POST['password'];

    //check weather username exists
    $exist=false;
    //$sql1 = "SELECT sno from users WHERE email='$user_email' ";
    //$result1 = mysqli_query($conn,$sql1);
    //$userinfo = mysqli_fetch_assoc($result1);
    //$user_id = $userinfo['sno'];
    //var_dump($user_id);
    $exists_sql = "SELECT * FROM users WHERE email='$user_email' ";
    $result = mysqli_query($conn,$exists_sql);
    $num = mysqli_num_rows($result);
    if($num==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['user_id'] = $row['sno']; 
        $showalert = "You have successfulyy logged in";
        header("location: /php_projects/wediscuss/index.php?login=true&showalert=$showalert");
        exit();

        }
        else{
            $showError = "Invalid Password";
            header("location: /php_projects/wediscuss/index.php?login=false&Error=$showError");
            }
        
    }
    else{
        $showError = "Invalid username";
        header("location: /php_projects/wediscuss/index.php?login=false&Error=$showError");
    }
    
}

?>