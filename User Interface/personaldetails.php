<?php
                // Start the session
                session_start();

                // Check if the user is logged in
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    // Now you can use $user_id in your script

                    // Check the user type
                    if (isset($_SESSION['type'])) {
                        $user_type = $_SESSION['type'];

                        // Redirect based on user type
                        if ($user_type == 0) {
                          
                            header("Location: personaldetailsuser.php");
                            exit(); // Redirect to main page for type 0
                           exit();
                        } elseif ($user_type == 1) {
                            
                            header("Location: personaldetailsteacher.php");
                            exit(); // Redirect to main page for type 1
                           exit();
                        } elseif ($user_type == 2) {
                            
                            header("Location: personaldetailsadmin.php");
                            exit();
                        } elseif ($user_type == 3) {
                            
                            header("Location: personaldetailsadministrator.php");
                            exit();
                        }
                    }
                    
                }
                
                ?>