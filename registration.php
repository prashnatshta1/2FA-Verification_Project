
<?php
// Add these lines at the beginning of your file
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/lgn/PHPMailer/src/Exception.php';
require 'C:/xampp/htdocs/lgn/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/lgn/PHPMailer/src/SMTP.php';



session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>

        
  body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-size: cover;
    background-position: center;
  }
.container{
    width: 420px;
    background: #ebecf0;
    border: 2px rgba(76,68,182,0.808);
    backdrop-filter: blur(9px);
    color: #fff;
    border-radius: 12px;
    padding: 30px 40px;
}

.container h1{
    color: rgba(76,68,182,0.808);
    font-size: 36px;
    text-align: center;
}
.form-group{
    margin-bottom:30px;
    position: relative;
    width: 100%;
    height: 50px;
    margin: 30px 0;
}
.btn{
    height: 35px;
    background: rgba(76,68,182,0.808);
    border: 0;
    border-radius: 5px;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    transition: all .3s;
    margin-top: 10px;
    padding: 0px 10px;
}
.form-group input{
    width: 100%;
    height: 100%;
    border: none;
    outline: none;
    border: 2px solid rgba(255, 255, 255, .2);
    border-radius: 40px;
    font-size: 16px;
    padding: 20px 45px 20px 20px;
  }

.wrapper{
    width: 420px;
    background: #ebecf0;
    border: 2px rgba(76,68,182,0.808);
    backdrop-filter: blur(9px);
    color: #fff;
    border-radius: 12px;
    padding: 30px 40px;
  }
  .wrapper h1{
    color: rgba(76,68,182,0.808);
    font-size: 36px;
    text-align: center;
  }
  .wrapper .input-box{
    width: 100%;
    height: 50px;
    margin: 30px 0;
    display: flex;
    align-items: center;
  }
  .input-box {
    position: relative;
    width: 100%;
    margin-bottom: 20px;
}

.input-box input {
    width: calc(100% - 45px);
    height: 100%;
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 40px;
    font-size: 16px;
    padding: 20px;
    padding-right: 45px;
    outline: none;
}

.open {
    position: absolute;
    top: 50%;
    right: 60px;
    transform: translateY(-50%);
    width: 20px;
    cursor: pointer;
}
.mess {
  color: black;
}

.input-box input::placeholder {
    color: black;
}


  .wrapper .forget{
    display: flex;
    color: rgba(76,68,182,0.808);
    justify-content: space-between;
    font-size: 14.5px;
    margin: -15px 0 15px;
  }
  .forget label input{
    accent-color: rgba(76,68,182,0.808);
    margin-right: 3px;
  
  }
  .forget a{
    color: rgba(76,68,182,0.808);
    text-decoration: none;
  
  }
  .forget a:hover{
    text-decoration: underline;
  }
  .wrapper .btn{
    width: 100%;
    height: 45px;
    background: rgba(76,68,182,0.808);
    border: none;
    outline: none;
    border-radius: 40px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    cursor: pointer;
    font-size: 16px;
    color: #333;
    font-weight: 600;
  }
  .wrapper .register-link{
    color: rgba(76,68,182,0.808);
    font-size: 14.5px;
    text-align: center;
    margin: 20px 0 15px;
  
  }
  .register-link p{
    text-decoration: none;
    font-weight: 600;
  }
  .register-link p a:hover{
    text-decoration: underline;
  }
  .box{
    width:200px;
    height:200px;
    margin-right:200px;
  }


