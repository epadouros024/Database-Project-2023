<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        .php-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 0vh;
            margin-top: 0px;
            margin-bottom: 0px;
        }
        .form-container {
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 90vh;
        }
    </style>
</head>
<body>



<div class="form-container">
        <form action="login.php" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="pwd">Password:</label><br>
            <input type="password" id="pwd" name="password">
            <br>
            <input type="submit" value="Submit">
        </form>
        <form action="Register.php" method="post">
            <input type="submit" value="Register">
        </form> 
</div>

<?php
session_start();  // Start the session at the beginning

$connection = mysqli_connect('localhost', 'root', '', 'semester project 2');
if (!$connection) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Get data from form
$user = $_POST['username'];
$pass = $_POST['password'];

// Create a prepared statement
$stmt = mysqli_prepare($connection, "SELECT * FROM users WHERE Username=? AND Password=?");

// Bind the variables to the statement
mysqli_stmt_bind_param($stmt, "ss", $user, $pass);

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    // Get the user ID
    $user_id = $row["User_ID"];
    $school_id = $row["School_Id"];
    $type = $row["Type"];
    $loanednumber = $row["Number_Of_Loaned_Books"];
    
    // Store user_id in the session so it can be accessed on other pages
    $_SESSION['user_id'] = $user_id;
    $_SESSION['school_id'] = $school_id;
    $_SESSION['type'] = $type;
    $_SESSION['loanednumber'] = $loanednumber;



    if ($type==0){header("Location: mainpageuser.php"); /* THIS IS A USER*/}
    if ($type==1){header("Location: mainpageuser.php"); /* THIS IS A TEACHER */}
    if ($type==3){header("Location: mainpagesadmin.php"); /* SCHOOOL ADMIN*/}
    if ($type==4){header("Location: mainpagesadministrator.php"); /* ADMINISTRATOR*/}
        
    exit();
} else {
    echo "Wrong username or password";
    //header("Location: login.html");
}

mysqli_close($connection);
?>
