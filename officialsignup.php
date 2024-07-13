<?php
    include 'connection.php';

    $errors = array();
    
    if(isset($_POST['signup']))
    {
        $name = $_POST['name'];
        $id = $_POST['id'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];

        // Checking for password match 
        if($password != $c_password)
        {
            $errors['password'] = "Confirm password not matched!";
                echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> '. $errors['password'] .'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
            }
        

        // Checking for email check!
        $id_check = "SELECT * FROM official_details WHERE ID = '$id'";
        $res = mysqli_query($con, $id_check);
        if(mysqli_num_rows($res) > 0){
            $errors['id'] = "ID that you have entered is already exist!";
                echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Error!</strong> '. $errors['id'] .'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> ';
            
        }
        if(count($errors) === 0){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `official_details` (`NAME`,`ID`, `EMAIL`, `PASSWORD`) VALUES ('$name','$id','$email', '$hash')";
            $result = mysqli_query($con, $sql);
            if($result){
                header('location: officiallogin.php');
                die();
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Sign Up</title>
    <link rel="stylesheet" href="style.css">
    
    <style>
          * {
    box-sizing: border-box;
}
.msg{
    text-align: center;
}
   footer {
            background-color: #333;
            color: wheat;
            overflow: hidden;
            display: flex;
            justify-content: center;
            padding: 50px;
            box-sizing: border-box;
        }
    .signup{
        background-color: black;
        /* width: 100%; */
        /* position: relative; */
        padding: 25px;
        /* height: 61vh; */
        /* overflow:hidden; */
        text-align: center;
        display: flex;
        justify-content: center;
        box-sizing: border-box;
    }
    .container{
        box-shadow: 0px 0px 50px 0px rgba(45,255,196,0.98);
        background-color: white;
        width: 500px;
        height: auto;
        text-align: center;
        padding-top: 10px;
        box-sizing: border-box;

        border-radius: 50px;
    }
    label{
        font-size: 25px;
    }
    label{
        margin-top: 10px;
    }
    .container h1{
        display: flex;
        justify-content: center;
        padding-top: 10px;
        box-sizing: border-box;
    }
    /* .msg{
        font-size: 30px;  
        display: flex;
        justify-content: center;
    } */
    input[type=text],input[type=email],input[type=password]{
        box-shadow: 0px 0px 0px 2px black;
        width: 80%;
        border: 2px solid red;
        border-radius: 4px;
        padding: 22px 10px;
        margin: 20px 50px;
        box-sizing: border-box;
        display:flex;
        justify-content: center;
        align-items: center;
        
    }
    input[type=text]:hover,input[type=email]:hover,input[type=password]:hover{
        box-shadow: 0px 0px 10px 2px black;
        box-sizing: border-box;
    }
    input[type=text]::placeholder,input[type=password]::placeholder,input[type=email]::placeholder{
        font-size: 15px;
        color: rgb(0, 0, 0);
        box-sizing: border-box;
    }
    .button{
        text-align: center;
        box-sizing: border-box;
    }
    input[type="reset"], input[type="submit"]{
        padding: 15px 15px;
        border-radius: 15px;
        font-size: 20px;
        background-color: rgb(187, 187, 244);
        color: blue;
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        border: none;
        cursor: pointer;
        box-sizing: border-box;
    }
    input[type="reset"]:hover,input[type="submit"]:hover{
        background-color: rgb(0, 0, 1);
        color: rgb(162, 162, 244);
        box-sizing: border-box;
    }
    h2{
        display: flex;
        justify-content: center;
        padding-top: 15px;
        box-sizing: border-box;
    }
    h2 a{
        text-align: center;
        text-decoration: none;
        color: #007bff;
        font-size: 25px;
        padding: 0 8px;
        box-sizing: border-box;
    }
    h2 a:hover{
        text-decoration: underline;
        box-sizing: border-box;
    }
    #founder {
    background-color: lightblue;    
    padding: 25px;
    box-sizing: border-box;

}
    </style>
</head>

<body>
    <header>
        <h1 class="CID">Crime Management System</h1>
        <nav>
            <div class="logo">
            <a href="index.html">
                    <img class="rotate" src="ashok.jpg" alt="LOGO">
                </a>
            </div>
            <div class="items">
                <ul class="cta-buttons">
                    <a href="index.html" class="btn">Home</a>
                    <a href="contact_us.php" class="btn">Contact us</a>
                    <a href="officiallogin.php" class="btn">Official Login</a>
                    <a href="officialsignup.php" class="btn" style="background-color: aliceblue; color: black;">Official Sign Up</a>
                </ul>
            </div>
        </nav>
    </header>
    
    <h2 id="founder">Official Sign Up Form</h2>
    <main class="signup">
        <div class="container">
            <form action="" name="signup" method="post">
                    <p>
                        <label>First Name:</label>
                        <input type="text" name="name" placeholder="your name" required>
                    </p>
                    <p>
                        <label>ID:</label>
                        <input type="text" name="id" placeholder="your id" required>
                    </p>
                    <p>
                        <label>Email:</label>
                        <input type="email" name="email" placeholder="your email" required>
                    </p>
                    <p>
                       <label>Password</label>
                       <input type="password" name="password" placeholder="Enter new Password">
                    </p>
                    <p>
                       <label>Confirm Password</label>
                       <input type="password" name="c_password" placeholder="Confirm Password">
                    </p>

                <input type="submit" href="officiallogin.php" name="signup"> <input type="reset">
                <h2>Already User?<a href="officiallogin.php">Login</a></h2>
            </form>
        </div>
    </main>








    <footer>
        <p>&copy; 2024 Crime Management System</p> 
    </footer>
</body>

</html>