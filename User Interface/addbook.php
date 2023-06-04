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

                <li><a href="addbook.php">Add Book</a></li>
                
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

    <form method="POST" action="insert_book.php">
    <label for="isbn">ISBN:</label>
    <input type="text" name="isbn" id="isbn" required><br><br>

    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required><br><br>

    <label for="publisher">Publisher:</label>
    <input type="text" name="publisher" id="publisher" required><br><br>

    <label for="pages">Pages:</label>
    <input type="number" name="pages" id="pages" required><br><br>

    <label for="available_copies">Available Copies:</label>
    <input type="number" name="available_copies" id="available_copies" required><br><br>

    <label for="image">Image:</label>
    <input type="text" name="image" id="image" required><br><br>

    <label for="summary">Summary:</label>
    <textarea name="summary" id="summary" required></textarea><br><br>

    <label for="language">Language:</label>
    <input type="text" name="language" id="language" required><br><br>

    <label for="keywords">Keywords:</label>
    <input type="text" name="keywords" id="keywords" required><br><br>


    <input type="submit" value="Insert Book">
    </form>

<?php
// Assuming you have established a database connection
// Start the session
//session_start();

$user_id = $_SESSION['user_id'];
$Number_Of_Loaned_Books = $_SESSION['loanednumber'];

$connection = mysqli_connect('localhost', 'root', '', 'semester project 2');

if (!$connection) {die('Connection failed: ' . mysqli_connect_error());}

// Create a new book record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $isbn = $_POST["isbn"];
    $title = $_POST["title"];
    $publisher = $_POST["publisher"];
    $pages = $_POST["pages"];
    $availableCopies = $_POST["available_copies"];
    $image = $_POST["image"];
    $summary = $_POST["summary"];
    $language = $_POST["language"];
    $keywords = $_POST["keywords"];
    $schoolId = $school_id;
    $authorId = $_POST["author_id"];
    $categoryId = $_POST["category_id"];

    // Create a prepared statement
    $stmt = $connection->prepare("INSERT INTO book (ISBN, Title, Publisher, Pages, Available_Copies, Image, Summary, Language, KeyWords, School_idSchool, Author_Id, Category_Id)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters to the statement
    $stmt->bind_param("sssiissssiis", $isbn, $title, $publisher, $pages, $availableCopies, $image, $summary, $language, $keywords, $schoolId, $authorId, $categoryId);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Book inserted successfully!";
    } else {
        echo "Error inserting book: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$connection->close();
?>


                        </body>
