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
                    <h2>Search for Ratings</h2>
                    <form action="" method="post">
                        <input type="text" name="search" placeholder="Type search term...">
                        <select name="criteria">
                            <option value="genre">Genre</option>
                            <option value="user">User</option>
                            
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
                    
                    
                                if ($criteria === 'genre') {
                                    $query = " SELECT c.Name, AVG(r.Linkert_Scale) AS Average_Rating
                                    FROM categories c
                                    JOIN category_book cb ON c.Category_Id = cb.category_id
                                    JOIN review r ON cb.book_id = r.Books_Book_Id
                                    WHERE c.Name LIKE '%$searchKeyword%'
                                    GROUP BY c.Name; ";                   
                                    } 
                    
                                elseif ($criteria === 'user') {
                                    $query = " SELECT users.User_ID, users.First_Name, users.Last_Name, AVG(review.Linkert_Scale) AS Average_Rating
                                    FROM users
                                    JOIN review ON review.User_ID = users.User_ID
                                    WHERE users.First_Name LIKE '%$searchKeyword%' OR users.Last_Name LIKE '%$searchKeyword%'
                                    GROUP BY users.User_ID, users.First_Name, users.Last_Name;
                                     "; 
                                    }
                                                    
                                    // Check if any book_ids were retrieved
                                
                
                                    $result = mysqli_query($connection, $query);
                        
                                    if (!$result) {die('Query failed: ' . mysqli_error($connection));}
                                    //Printing The Returned Books
                        
                                    if (mysqli_num_rows($result) > 0) {// Check if there are any books returned

                                        
                                        while ($row = mysqli_fetch_assoc($result)) {

                                            $rating = $row['Average_Rating'];
                                            
                                                                                        
                                            //echo "<h2>{$row['Title']}</h2>";
                                            echo '<div style="text-align: center; line-height: 1.2;">';
                                            //echo "<h2>{$row['USER']}</h2>";
                                            echo "<p>Average rating {$rating}</p>";
                                            echo '</div>';
                                        
                                    }
                                }
                                }else {
                                echo 'No users found.';
                                }
                            //}

                        mysqli_free_result($result);
                        mysqli_close($connection);
                    
                    ?>
                </div>
            </section>
        </div>
    </main>
    
</body>
</html>
