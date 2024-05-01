<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        <!--changed-->
                        yellowPrimary: 'rgb(253 224 71)',
                        redSecondary: 'rgb(220 38 38)',
                        greenSecondary: 'rgb(34 197 94)',
                    }
                }
            }
        }
    </script>
</head>
<body style="background-image: url(../ICON/login_singup_bg.jpeg); background-size: cover; background-position: center; background-repeat: no-repeat;">
<section class="h-screen justify-center items-center flex mx-4 md:mx-[15rem] -z-50">
    <div class="grid grid-cols-1 md:grid-cols-5 z-50 w-full h-[45rem] rounded-xl shadow-2xl">
        <div class="justify-center items-center flex bg-[#ffffff1e] backdrop-blur-[10px] rounded-l-xl md:col-span-3">
            <img src="../ICON/logo.png" alt="">
        </div>
        <div class="bg-yellowPrimary justify-start items-center flex px-4 md:px-10 rounded-r-xl md:col-span-2">
            <div class="flex flex-col w-full md:max-w-md mx-auto">
                <h1 class="text-4xl font-bold mb-6">Sign Up</h1>
                <?php
require_once('DBconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $domain = explode("@", $email)[1];
    
    if ($domain !== "g.bracu.ac.bd") {
        echo "<span style='color: red;'>Please use your G-suite email.</span>";
    } else {
        if (strlen($password) < 8) {
            echo "<span style='color: red;'>Password must be at least 8 characters long.</span>";
        } else {
            $check_email_query = "SELECT * FROM user WHERE email='$email'";
            $check_email_result = mysqli_query($conn, $check_email_query);
            
            if (mysqli_num_rows($check_email_result) > 0) {
                echo "<span style='color: red;'>An account with this email already exists.</span>";
            } else {
                $check_password_query = "SELECT * FROM user WHERE password='$password'";
                
                    $role = 'student';
                    $password = password_hash($password, PASSWORD_BCRYPT);
                    
                    $sql = "INSERT INTO user (email, username, password, role) VALUES ('$email', '$username', '$password', '$role')";
                    $result = mysqli_query($conn, $sql);
                    
                    if ($result) {
                        $tokens = 0;
                        
                        $sql = "INSERT INTO student (email, tokenCnt) VALUES ('$email', '$tokens')";
                        $result = mysqli_query($conn, $sql);
                        
                        header("Location: login.php");
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            }
        }
    }

?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div>
                        <input class="px-4 py-2 rounded-md border border-solid w-full mb-3" type="text" name="username" placeholder="Enter your username......" required>
                        <input class="px-4 py-2 rounded-md border border-solid w-full mb-3" type="email" name="email" placeholder="Enter your email......" required>
                        <input class="px-4 py-2 rounded-md border border-solid w-full mb-3" type="password" name="password" placeholder="Enter your userpassword......" required>
                    </div>
                    <input type="submit" value="Sign up" class="px-6 py-2 bg-greenSecondary font-bold uppercase rounded-md text-white cursor-pointer transition duration-300 ease-in">
                    <div class="my-2">
                            <span class="text-greenSecondary: 'rgb(34 197 94) hover:text-blue-700 hover:underline"><a href="Login.php">LOG IN</a></span></h1>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html>
