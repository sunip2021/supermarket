<?php

$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    require 'connection.php';
    $username = $_POST["name"];
    $email=$_POST['email'];
    $password = $_POST["password"];
    $cpassword = $_POST['cpassword'];
    $contact=$_POST['contact'];
    $city=$_POST['city'];
    $address=$_POST['address'];
    // $exists=false;

        $existSql = "SELECT * FROM users WHERE email='$email'";
        $result=mysqli_query($conn,$existSql);
        $numExistRows=mysqli_num_rows($result);

      
        if ($numExistRows>0){
            $showError = "username already exists";
        }
    
    else{
        if($password == $cpassword){
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO users(name,email,password,contact,city,address) values ('$username','$email','$hash','$contact','$city','$address')";
            $result = mysqli_query($conn, $sql);
            session_start();
                    $_SESSION['loggedin']=true;
                    $_SESSION['email']=$email;
                    $_SESSION['id']=mysqli_insert_id($conn);
            header('location: products.php');
            if ($result){
                $showAlert = true;
            }
        }else{
            $showError = "Passwords do not match";
        }
    }
}
    
?>
<!-- <?php
    require 'connection.php';
    session_start();
    if(isset($_SESSION['email'])){
        header('location: products.php');
    }
?> -->

<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <title>Super Market Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
            <?php
                require 'header.php';
            ?>
            <br><br>
            <div class="container">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-4">
                        <h1><b>SIGN UP</b></h1>
                        <form method="post" action="signup.php">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Name" required="true">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                            </div> 
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password(min. 6 characters)" required="true" pattern=".{6,}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password(min. 6 characters)" required="true" pattern=".{6,}">
                            </div>
                            
                            <div class="form-group"> 
                                <input type="tel" class="form-control" name="contact" placeholder="Contact" required="true">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="city" placeholder="City" required="true">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="address" placeholder="Address" required="true">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Sign Up">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br>
           <footer class="footer">
               <div class="container">
                <center>
                   <p>Copyright &copy <a href="https://codewithsunip.com">CodeWithSunip</a> Store. All Rights Reserved.</p>
                   <p>This website is developed by Sunip Hazra Choudhury</p>
               </center>
               </div>
           </footer>

        </div>
    </body>
</html>
