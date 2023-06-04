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
                <li><a href="personaldetails.php">Personal Details</a></li>
                <li><a href="passwordchange.php">Change Password</a></li>
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
            <button onclick="document.getElementById('query').style.display = 'block'">7th Query</button>

            <div id="query" style="display:none">
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







            <button onclick="document.getElementById('query2').style.display = 'block'">5th Query</button>

                        <div id="query2" style="display:none">
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







                    <button onclick="document.getElementById('query3').style.display = 'block'">6th Query</button>

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
                            
                            SELECT
                                a.Author_Id,
                                a.First_Name,
                                a.Last_Name
                            FROM
                                author a
                            LEFT JOIN
                                books b ON a.author_id = b.author_id
                            LEFT JOIN
                                borrow br ON b.Book_Id = br.Books_Book_Id
                            WHERE
                                br.Books_Book_Id IS NULL
                            GROUP BY
                                a.author_id,
                                a.First_Name,
                                a.Last_Name

                                
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




</body>
</html>