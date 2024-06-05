<?php
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
    <title>Login Form</title>
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
  .register-link p a{
    color: rgba(76,68,182,0.808);
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
    <div class="wrapper">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
   
        <form action="" method="post">
            <h1>Login</h1>
            <div class="input-box">
                <input type="email" name="email" placeholder="Enter Email" class="form-control">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Enter Password" id="password" class="form-control">
                <img class="open" src="eye-close.png" id="eyeicon">
            </div>
        
            <div class="forget">
                <label><input type="checkbox" name="remember">Remember Me</label>
                <a href="#">Forgot Password</a>
            </div>
            <div class="g-recaptcha" style="width:400px;" data-sitekey="6LetEz8pAAAAACa27IYQgoF1KPysyQ1UTdlIxzCQ"></div>
            <button type="submit" name="login" class="btn">Login</button>
            <div class="register-link">
                <p>Dont have an account? <a href="Registration.php">Register</a></p>
            </div>
        </form>
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
</body>
</html>