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
                <li><a href="searchusers.php">Search Users</a></li>
            <li><a href="searchratings.php">Search Ratings</a></li>
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
    
    
    <main>
       
        
        <div class="content-wrapper">

            <section class="main-content">
                <!-- <h1>Welcome to Our Library!</h1> -->

                <div class="search-container">
                    <h2>Search for Books</h2>
                    <form action="" method="post">
                        <input type="text" name="search" placeholder="Type search term...">
                        <select name="criteria">
                            <option value="title">Title</option>
                            <option value="genre">Genre</option>
                            <option value="author">Author</option>
                            <option value="copies">Copies</option>
                        </select>
                        <input type="submit" value="Search">
                    </form>
                </div>

                <div class="echobooks">
                        <div id="bookModal" class="modal">
                                        <div class="modal-content">
                                            <h2 id="modalTitle"></h2>
                                            <p id="modalAuthor"></p>
                                            <p id="modalPages"></p>
                                        </div>
                        </div>
                    <?php
                            if (isset($_POST['search'])) {


                                $searchKeyword = $_POST['search'];
                                $criteria = $_POST['criteria'];
                    
                    
                                if ($criteria === 'title') {
                                    $query = "SELECT * FROM books WHERE Title LIKE '%$searchKeyword%'";                    
                                    } 
                    
                                elseif ($criteria === 'genre') {
                                    $query="SELECT b.* FROM books as b
                                    JOIN category_book as cb on cb.book_id=b.Book_Id
                                    JOIN categories as c on c.Category_Id=cb.category_id
                                    WHERE c.Name LIKE '%$searchKeyword%' ";
                                    }
                    
                                elseif ($criteria === 'author') {           
                                    $query="SELECT b.* FROM books as b
                                    JOIN author_book as ab on ab.book_id=b.Book_Id
                                    JOIN author as a on a.Author_Id=ab.author_id
                                    WHERE a.First_Name LIKE '%$searchKeyword%' ";

                                    } 
                    
                                else if ($criteria =='copies') {
                                    $query= "SELECT * FROM books WHERE Available_Copies LIKE '%$searchKeyword%'";   
                                }
                                      // Check if any book_ids were retrieved
                                if (!empty($bookIds)) {
                                    $query = "SELECT * FROM books WHERE Book_Id IN (" . implode(",", $bookIds) . ")";
                                }
                                
                                
                                    
                                
                    
                    
                    
                    
                    
                    
                    
                                $result = mysqli_query($connection, $query);
                    
                                if (!$result) {die('Query failed: ' . mysqli_error($connection));}
                                //Printing The Returned Books
                    
                                if (mysqli_num_rows($result) > 0) {// Check if there are any books returned
                                // Output table header
                                
                                // echo '<table>';
                                // echo '<tr><th>Title</th><th>Author Name</th><th>Pages</th><th>Action</th></tr>'; // Ad
                    
                                // Output each book row
                               
                                // Fetch and display the books
                                
                                while ($row = mysqli_fetch_assoc($result)) {
                                    //if($i<20){
                                    
                                    
                                    // echo '<tr>';
                                    // echo '<td>' . $row['Title'] . '</td>';
                                    
                                    $bookId = $row['Book_Id'];
                                    $authorQuery = "SELECT author_id FROM author_book WHERE book_id = '$bookId'";
                                    
                                    $resultAuthor = mysqli_query($connection, $authorQuery);
                    
                                    $row2 = mysqli_fetch_assoc($resultAuthor);
                                    $authorId = $row2['author_id'];
                                    
                                    // Query the author table using the author_id
                                    $authorTableQuery = "SELECT * FROM author WHERE Author_Id = $authorId";
                                    $resultAuthorTable = mysqli_query($connection, $authorTableQuery);
                    
                                    $author = mysqli_fetch_assoc($resultAuthorTable);
                                        
                                    
                                    echo '<div class="book-card" onclick="openBookModal(\'' . $row['Title'] . '\', \'' . $author['First_Name'] . ' ' . $author['Last_Name'] . '\', \'' . $row['Pages'] . '\')">';
                                    echo '<img src="image1.jpg" alt="Book Cover">';
                                    echo '<h2>' . $row['Title'] . '</h2>';
                                    echo '<td>
                                        <form method="post" action="bookDetails.php">
                                            <input type="hidden" name="bookId" value="' . $bookId . '">
                                            <input type="submit" name="submit" value="View Details">
                                        </form>
                                        </td>';
                                    //echo '<h2>' . $row['ISBN'] . '</h2>';
                                    echo '</div>';
                                   
                                }
                    
                            
                    
                    
                                // echo '</table>';
                                // echo '</table>';
                    
                    
                                }else {
                                echo 'No books found.';
                                }
                            }
                        
                    
                    
                                
                            
                    
                    
                        
                      //Done Printing The Returned Books
                    // Free the result set
                      mysqli_free_result($result);
                      mysqli_close($connection);
                    
                    ?>
                </div>
            </section>
        </div>
    </main>
    
</body>
</html>
