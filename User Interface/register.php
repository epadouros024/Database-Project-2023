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
            <option value="1">Jefferson Middle School</option>
            <option value="2">Lincoln High School</option>
            <option value="3">New Arc High School</option>
            <option value="3">Washington Elementary School</option>
        </select><br><br>       
            <label for="usertype">User Type:</label>
        <select name="usertype" id="usertype" required>
            <option value="0">Student</option>
            <option value="1">Teacher</option>
            <option value="2">Admin</option>
            <option value="3">Administrator</option>

        </select><br><br>


        
        <input type="submit" name="register" value="Register">
    </form>

    </div>
</body>
</html>

<?php

session_start();

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
        






// if(isset($_POST['register'])) {



//     // Retrieve form data
//     $username = $_POST['username'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $firstname = $_POST['firstname'];
//     $lastname = $_POST['lastname'];
//     $age = $_POST['age'];
//     $school = $_POST['school'];
    
//     $insertQuery = "INSERT INTO users (Username, Password, First_Name, Last_Name,Age, email,School_Id) 
//     VALUES ('$username', '$password', '$firstname', '$lastname', $age, '$email',$school)";

//     // Perform necessary validation and processing
//     // ... (e.g., check for duplicate usernames, validate email format, hash password)
    
//     // Save user data to database or perform other registration actions
//     // ...
//     //$insertQuery = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
//     if(mysqli_query($connection, $insertQuery)) {
//         // Registration successful
//         echo "The new user is: ";
//         echo $username;
//         header("Location: success.html");
//         exit();
//     } else {
//         // Registration failed
//         echo "Error: " . mysqli_error($connection);
//     }
    
//     // Redirect the user to a success page or display a success message
    
//     echo "The new user is: ";
//     echo $username;
    
//     //header("Location: login.html");
//     exit();
// }
?>
