<?php
// Start the session
session_start();

$user_id = $_SESSION['user_id'];
$Number_Of_Loaned_Books = $_SESSION['loanednumber'];

$connection = mysqli_connect('localhost', 'root', '', 'semester project 2');

if (!$connection) {die('Connection failed: ' . mysqli_connect_error());}

// Retrieve book_id from the POST parameters
$book_id = $_POST['bookId'];

// Check if the book is available
$book_query = "SELECT * FROM books WHERE Book_Id = $book_id";
$book_result = mysqli_query($connection, $book_query);


if (!$book_result) {die('Book query failed: ' . mysqli_error($connection));}

$book = mysqli_fetch_assoc($book_result);

$author_id=$book['Author_Id'];

// Check if the book is available
if ($book['Available_Copies'] > 0 && $Number_Of_Loaned_Books < 2) {

    $sql = "UPDATE books SET Available_Copies = Available_Copies - 1 WHERE Book_Id = $book_id";
    
    $sql2 = "UPDATE users SET Number_Of_Loaned_Books = Number_Of_Loaned_Books + 1 WHERE User_ID = $user_id";
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Get the current date
    $current_date = date("Y-m-d");

    // Calculate the return date
    $return_date = date("Y-m-d", strtotime($current_date. ' + 2 weeks'));

    // Generate a random number for School_Admin_Id
    $admin_id = rand(1, 10);  // assuming you have 100 admins

    // Create the loan request
    $borrow_query = "INSERT INTO borrow (Status, Date_of_Borrow, Day_of_Return, School_Admin_Id, Books_Book_Id, User_Id,Author_Id)
     VALUES (1, '$current_date', '$return_date', $admin_id, $book_id, $user_id,$author_id)";
    
    if (mysqli_query($connection, $borrow_query)) {
        echo "Loan request created successfully.";

        
    } else {
        echo "Error: " . $borrow_query . "<br>" . mysqli_error($connection);
    }
} else {
    if ($book['Available_Copies'] < 0){echo "Book is not available.";}
    else {echo "User has the maximum amount of loaned books";}
    
    echo " . $Number_Of_Loaned_Books .";
}
echo " Arxika . $Number_Of_Loaned_Books .";

$sql = "UPDATE users SET Number_Of_Loaned_Books = Number_Of_Loaned_Books + 1 WHERE User_ID = $user_id";

//$loanednumber = $row["Number_Of_Loaned_Books"];
    
// Store user_id in the session so it can be accessed on other pages
$_SESSION['loanednumber'] = $Number_Of_Loaned_Books +1 ;

$Number_Of_Loaned_Books= $_SESSION['loanednumber'];


echo " Telika . $Number_Of_Loaned_Books .";
echo '<a href="mainpage.php"><button>Back to Main Page</button></a>';

mysqli_close($connection);
?>
