<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <style>
    body {
        height: 100%;
        }

    .center-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        }
    </style>

</head>
    <body>
    <div class="center-container">   
        <form action="" method="post">
            Old Password: <input type="password" name="old_password"><br>
            New Password: <input type="password" name="new_password"><br>
            Confirm Password: <input type="password" name="confirm_password"><br>
            <input type="submit" value="Change Password">
        </form>

        <form action="mainpage.php" method="post">
            <input type="submit" value="Back to Mainpage">
        </form>





        <?php
        session_start();


        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            // Now you can use $user_id in your script
        } else {
            //The user is not logged in
            header("Location: login.html"); /* Redirect browser */
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
</html>
