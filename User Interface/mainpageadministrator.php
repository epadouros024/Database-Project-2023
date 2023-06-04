<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<script src="openbooks.js"></script>
<button id="backup-btn">Backup Database</button>

<script>
document.getElementById('backup-btn').addEventListener('click', function() {
    fetch('/path/to/backup.php')
    .then(response => response.text())
    .then(alert);
});
</script>
<button id="restore-btn">Restore Database</button>

<script>
document.getElementById('restore-btn').addEventListener('click', function() {
    fetch('/path/to/restore.php')
    .then(response => response.text())
    .then(alert);
});
</script>
    <header>
        <nav>
            <ul>
                <li><a href="redirect.php">Mainpage</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="passwordchange.php">Change Password</a></li>
                <li><a href="personaldetails.php">Personal Details</a></li>

                <li><a href="addbook.php">Add Book</a></li>
                <li><a href="addschool.php">Add School</a></li>

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
        
            
    </div>
</section>
</div>
</main>
<button onclick="document.getElementById('query7').style.display = 'block'">7th Query</button>

<div id="query7" style="display:none">
<?php
$host = "localhost";
$db = "semester project 2";
$user = "root";
$pass = "";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "


SELECT 
    a.First_Name,
    a.Last_Name,
    COUNT(ba.book_id) as book_count
FROM 
    author a
JOIN 
    author_book ba ON a.Author_Id = ba.author_id
GROUP BY 
    a.First_Name,
    a.Last_Name
HAVING 
    COUNT(ba.book_id) <= (SELECT MAX(book_count) - 5 FROM 
                            (SELECT 
                                COUNT(book_id) as book_count 
                            FROM 
                                author_book
                            GROUP BY 
                                author_id) as subquery);


";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    echo "First Name: " . $row["First_Name"]. ", Last Name: " . $row["Last_Name"]. ", Book Count: " . $row["book_count"]. "<br>";
}
} else {
echo "0 results";
}

$conn->close();
?> 

</div>


</div>







        <button onclick="document.getElementById('query6').style.display = 'block'">6th Query</button>

            <div id="query6" style="display:none">
            <?php
            $host = "localhost";
            $db = "semester project 2";
            $user = "root";
            $pass = "";

            // Create connection
            $conn = new mysqli($host, $user, $pass, $db);

            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            $sql = "
                SELECT
                cb1.category_id AS category_id1,
                c1.Name AS category_name1,
                cb2.category_id AS category_id2,
                c2.Name AS category_name2,
                COUNT(*) AS pair_count
            FROM
                (
                    SELECT DISTINCT book_id, category_id
                    FROM category_book
                ) cb1
            JOIN
                (
                    SELECT DISTINCT book_id, category_id
                    FROM category_book
                ) cb2 ON cb1.book_id = cb2.book_id
            JOIN
                borrow b ON b.Books_Book_Id = cb1.book_id
            JOIN
                categories c1 ON cb1.category_id = c1.Category_Id
            JOIN
                categories c2 ON cb2.category_id = c2.Category_Id
            WHERE
                cb1.category_id < cb2.category_id
            GROUP BY
                category_id1,
                category_name1,
                category_id2,
                category_name2
            ORDER BY
                pair_count DESC
            LIMIT 3;
        
                
            ";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "Category Name: " . $row["category_name1"]. ", Pair Count: " . $row["pair_count"]."<br>";
            }
            } else {
            echo "0 results";
            }

            $conn->close();
            ?> 



            </div>




