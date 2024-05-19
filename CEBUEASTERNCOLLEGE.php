<?php
    session_start();

    include("database.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $emailnum = $_POST['emailnum'];
        $idnum = $_POST['idnum'];
        $password = $_POST['password'];
        $conpass = $_POST['conpass'];
    
        
        $errors = [];
    
        if (empty($firstname) || empty($lastname) || empty($emailnum) || empty($idnum) || empty($password) || empty($conpass)) {
            $errors[] = "All fields are required.";
        }
    
        if (!filter_var($emailnum, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }
    
        if (strlen($idnum) < 7) {
            $errors[] = "ID number must be at least 7 digits.";
        }
    
        if (strlen($password) < 8 || strlen($password) > 16 || !preg_match("/[a-z]/", $password) || !preg_match("/[A-Z]/", $password)) {
            $errors[] = "Password must be between 8 and 16 characters long and contain at least one lowercase letter and one uppercase letter.";
        }
    
        if ($password !== $conpass) {
            $errors[] = "Passwords do not match.";
        }
    
        
        if (empty($errors)) {
            $query = "INSERT INTO student (firstname, lastname, emailnum, idnum, password, conpass) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $query);
    
            if (!$stmt) {
                die('Error in preparing SQL statement: ' . mysqli_error($con));
            }
    
            mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $emailnum, $idnum, $password, $conpass);
    
            if (mysqli_stmt_execute($stmt)) {
                echo "<script type='text/javascript'>alert('You are Successfully Registered!!!')</script>";
            } else {
                echo "<script type='text/javascript'>alert('Error in registration: " . mysqli_stmt_error($stmt) . "')</script>";
            }
    
            mysqli_stmt_close($stmt);
        } else {
            
            foreach ($errors as $error) {
                echo "<script type='text/javascript'>alert('$error')</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title> CEBU EASTERN COLLEGE ONLINE MATERIAL CENTER </title>
        <link rel="stylesheet" href="STYLE.css">
            <style>
             @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@100&display=swap');
            </style>
</head>
<body>      
    <div class="Info">
        <h1>CEBU EASTERN</h1>
        <h2>COLLEGE</h2>
        <h3>ONLINE MATERIAL CENTER</br>
    </div>
    <div class="SIGNUP">      
        <h4>CREATE ACCOUNT</h4>   
        <div class="FORM">
      <form class="CREATEACC" method="post" action="CEBUEASTERNCOLLEGE.php">       
        <input type="text" class="fname" name="firstname" placeholder="FIRST NAME" required="" autofocus="" />
        <input type="text" class="lname" name="lastname" placeholder="LAST NAME" required="" autofocus=""/><br>      
        <input type="text" class="email" name="emailnum" placeholder="EMAIL OR PHONE NUMBER" required="" autofocus=""/><br>      
        <input type="text" class="id" name="idnum" placeholder="ID NUMBER" required="" autofocus=""/><br>      
        <input type="password" class="password" name="password" placeholder="PASSWORD" required=""/><br>
        <input type="password" class="confirmpass" name="conpass" placeholder="CONFIRM PASSWORD" required="" autofocus=""/><br>                 
        <button class="SUBMIT" type="submit" name="submit" value="Login">SUBMIT</button>
        <p class="Account">Already have an account? <a href="CEC.php">LOGIN</a></p>
      </form>

      </div>
</div>


</body>
</html>

