<?php
    session_start();

    include("db_teacher.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $emailnum = $_POST['emailnum'];
    $idnum = $_POST['idnum'];
    $password = $_POST['password'];
    $conpass = $_POST['conpass'];

    var_dump($_POST);

    if (empty($password) || empty($conpass)) {
        echo "<script type='text/javascript'>alert('Please enter both password and confirm password')</script>";
    } elseif ($password !== $conpass) {
        echo "<script type='text/javascript'>alert('The password and confirm password do not match')</script>";
    } else {
        $query = "INSERT INTO teacher (firstname, lastname, emailnum, idnum, password, conpass) VALUES (?, ?, ?, ?, ?, ?)";
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
    }
}
?>

<!DOCTYPE html>
<head>
    <title> CEBU EASTERN COLLEGE ONLINE MATERIAL CENTER </title>
        <link rel="stylesheet" href="NewAccount.css">
            <style>
             @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@100&display=swap');
            </style>

<body>      
    <div class="Info">
        <h1>CEBU EASTERN</h1>
        <h2>COLLEGE</h2>
        <h3>ONLINE MATERIAL CENTER</br>
    </div>
    <div class="SIGNUP">      
        <h4>CREATE ACCOUNT</h4>         
        <div id="role-selection">
            <button class="toggle-btn" onclick="toggleRole(this)">Student</button>
            <button class="toggle-btn" onclick="toggleRole(this)">Teacher</button>
            <button class="toggle-btn" onclick="toggleRole(this)">Staff</button>
        </div>
      </div>
      <form class="CREATEACC" method="post" action="CEBUEASTERNCOLLEGE.php">       
        <input type="text" class="fname" name="firstname" placeholder="FIRST NAME" required="" autofocus="" />
        <input type="text" class="lname" name="lastname" placeholder="LAST NAME" required="" autofocus=""/><br>      
        <input type="text" class="email" name="emailnum" placeholder="EMAIL OR PHONE NUMBER" required="" autofocus=""/><br>      
        <input type="text" class="id" name="idnum" placeholder="ID NUMBER" required="" autofocus=""/><br>      
        <input type="password" class="password" name="password" placeholder="PASSWORD" required=""/><br>
        <input type="password" class="confirmpass" name="conpass" placeholder="CONFIRM PASSWORD" required="" autofocus=""/><br>                 
        <button class="SUBMIT" type="submit" name="submit" value="Login">SUBMIT</button>
        <p>Already have an account?<p>LOGIN</p></p>
      </form>
</div>

<script>
    function toggleRole(button) {
        var buttons = document.querySelectorAll('.toggle-btn');
        buttons.forEach(function(btn) {
            if (btn === button) {
                btn.classList.toggle('selected');
            } else {
                btn.classList.remove('selected');
            }
        });
    }
</script>

</head>
</body>