<button onclick="document.getElementById('query5').style.display = 'block'">5th Query</button>

            <div id="query5" style="display:none">
            <?php
            $host = "localhost";
            $db = "semester project 2";
            $user = "root";
            $pass = "";

            // Create connection
            $conn = new mysqli($host, $user, $pass, $db);

            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            $sql = "
                                        
                    SELECT 
                    b1.School_Admin_Id, 
                    COUNT(b1.Books_Book_Id) as book_count
                FROM 
                    borrow b1
                WHERE 
                    b1.Date_of_Borrow BETWEEN DATE_SUB(NOW(), INTERVAL 1 YEAR) AND NOW()
                GROUP BY 
                    b1.School_Admin_Id
                HAVING 
                    COUNT(b1.Books_Book_Id) > 20 
                    AND 
                    (
                        SELECT COUNT(*) 
                        FROM (
                            SELECT 
                                b2.School_Admin_Id, 
                                COUNT(b2.Books_Book_Id) as book_count
                            FROM 
                                borrow b2
                            WHERE 
                                b2.Date_of_Borrow BETWEEN DATE_SUB(NOW(), INTERVAL 1 YEAR) AND NOW()
                            GROUP BY 
                                b2.School_Admin_Id
                            HAVING 
                                COUNT(b2.Books_Book_Id) > 20
                        ) as subquery 
                        WHERE subquery.book_count = COUNT(b1.Books_Book_Id)
                    ) > 1
                ORDER BY 
                    COUNT(b1.Books_Book_Id);

            
            ";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "Admin ID: " . $row["School_Admin_Id"]. ", Book Count: " . $row["book_count"]."<br>";
            }
            } else {
            echo "0 results";
            }

            $conn->close();
            ?>                   

        

        </div>   





            <button onclick="document.getElementById('query4').style.display = 'block'">4th Query</button>

                <div id="query4" style="display:none">
                <?php
                $host = "localhost";
                $db = "semester project 2";
                $user = "root";
                $pass = "";

                // Create connection
                $conn = new mysqli($host, $user, $pass, $db);

                // Check connection
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }

                $sql = "
                
                SELECT a.Author_Id, a.First_Name,a.Last_Name
                FROM author a
                LEFT JOIN author_book ab ON a.Author_Id = ab.Author_Id
                LEFT JOIN borrow b ON ab.Book_Id = b.Books_Book_Id
                WHERE b.Books_Book_Id IS NULL
                GROUP BY a.Author_Id, a.First_Name,a.Last_Name;

                    
                ";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "Author Name: " . $row["First_Name"]. " " . $row["Last_Name"]."<br>";
                }
                } else {
                echo "0 results";
                }

                $conn->close();
                ?> 

                

            </div>







            <button onclick="document.getElementById('query3').style.display = 'block'">3rd Query</button>

                <div id="query3" style="display:none">
                <?php
                $host = "localhost";
                $db = "semester project 2";
                $user = "root";
                $pass = "";

                // Create connection
                $conn = new mysqli($host, $user, $pass, $db);

                // Check connection
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }

                $sql = "
                
                SELECT u.User_ID, u.First_Name, u.Last_Name, COUNT(*) AS Books_Borrowed
                FROM users u
                JOIN borrow b ON u.User_ID = b.User_ID
                JOIN books bk ON bk.Book_Id = b.Books_Book_Id
                WHERE u.Age < 40 AND u.Type = 1
                GROUP BY u.User_ID, u.First_Name, u.Last_Name
                ORDER BY Books_Borrowed DESC;
                
                    
                ";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "Teacher's Name: " . $row["First_Name"]. " " . $row["Last_Name"]."<br>";
                }
                } else {
                echo "0 results";
                }

                $conn->close();
                ?> 


                </div>






                <form method="POST" action="">
                        <label for="genre">Query 2 Genre:</label>
                        <input type="text" name="genre" id="genre" required>
                        <input type="submit" value="Search">
                    </form>
                <button onclick="document.getElementById('query21').style.display = 'block'">2 Query</button>

                <div id="query21" style="display:none">
                
                    <?php
                    if (isset($_POST['genre'])) {
                        $genre = $_POST['genre'];

                        $host = "localhost";
                        $db = "semester project 2";
                        $user = "root";
                        $pass = "";

                        // Create connection
                        $conn = new mysqli($host, $user, $pass, $db);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "
                        SELECT DISTINCT a.Author_Id, a.First_Name, a.Last_Name
                        FROM author a
                        JOIN author_book ab ON a.Author_Id = ab.Author_Id
                        JOIN books b ON ab.Book_Id = b.Book_Id
                        JOIN category_book cb ON b.Book_Id = cb.Book_Id
                        JOIN categories c ON cb.Category_Id = c.Category_Id
                        WHERE c.Name = '$genre'
                        ORDER BY a.First_Name, a.Last_Name
                        ";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "Author's Name: " . $row["First_Name"] . " " . $row["Last_Name"] . "<br>";
                            }
                        } else {
                            echo "0 results";
                        }

                        $sql = "
                        
                        -- Ερώτημα για τους εκπαιδευτικούς που έχουν δανειστεί βιβλία αυτής της κατηγορίας το τελευταίο έτος
                        SELECT DISTINCT u.User_ID, u.First_Name, u.Last_Name
                        FROM users u
                        JOIN borrow b ON u.User_ID = b.User_ID
                        JOIN books bk ON bk.Book_Id = b.Books_Book_Id
                        JOIN category_book cb ON bk.Book_Id = cb.Book_Id
                        JOIN categories c ON cb.Category_Id = c.Category_Id
                        WHERE c.Name = '$genre' AND YEAR(b.Date_of_Borrow) = YEAR(CURRENT_DATE) - 1
                        AND u.Type = 1
                        ORDER BY u.Last_Name, u.First_Name;

                        
                            
                        ";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "Teacher's Name: " . $row["First_Name"]. " " . $row["Last_Name"]."<br>";
                        }
                        } else {
                        echo "0 results";
                        }

                        $conn->close();
                    }
                    ?>
                  
                </div>


                

                <form method="POST" action="">
                <label for="search_type">Search by:</label>
                <select name="search_type" id="search_type">
                    <option value="year">Year</option>
                    <option value="month">Month</option>
                </select>
                <br><br>
                <label for="value">Query 1:</label>
                <input type="text" name="value" id="value" required>
                <br><br>
                <input type="submit" value="Search">
            </form>
            <button onclick="document.getElementById('query1').style.display = 'block'">1st Query</button>

            <div id="query1" style="display:none">
                <?php
                if (isset($_POST['search_type']) && isset($_POST['value'])) {
                    $search_type = $_POST['search_type'];
                    $value = $_POST['value'];

                    $host = "localhost";
                    $db = "semester project 2";
                    $user = "root";
                    $pass = "";

                    // Create connection
                    $conn = new mysqli($host, $user, $pass, $db);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    if ($search_type == "year") {
                        // Year search query
                        $sql = "SELECT s.School_Name, COUNT(*) AS Total_BorrowedBooks
                                FROM borrow b
                                JOIN users u ON b.User_ID = u.User_ID
                                JOIN school s ON u.School_Id = s.idSchool
                                WHERE YEAR(b.Date_of_Borrow) = '$value'
                                GROUP BY s.School_Name";
                    } elseif ($search_type == "month") {
                        // Month search query
                        $sql = "SELECT s.School_Name, COUNT(*) AS Total_Borrows
                                FROM borrow b
                                JOIN school s ON b.School_idSchool = s.idSchool
                                WHERE MONTHNAME(b.Borrow_Date) = '$value'
                                GROUP BY s.School_Name";
                    }

                    $result = $conn->query($sql);

                    if ($result) {
                        if ($result->num_rows > 0) {
                            echo "<h2>Total Borrows per School:</h2>";
                            echo "<ul>";
                            while ($row = $result->fetch_assoc()) {
                                $schoolName = $row['School_Name'];
                                $totalBorrows = $row['Total_BorrowedBooks'];
                                echo "<li>$schoolName: $totalBorrows</li>";
                            }
                            echo "</ul>";
                        } else {
                            echo "No results found.";
                        }
                    } else {
                        echo "Error executing query: " . $conn->error;
                    }

                    $conn->close();
                }
                ?>
            </div>

                  
                </div>



</body>
</html>