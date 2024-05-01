<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- design plugs -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              yellowPrimary: 'rgb(253 224 71)',
              redSecondary: 'rgb(220 38 38)',
              greenSecondary: 'rgb(34 197 94)',
            }
          }
        }
      }
    </script>
</head>
<?php 
setcookie('username', '', time() + 3000, "/");
setcookie('email', '', time() + 3000, "/");
setcookie('role', '', time() + 3000, "/");
?>
<body style="background-image: url(../ICON/login_singup_bg.jpeg); background-size: cover; background-position: center; background-repeat: no-repeat;">
  <section class="h-screen justify-center items-center flex mx-4 md:mx-[15rem] -z-50">
    <div class="grid grid-cols-1 md:grid-cols-5 z-50 w-full h-[45rem] rounded-xl shadow-2xl">
    <div class="justify-center items-center flex bg-[#ffffff1e] backdrop-blur-[10px] rounded-l-xl md:col-span-3">
      <img src="../ICON/logo.png" alt="">
    </div>
    <div class="bg-yellowPrimary justify-start items-center flex px-4 md:px-10 rounded-r-xl md:col-span-2">
      <div class="flex-col mx-auto">
      <h1 class="text-4xl font-bold mb-6">Login</h1>
      <!-- Display error message if exists -->
      <?php if(isset($_GET['error']) && $_GET['error'] == 'invalid'): ?>
        <p style="color: red;">Incorrect email or password. Please try again.</p>
      <?php endif; ?>
      <form action="login.php" method="post">
        <div>
        <input class="px-4 py-2 rounded-md border border-solid w-full mb-3" type="email" name="email" placeholder="Enter your email......" required>
        <input class="px-4 py-2 rounded-md border border-solid w-full mb-3" type="password" name="password" placeholder="Enter your password......" required>
        </div>
        <input type="submit" value="Login" class="px-6 py-2 bg-greenSecondary font-bold uppercase rounded-md text-white cursor-pointer transition duration-300 ease-in">
      </form>
      <div class="my-2">
        <h1>Don't have an account? <span class="text-redSecondary hover:text-blue-700 hover:underline"><a href="signup.php">Sign up now!</a></span></h1>
      </div>
      <div class="flex items-center  hover:text-redSecondary">
            <a href="admin_login.php" class="text-l font-semibold uppercase">Admin login</a>
          </div>
      </div>
    </div>
    </div>
  </section>
</body>
</html>

<?php
require_once('DBconnect.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
    $e = $_POST['email'];
    $p = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = '$e'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $hashed_password = $row['password'];

        
        if (password_verify($p, $hashed_password)) {
            $role = $row['role'];
            $username = $row['username'];
            $email = $row['email'];

            setcookie('username', $username, time() + 3000, "/");
            setcookie('email', $email, time() + 3000, "/");
            setcookie('role', $role, time() + 3000, "/");

            // Redirect the user based on their role
            if ($role == 'student') {
                header("Location: studentHome.php");
                exit();
            } else {
            }
        } else {
            
            header("Location: login.php ");
            exit();
        }
    } else {
       
        header("Location: login.php?error=invalid");
        exit();
    }
}
?>
