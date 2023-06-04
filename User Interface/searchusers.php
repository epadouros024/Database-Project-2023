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
    <main>
        <div class="content-wrapper">

            <section class="main-content">
                <!-- <h1>Welcome to Our Library!</h1> -->

                <div class="search-container">
                    <h2>Search for Users</h2>
                    <form action="" method="post">
                        <input type="text" name="search" placeholder="Type search term...">
                        <select name="criteria">
                            <option value="firstname">First Name</option>
                            <option value="last Name">Last Name</option>
                            <option value="days">Delayed Days</option>
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
                    
                    
                                if ($criteria === 'firstname') {
                                    $query = " SELECT DISTINCT users.*,DATEDIFF(NOW(), borrow.Day_of_Return)
                                    FROM users
                                    JOIN borrow ON users.User_ID = borrow.User_ID
                                    JOIN books ON books.Book_Id = borrow.Books_Book_Id
                                    WHERE borrow.Day_of_Return < NOW()
                                    AND Number_Of_Loaned_Books>0
                                    AND users.First_Name LIKE '%$searchKeyword%' 
                                    AND borrow.Status = 0 ";                   
                                    } 
                    
                                elseif ($criteria === 'lastname') {
                                    $query = " SELECT DISTINCT users.*,DATEDIFF(NOW(), borrow.Day_of_Return)
                                    FROM users
                                    JOIN borrow ON users.User_ID = borrow.User_ID
                                    JOIN books ON books.Book_Id = borrow.Books_Book_Id
                                    WHERE borrow.Day_of_Return < NOW()
                                    AND Number_Of_Loaned_Books>0
                                    AND borrow.Status = 0 
                                    AND users.Last_Name LIKE '%$searchKeyword%' "; 
                                    }
                    
                                elseif ($criteria === 'days') {         
                                    echo "MERES". $searchKeyword ;  
                                    $query =  " SELECT DISTINCT users.*,DATEDIFF(NOW(), borrow.Day_of_Return)
                                    FROM users
                                    JOIN borrow ON users.User_ID = borrow.User_ID
                                    JOIN books ON books.Book_Id = borrow.Books_Book_Id
                                    WHERE borrow.Day_of_Return < NOW()
                                    AND users.Number_Of_Loaned_Books > 0
                                    AND borrow.Status = 0 
                                    AND DATEDIFF(NOW(), borrow.Day_of_Return) > '$searchKeyword%'";
                                     

                                    } 
                                
                                    // Check if any book_ids were retrieved
                                
                
                                    $result = mysqli_query($connection, $query);
                        
                                    if (!$result) {die('Query failed: ' . mysqli_error($connection));}
                                    //Printing The Returned Books
                        
                                    if (mysqli_num_rows($result) > 0) {// Check if there are any books returned

                                        
                                        while ($row = mysqli_fetch_assoc($result)) {

                                            $user = $row['User_ID'];
                                            $fname=$row['First_Name'];
                                            $lname=$row['Last_Name'];
                                            $delayeddays=$row['DATEDIFF(NOW(), borrow.Day_of_Return)'];
                                                                                        
                                            //echo "<h2>{$row['Title']}</h2>";
                                            echo '<div style="text-align: center; line-height: 1.2;">';
                                            //echo "<h2>{$row['USER']}</h2>";
                                            echo "<p>User ID: {$user}</p>";
                                            echo "<p>First Name: {$fname}</p>";
                                            echo "<p>Last Name: {$lname}</p>";
                                            echo "<p>Delayed Days: {$delayeddays}</p>";

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
