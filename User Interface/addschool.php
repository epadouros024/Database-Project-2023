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
            <li><a href="mainpageadministrator.php">Mainpage</a></li>
                
                <li><a href="logout.php">Logout</a></li>
                <li><a href="personaldetails.php">Personal Details</a></li>
                <li><a href="passwordchange.php">Change Password</a></li>

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
    
    <form method="POST" action="insert_school.php">
    <label for="school_name">School Name:</label>
    <input type="text" name="school_name" id="school_name" required><br><br>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br><br>

    <label for="administrator_id">Administrator ID:</label>
    <input type="text" name="administrator_id" id="administrator_id" required><br><br>

    <label for="address_id">Address ID:</label>
    <input type="number" name="address_id" id="address_id" required><br><br>

    <label for="school_admin_id">School Admin ID:</label>
    <input type="number" name="school_admin_id" id="school_admin_id" required><br><br>

    <input type="submit" value="Insert School">
    </form>


    <?php
        // Assuming you have established a database connection
        // Start the session
        //session_start();

        $user_id = $_SESSION['user_id'];
        $Number_Of_Loaned_Books = $_SESSION['loanednumber'];

        $connection = mysqli_connect('localhost', 'root', '', 'semester project 2');

        if (!$connection) {die('Connection failed: ' . mysqli_connect_error());}

        // Create a new school record
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $schoolName = $_POST["school_name"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $administratorId = $_POST["administrator_id"];
            $addressId = $_POST["address_id"];
            $schoolAdminId = $_POST["school_admin_id"];

            // Create a prepared statement
            $stmt = $connection->prepare("INSERT INTO school (School_Name, Phone, Email, Administrator_ID, Address_Id, School_Admin_Id)
                                    VALUES (?, ?, ?, ?, ?, ?)");

            // Bind parameters to the statement
            $stmt->bind_param("ssssii", $schoolName, $phone, $email, $administratorId, $addressId, $schoolAdminId);

            // Execute the statement
            if ($stmt->execute()) {
                echo "School inserted successfully!";
            } else {
                echo "Error inserting school: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }

        // Close the database connection
        $connection->close();
        ?>
    


                        </body>
