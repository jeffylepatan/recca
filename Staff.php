<?php
    session_start();

    include("db.php");
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idnum = $_POST['idnum'];
        $password = $_POST['password'];

        if(!empty($idnum) && !empty($password)) {
            // Hash the password for comparison
            $hashed_password = md5($password); // You should use a more secure hashing algorithm

            $query = "SELECT * FROM Form WHERE `ID Number` = '$idnum' LIMIT 1";
            $result = mysqli_query($con, $query);

            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);

                // Compare hashed passwords
                if($user_data['password'] == $hashed_password){
                    // Valid credentials, set session variable
                    $_SESSION['idnum'] = $idnum;
                    // Redirect to service.php
                    header("Location: service.php");
                    die;
                } else {
                    // Invalid password
                    echo "<script type='text/javascript'>alert('Wrong Password')</script>";
                }
            } else {
                // User not found
                echo "<script type='text/javascript'>alert('User not found')</script>";
            }
        } else {
            // Empty fields
            echo "<script type='text/javascript'>alert('Please enter ID Number and Password')</script>";
        }
    }

    // Redirect to login page if the user tries to access service.php without logging in
    if (!isset($_SESSION['idnum'])) {
        header("Location: CEC.php"); // Adjust the actual login page filename as needed
        die;
    }
?>




<!DOCTYPE html>
<html>
    <head>
        <title> 
            CEBU EASTERN COLLEGE ONLINE MATERIAL
        </title>
        <link rel="stylesheet" href="stylehci.css">
        <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@100&display=swap');
</style>
    </head>
<body>
    <nav class="Logo"> 
        <a href="home.html"><img src="CECLOGOWHITE.png"></a>
        <div class="nav-links">
                <li><a href="CEC.php">HOME</a></li>
                <li><a href="Service.php">SERVICES</a></li>
                <li><a href="contacts.php">CONTACTS</a></li>
                <a href="CreateAccount.php"><button class="circular-button">Create Account</button></a>
        </div>
    </nav>
    <div class="Info">
        <h1>CEBU EASTERN</h1>
        <h2>COLLEGE</h2>
        <h3>ONLINE MATERIAL CENTER</br>
        <p>These material center is more convenient and exclusively accessible for the Students, Teachers, and Staffs 
        in Cebu Eastern College to use. These material center offers a top notched material to ensure the quality
        and durability of the product.</p>
    </div>
    <div class="SIGNUP">
        <div class="Student">
            <button type="submit">STUDENT</button>
            <div class="Teacher">
                <button>TEACHER</button>
            </div>
            <div class="Staff">
                <button>STAFF</button>
            </div>
        </div>
        <form class="login_db" method="post" action="Service.php">
    <input type="text" class="idnum" name="idnum" placeholder="ID NUMBER" required="" autofocus="" />
    <input type="password" class="password" name="password" placeholder="PASSWORD" required="" autofocus=""/><br> 
    <button class="SUBMIT" name="submit" type="submit">LOGIN</button>
</form>

      
</div>
    </div>

    <div class="images1">
            <img src="img/lace.jpeg" alt="lace">
    </div>
    <div class="images2">
            <img src="img/3.jpeg" alt="3">
    </div>
    <div class="images3">
        <img src="img/5.jpeg" alt="5">
    </div>
    <div class="images4">
        <img src="img/2.jpeg" alt="2">
    </div>
    <div class="images5">
        <img src="img/4.jpeg">
    </div>
    <div class="images6">
        <img src="img/1.jpeg">
    </div>

</body>    
</html>