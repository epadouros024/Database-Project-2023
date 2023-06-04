<?php
// Assuming you have established a database connection
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Retrieve book ID from query parameter or form submission
$book_id = isset($_POST['book_id']) ? $_POST['book_id'] : $_GET['book_id'];

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $user_id = $_SESSION['user_id']; // Assuming you're storing user_id in session
    $text = $_POST['text'];
    $linkert_scale = $_POST['linkert_scale'];

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO review (User_ID, Text, Linkert_Scale, Books_Book_Id) VALUES (?, ?, ?, ?)");

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
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leave a Review</title>
</head>
<body>
    <h1>Leave a Review</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
        
        <label for="text">Review Text:</label>
        <textarea name="text" id="text" rows="4" cols="50" required></textarea><br><br>
        
        <label for="linkert_scale">Linkert Scale:</label>
        <select name="linkert_scale" id="linkert_scale" required>
            <option value="1">1 - Very Poor</option>
            <option value="2">2 - Poor</option>
            <option value="3">3 - Neutral</option>
            <option value="4">4 - Good</option>
            <option value="5">5 - Excellent</option>
        </select><br><br>
        
        <input type="submit" name="submit" value="Submit Review">
    </form>
</body>
</html>
