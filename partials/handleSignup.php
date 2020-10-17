<?php
$showerror= "false";
if($_SERVER["REQUEST_METHOD"]== 'POST'){
    include 'dbconnect.php ';
    $user_email = $_POST['signupEmail'];
    $pass = $_POST['SignupPassword'];
    $cpass = $_POST['Signupcpassword'];

    // check weather this email exists
    $exist_sql = " SELECT * FROM users WHERE email = '$user_email' ";
    $result = mysqli_query($conn, $exist_sql);
    $num = mysqli_num_rows($result);
    if($num >0){
        $showerror = "Email already in use..";
    } 
    else{
        if($pass ==  $cpass){
            echo"Processing";
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`sno`, `email`, `password`, `timestamp`)
                     VALUES (NULL, '$user_email', '$hash', CURRENT_TIMESTAMP)";
            $result = mysqli_query($conn, $sql);
            var_dump($result);
            if($result){
                $showalert = "Signin Successfull";
                header("Location: /php_projects/wediscuss/index.php?signupsuccess=true&showalert=$showalert");
                exit();
             }
            
        }
        else{
            $showerror = "Passwords do not match";
        }
    }
    header("Location: /php_projects/wediscuss/index.php?signupsuccess=false&error=$showerror");

}

?>