</style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
           $FName = $_POST["first_name"];
           $LName = $_POST["last_name"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
           
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (empty($FName) OR empty($LName)OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
            array_push($errors,"All fields are required");
           }
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
        
    if (!preg_match("/[a-z]/", $password)) {
        array_push($errors, "Password must contain at least one lowercase letter");
    }

    if (!preg_match("/[A-Z]/", $password)) {
        array_push($errors, "Password must contain at least one uppercase letter");
    }

    if (!preg_match("/[!@#$%^&*(),.?\":{}|<>]/", $password)) {
        array_push($errors, "Password must contain at least one special character");
    }
   
      if (!preg_match("/[0-9]/", $password)) {
        array_push($errors, "Password must contain at least one number");
    }

    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }
           if ($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
           }

           function sendVerificationEmail($email, $token) {
            $mail = new PHPMailer(true);
        
            try {
                //Server settings
                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host       = 'smtp.gmail.com'; // Specify SMTP server
                $mail->SMTPAuth   = true; // Enable SMTP authentication
                $mail->Username   = 'peasent77@gmail.com'; // SMTP username
                $mail->Password   = 'ckhshfkfcaqnjeug'; // SMTP password
                $mail->SMTPSecure = 'tls'; // Enable TLS encryption, 'ssl' also accepted
                $mail->Port       = 587; // TCP port to connect to
        
                //Recipients
                $mail->setFrom('peasent77@gmail.com', 'Prashant Shrestha');
                $mail->addAddress($email); // Add a recipient
        
                //Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'Verify Your Email';
                $mail->Body    = "Click the following link to verify your email: http://localhost/lgn/verify.php?email=$email&token=$token";
        
                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        

           require_once "database.php";
           $sql = "SELECT * FROM users WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email already exists!");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            $verificationToken = bin2hex(random_bytes(32));
            $sql = "INSERT INTO users (first_name,last_name, email, password,verification_code, is_verified) VALUES ( ?, ?, ?,?,?,0 )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sssss",$FName, $LName, $email, $passwordHash,$verificationToken);
                mysqli_stmt_execute($stmt);

                sendVerificationEmail($email, $verificationToken);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            }else{
                die("Something went wrong");
            }
           }
          

        }
        ?>
        <h1>Registration</h1>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="first_name" placeholder="First Name:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="last_name" placeholder="Last Name:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password:">
                <img class="open" src="eye-close.png" id="eyeicon">
                <p class="mess" id="message">Your password is <span id="strength"></span></p>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" id="confirm_password" placeholder="Repeat Password:">
                <img class="open" src="eye-close.png" id="confeyeicon">
            </div>
          <div class="g-recaptcha" 
              style="width:400px;" 
              data-sitekey="6LetEz8pAAAAACa27IYQgoF1KPysyQ1UTdlIxzCQ">
          </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
        <div><p style="color : black;">Already Registered <a href="login.php">Login Here</a></p></div>
      </div>
    </div>

<script>
              let eyeicon = document.getElementById("eyeicon");
              let password = document.getElementById("password");

              eyeicon.onclick = function(){
                if(password.type == "password"){
                  password.type = "text";
                  eyeicon.src = "eye-open.png";
                }else{
                  password.type = "password";
                  eyeicon.src = "eye-close.png";
                }
              }
              </script>
    <script>
              let ceyeicon = document.getElementById("confeyeicon");
              let cpassword = document.getElementById("confirm_password");

              ceyeicon.onclick = function(){
                if(cpassword.type == "password"){
                  cpassword.type = "text";
                  ceyeicon.src = "eye-open.png";
                }else{
                  cpassword.type = "password";
                  ceyeicon.src = "eye-close.png";
                }
              }
    </script>
    <script>
        var pass = document.getElementById("password");
        var msg = document.getElementById("message");
        var str = document.getElementById("strength");

        pass.addEventListener('input', () =>{
            if(pass.value.length > 0){
                msg.style.display = "block";
            }
            else{ 
                msg.style.display = "none";
            }
            if(pass.value.length < 4){
                str.innerHTML = "too weak";
                pass.style.borderColor = "red";
                msg.style.color = "red";

            }
            else if(pass.value.length >= 4 && pass.value.length < 8){
                str.innerHTML = "medium";
                pass.style.borderColor = "orange";
                msg.style.color = "orange";
            }
            else if(pass.value.length >= 8){
                str.innerHTML = "strong";
                pass.style.borderColor = "green";
                msg.style.color = "green";
            }
        })
    </script>
</body>
</html>