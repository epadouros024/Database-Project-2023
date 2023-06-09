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
                    // Start the session
                    //session_start();

                    //$user_id = $_SESSION['user_id'];
                    //$Number_Of_Loaned_Books = $_SESSION['loanednumber'];

                    $connection = mysqli_connect('localhost', 'root', '', 'semester project 2');

                    if (!$connection) {die('Connection failed: ' . mysqli_connect_error());}

                    // Retrieve book_id from the POST parameters
                    $book_id = $_POST['bookId'];
                    
                    // Check if the book is available
                    $book_query = "SELECT * FROM books WHERE Book_Id = $book_id";
                    $book_result = mysqli_query($connection, $book_query);
                    $book = mysqli_fetch_assoc($book_result);



                    $author_query="SELECT DISTINCT a.* FROM author AS a
                    JOIN author_book AS ab ON ab.author_id = a.Author_Id
                    JOIN books AS b ON ab.book_id = b.Book_Id
                    WHERE b.Book_Id = '$book_id'";


                    $author_result = mysqli_query($connection, $author_query);
                    // $authors = mysqli_fetch_assoc($author_result);

                    

                    $category_query = "SELECT DISTINCT c.* 
                    FROM categories AS c
                    JOIN category_book AS cb ON cb.category_id = c.Category_Id
                    JOIN books AS b ON cb.book_id = b.Book_Id
                    WHERE b.Book_Id = '$book_id'";

                    $category_result = mysqli_query($connection, $category_query);
                    //$categories = mysqli_fetch_all($category_result);

                                   
                        ?>
                    
                    <div class="table-style">
                        <div class="row header">
                            <div class="cell">Detail</div>
                            <div class="cell">Value</div>
                        </div>
                            <!-- Rows -->
                            <!-- 1st -->
                                                    
                            <div class="row">
                                    <div class="cell"> <?php
                                $image_path = "image1.jpg";
                                echo "<img src='" . $image_path . "' alt='Book Cover' style='max-width: 300px;' >";

                            ?></div>
                                    <div class="cell">
                                        <?php echo '<td>
                                            <form method="post" action="loan.php">
                                                <input type="hidden" name="bookId" value="' . $book_id . '">
                                                <input type="submit" name="submit" value="Submit for Loan">
                                            </form>
                                            </td>';
                                        ?>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="cell">Title</div>

                                <div class="cell">
                                <?php
                                    echo "<p>" . $book['Title'] . "</p>";
                                ?>
                                    </div>

                                </div>
                                        <!-- 2nd -->
                                <div class="row">
                                    <div class="cell">Authors</div>

                                    <div class="cell"> 
                                        <?php
                                        
                                        if ($author_result && mysqli_num_rows($author_result) > 0) {
                                            // Iterate through authors and print their details
                                            while ($author = mysqli_fetch_assoc($author_result)) {
                                                echo "Author Name: " . $author['Last_Name'] .' '. $author['First_Name']."<br>";
                                                // Add more author details if needed
                                                echo "<br>";
                                            }
                                        } else {
                                            echo "No authors found for the book.";
                                        }
                                        ?>
                                    </div>

                                </div>

                                            <!-- 3rd -->
                                <div class="row">
                                    <div class="cell">Summary</div>
                                    <div class="cell">
                                            <?php
                                            echo "<p>" . $book['Summary'] . "</p>";
                                            ?>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="cell">Genre</div>
                                    <div class="cell">
                                            <?php
                                            echo "Categories:";
                                               if ($category_result && mysqli_num_rows($category_result) > 0) {
                                                // Iterate through authors and print their details
                                                while ($category = mysqli_fetch_assoc($category_result)) {
                                                    echo "" . $category['Name'] . "<br>";
                                                   
                                                    echo "<br>";
                                                    }
                                                } else {
                                                    echo "No authors found for the book.";
                                                }
                                            ?>
                                        
                                    </div>
                                </div>

                                

                                <div class="row">
                                    <div class="cell">Review</div>
                                    <div class="cell">
                                    <a href="review.php?book_id=<?php echo $book_id; ?>">Leave a Review</a>
   
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="cell">Reviews</div>
                                    <div class="cell">
                                    
   
                                            <?php
                                            
                                            $review_query = " SELECT * FROM review WHERE Books_Book_Id = '$book_id' ";

                                            $review_result = mysqli_query($connection, $review_query);

                                            if ($review_result && mysqli_num_rows($review_result) > 0) {
                                                // Iterate through authors and print their details
                                                while ($review = mysqli_fetch_assoc($review_result)) {
                                                    echo "Text: " . $review['Text'] ."<br>";
                                                    echo "Linkert Scale:" . $review['Linkert_Scale'] ."<br>";
                                                    // Add more author details if needed
                                                    echo "<br>";
                                                    }
                                                } else {
                                                    echo "No reviews found for the book.";
                                                }

                                            ?>

                                    </div>
                                </div>


                    </div>
</body>
</html>
