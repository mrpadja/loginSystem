<?php
// CONNECTION
require_once'db_connect.php';

// SESSION
session_start();

// CREATE
if(isset($_POST['btn_create'])){
    $error=[];
    $upName =$_POST["upName"];
    $upEmail =$_POST["upEmail"];
    $upPassword=$_POST["upPassword"];

    if(empty($upName) or empty($upEmail) or empty($upPassword)){
        $error[]="<li>You need to fill all the input!!<li>";
    }else{
        if (!filter_var($upEmail, FILTER_VALIDATE_EMAIL)) {
            $error[] = "<li>Invalid email format<li>";
          }else{

            $sql = "SELECT email FROM user WHERE email='$upEmail' ";
            $result = mysqli_query($connect,$sql);
            if(mysqli_num_rows($result)>0){
                $error[] ="<li>this email is already attached to an account<li>";
            }else{

            
            $upPassword=md5($upPassword);
            $sql = "INSERT INTO user(name,email,password) VALUES('$upName', '$upEmail', '$upPassword')";
            $result = mysqli_query($connect,$sql);

            if($result){
                echo "Account created!!";
            }
        }
          }


    }



}




// Send button
if (isset($_POST['btn_send'])){
    $erros = [];
    $email = mysqli_escape_string($connect, $_POST['email']);
    $password = mysqli_escape_string($connect, $_POST['password']);

    if (empty($email) or empty($password)){
        $erros[]="<li>You need to fill the input!!<li>";
   
    } else{
        $sql = "SELECT email FROM user WHERE email='$email' ";
        $result = mysqli_query($connect,$sql);
      

        if(mysqli_num_rows($result)>0){
            $password = md5($password); 
            $sql="SELECT * FROM user WHERE email ='$email' AND password='$password'";
            $result = mysqli_query($connect, $sql);
                if(mysqli_num_rows($result) == 1){
                    $dados = mysqli_fetch_array($result);
                    mysqli_close($connect);
                    $_SESSION['logedIn']= true;
                    $_SESSION['id_user']= $dados['id'];
                
                    // var_dump($_SESSION); exit;

                    header("Location: home.php");
                }else{
                    $erros[]="<li>Email and password missmatched<li>";
                }

        }else{
            $erros[]="<li>User not existed!<li>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    
<H2>LOGIN</H2>

<?php
if(!empty($error)){
    foreach($error as $erro){
        echo $erro;
    }
}
?>

<form action="<?php echo$_SERVER['PHP_SELF'];?>" method= "POST">
    <H1>SIGN UP</H1>
    Name: <input type="text" name="upName"> <br>
    Email: <input type="email" name='upEmail'><br>
    Password: <input type="password" name='upPassword'><br>
    <button type="submit" name="btn_create">Create</button>
    <br>
    <hr>
</form>

<?php
if(!empty($erros)){
    foreach($erros as $erro){
        echo $erro;
    }
}
?>

<form action="<?php echo$_SERVER['PHP_SELF'];?>" method= "POST">
    <br>
    Email: <input type="email" name= "email"> <br>
    Password: <input type="password" name="password"> <br>
    <button type="submit" name="btn_send">login</button>
</form>



</body>
</html>