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
                <li><a href="mainpageuser.php">Mainpage</a></li>
                <li><a href="login.html">Login</a></li>
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
                    $author = mysqli_fetch_assoc($author_result);

                    // $cat_query="SELECT DISTINCT a.* FROM author AS a
                    // JOIN author_book AS ab ON ab.author_id = a.Author_Id
                    // JOIN books AS b ON ab.book_id = b.Book_Id
                    // WHERE b.Book_Id = '$book_id'";

                    // $author_result = mysqli_query($connection, $author_query);
                    // $author = mysqli_fetch_assoc($author_result)
                                   
                                   
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
                                    <div class="cell">Last Name</div>

                                    <div class="cell"> 
                                        <?php
                                        echo "<p>" . $author['First_Name'] .' '.$author['Last_Name']. "</p>";
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
                                            echo "<p>" . $schoolname . "</p>";
                                            ?>
                                        
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="cell">Email</div>
                                    <div class="cell">
                                            <?php
                                            echo "<p>" . $email . "</p>";
                                            ?>
                                        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="cell">School</div>
                                    <div class="cell">

                                            <?php
                                            echo "<p>" . $schoolname . "</p>";
                                            ?>
                                        
                                    </div>
                                </div>
                    </div>
</body>
</html>
