<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<script src="openbooks.js"></script>

    <header>
        <nav>
            <ul>
                <li><a href="redirect.php">Mainpage</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="passwordchange.php">Change Password</a></li>
                <li><a href="personaldetails.php">Personal Details</a></li>
                <li>
                <?php
                         
                         session_start(); // Start the session at the beginning

                         if (isset($_SESSION['user_id'])) {
                             $user_id = $_SESSION['user_id'];
                             $school_id=$_SESSION['school_id'];
                             $type=$_SESSION['type'];
                             // Now you can use $user_id in your script
                         } else {
                             //The user is not logged in
                             header("Location: login.html"); /* Redirect browser */
                             }        
     
                         $connection = mysqli_connect('localhost', 'root','', 'semester project 2');
     
                         if (!$connection) {die('Connection failed: ' . mysqli_connect_error());}
                         
                         $sql = "SELECT Age,First_Name, Last_Name, School_Id FROM users WHERE User_ID = '$user_id'";
                         $result = mysqli_query($connection, $sql);
     
                         $row = mysqli_fetch_assoc($result);
                     
                         if ($row) {
                             // Save the data in respective variables
                             $first_name = $row["First_Name"];
                             $last_name = $row["Last_Name"];
                             //$school_id = $row["School_Id"];
                             $age=$row["Age"];
     
                             $sql2 = "SELECT School_Name FROM school WHERE idSchool = '$school_id'";
                             $result2 = mysqli_query($connection, $sql2);
     
                             $row2 = mysqli_fetch_assoc($result2);
     
                             $schoolname=$row2["School_Name"];
     
                             
     
                             } else {
                                 echo "User not found.";
                         }
            
                echo "Welcome, $first_name $last_name! | School: $schoolname | Age: $age";
                ?>
                </li>
            </ul>
        </nav>
    </header>
<?php
session_start();  // Start the session at the beginning

$connection = mysqli_connect('localhost', 'root', '', 'semester project 2');
if (!$connection) {
    die('Connection failed: ' . mysqli_connect_error());
}
// Retrieve form data
$book_id =$_POST['book_id'];
$user_id = $_SESSION['user_id']; // Assuming you're storing user_id in session
$text = $_POST['text'];
$linkert_scale = $_POST['linkert_scale'];

// Create a prepared statement
$stmt = $connection->prepare("INSERT INTO review (User_ID, Text, Linkert_Scale, Books_Book_Id) VALUES (?, ?, ?, ?)");

// Bind parameters to the statement
$stmt->bind_param("isss", $user_id, $text, $linkert_scale, $book_id);

// Execute the statement
if ($stmt->execute()) {
    echo "Review submitted successfully!";
    

} else {
    echo "Error submitting review: " . $stmt->error;
}

// Close the statement
$stmt->close();

// Close the database connection
$connection->close();
?>

<a href="redirect.php">Back to MainPage</a>
