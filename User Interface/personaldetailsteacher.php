<!DOCTYPE html>
<html>
<head>
    <title>Personal Details</title>
   <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
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
                         
                         $sql = "SELECT * FROM users WHERE User_ID = '$user_id'";
                         $result = mysqli_query($connection, $sql);
     
                         $row = mysqli_fetch_assoc($result);
                     
                         if ($row) {
                             // Save the data in respective variables
                             $first_name = $row["First_Name"];
                             $last_name = $row["Last_Name"];
                             //$school_id = $row["School_Id"];
                             $age=$row["Age"];
                             $email=$row["email"];
     
                             $sql2 = "SELECT School_Name FROM school WHERE idSchool = '$school_id'";
                             $result2 = mysqli_query($connection, $sql2);
     
                             $row2 = mysqli_fetch_assoc($result2);
     
                             $schoolname=$row2["School_Name"];
                           
                             } else {
                                 echo "User not found.";
                         }
             
                // Display the user's data in the navigation menu
                echo "Welcome, $first_name $last_name! | School: $schoolname | Age: $age";
                ?>

                <?php


                ?>


                </li>
            </ul>
        </nav>
    </header>

    <div class="table-style">
        <!-- Headers and how many collumns-->
            <div class="row header">
                <div class="cell">Detail</div>
                <div class="cell">Value</div>
            </div>
        <!-- Rows -->
                    <!-- 1st -->
            <div class="row">
                <div class="cell">First Name</div>

                <div class="cell">
                    <?php
                        echo "<p>" . $first_name . "</p>";
                    ?>
                </div>

            </div>
                    <!-- 2nd -->
            <div class="row">
                <div class="cell">Last Name</div>

                <div class="cell"> 
                    <?php
                    echo "<p>" . $last_name . "</p>";
                    ?>
                </div>

            </div>

                        <!-- 3rd -->
            <div class="row">
                <div class="cell">Age</div>
                <div class="cell">
                        <?php
                        echo "<p>" . $age . "</p>";
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


            <div class="row">
                <div class="cell">Email</div>
                <div class="cell">
                        <?php
                        echo "<p>" . $email . "</p>";
                        ?>
                    
                </div>
            </div>

            <div class="row">
                <div class="cell">Type</div>
                <div class="cell">

                        <?php
                        echo "<p>" ."Teacher". "</p>";
                        ?>
                    
                </div>
            </div>

            <div class="row">
                <div class="cell">Borrowed Book</div>
                <div class="cell">

                        <?php
                                    
                            //session_start(); // Start the session at the beginning

                                    

                            $connection = mysqli_connect('localhost', 'root','', 'semester project 2');

                            if (!$connection) {die('Connection failed: ' . mysqli_connect_error());}

                            $sqlborrow= "SELECT * FROM borrow WHERE User_ID = '$user_id' ";
                            
                            $resultborrow = mysqli_query($connection, $sqlborrow);
                
                            //$rowborrow = mysqli_fetch_assoc($resultborrow);
                            
                            while ($rowborrow = mysqli_fetch_assoc($resultborrow)) {
                                // Save the data in respective variables
                                $bookid = $rowborrow["Books_Book_Id"];

                                $returnday=$rowborrow["Day_of_Return"];
                                
                                
                                $sqlbook= "SELECT * FROM books WHERE Book_Id = '$bookid' ";

                                $resultbook = mysqli_query($connection, $sqlbook);
                
                                $rowbook = mysqli_fetch_assoc($resultbook);

                                $booktitle = $rowbook["Title"];
                            


                                $schoolname=$row2["School_Name"];
                                echo "<p>  . $booktitle . ||  </p>";
                                } 
                                    
                        ?>
                    
                </div>
            </div>
            <h2>Update Personal Details</h2>

<form action="" method="post">
<label for="fname">First Name:</label><br>
<input type="text" id="fname" name="fname" value=""><br>

<label for="lname">Last Name:</label><br>
<input type="text" id="lname" name="lname" value=""><br>

<label for="email">Email:</label><br>
<input type="email" id="email" name="email" value=""><br>

<input type="submit" name="update" value="Update">
</form> 

<?php
       

       $connection = mysqli_connect('localhost', 'root','', 'semester project 2');

       if (!$connection) {die('Connection failed: ' . mysqli_connect_error());}
// Include database connection
// require_once('db_connection.php');

if(isset($_POST['update'])) {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['email'];

    // Assuming user_id is stored in session
    // session_start();
    $user_id = $_SESSION['user_id'];

    // update data in mysql database 
    $sql="UPDATE Users SET First_Name='$firstname', Last_Name='$lastname', email='$email' WHERE User_ID='$user_id'";

    // Check if the query succeeded
    if(mysqli_query($connection, $sql)) {
        echo "Details Updated Successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}
?>



    </div>


</body>
</html>
