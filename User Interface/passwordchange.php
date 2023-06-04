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
        // session_start();


        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            // Now you can use $user_id in your script
        } else {
            //The user is not logged in
            //header("Location: login.html"); /* Redirect browser */
            }        


        $connection = mysqli_connect('localhost', 'root','', 'semester project 2');
        
        if (!$connection) {die("Connection failed: " . mysqli_connect_error());}

        if (isset($_POST['old_password'])) {

            $old_password = $_POST["old_password"];
            $new_password = $_POST["new_password"];
            $confirm_password = $_POST["confirm_password"];

            $user_id = $_SESSION["user_id"]; //Assuming you're storing user_id in session.

            $sql = "SELECT password FROM users WHERE user_id='$user_id'";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                if($old_password == $row["password"]) { //Checking old password
                    if($new_password == $confirm_password) { //Checking if new passwords match
                        $sql = "UPDATE users SET password='$new_password' WHERE User_ID='$user_id'";
                        if(mysqli_query($connection, $sql)) {
                            echo "Password updated successfully.";

                        } else {
                            echo "Error updating password: " . mysqli_error($connection);
                        }
                    } else {
                        echo "New passwords do not match.";
                    }
                } else {
                    echo "Old password is incorrect.";
                }
            } else {
                echo "No such user found.";
            }
        }

        mysqli_close($connection);
        ?>
        </div>
    </body>
<form method="POST" action="passwordchange.php">
  <label for="old_password">Old Password:</label>
  <input type="password" name="old_password" id="old_password" required><br><br>

  <label for="new_password">New Password:</label>
  <input type="password" name="new_password" id="new_password" required><br><br>

  <label for="confirm_password">Confirm New Password:</label>
  <input type="password" name="confirm_password" id="confirm_password" required><br><br>

  <input type="submit" value="Change Password">
</form>

</html>
