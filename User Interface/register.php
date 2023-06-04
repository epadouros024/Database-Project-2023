<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        .centered-text {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class='centered-text'>
    <h2>User Registration</h2>
    <form method="post" action="register.php">

        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" required><br><br>
        
        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" required><br><br>
        
        <label for="age">Age:</label>
        <input type="number" name="age" id="age" required><br><br>
        
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="school">School:</label>
        <select name="school" id="school" required>
            <option value="1">School 1</option>
            <option value="2">School 2</option>
            <option value="3">School 3</option>
            <!-- Add more options as needed -->
        </select><br><br>

        <label for="usertype">User Type:</label>
        <select id="usertype" name="usertype">
            <option value="1">Simple User</option>
            <option value="2">Teacher</option>
            <option value="3">Admin</option>
            <option value="4">Administrator</option>
        </select><br><br>


        
        <input type="submit" name="register" value="Register">
    </form>

    </div>
</body>
</html>

<?php

session_start();


        // if (isset($_SESSION['user_id'])) {
        //     $user_id = $_SESSION['user_id'];
        //     // Now you can use $user_id in your script
        // } else {
        //     //The user is not logged in
        //     header("Location: login.html"); /* Redirect browser */
        //     }        


        $connection = mysqli_connect('localhost', 'root','', 'semester project 2');
        
        if (!$connection) {die("Connection failed: " . mysqli_connect_error());}

        if($stmt = $connection->prepare("INSERT INTO users (Username, Password, First_Name, Last_Name, Age, email, School_Id) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            // Bind variables to the prepared statement
            $stmt->bind_param("ssssiss", $username, $password, $firstname, $lastname, $age, $email, $school);
            
            // Set the variables
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password']; // This should be hashed before storage
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $age = $_POST['age'];
            $school = $_POST['school'];
            //$usertype = $_POST['usertype'];
            
            // Execute the prepared statement
            if($stmt->execute()) {
                // Registration successful
                header("Location: login.html");
                exit();
            } else {
                // Registration failed
                echo "Error: " . $stmt->error;
            }
            
            $stmt->close();
        }
        

?>
