<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
<body style="background-image: url(../ICON/login_singup_bg.jpeg); background-size: cover; background-position: center; background-repeat: no-repeat;">
  <section class="h-screen justify-center items-center flex mx-4 md:mx-[15rem] -z-50">
    <div class="grid grid-cols-1 md:grid-cols-5 z-50 w-full h-[45rem] rounded-xl shadow-2xl">
    <div class="justify-center items-center flex bg-[#ffffff1e] backdrop-blur-[10px] rounded-l-xl md:col-span-3">
      <img src="../ICON/logo.png" alt="">
    </div>
    <div class="bg-yellowPrimary justify-start items-center flex px-4 md:px-10 rounded-r-xl md:col-span-2">
      <div class="flex flex-col w-full md:max-w-md mx-auto">
      <h1 class="text-4xl font-bold mb-6">Admin Login</h1>
      <!-- Display error message if exists -->
      <?php 
      require_once('DBconnect.php');
      if(isset($_POST['email']) && isset($_POST['password'])){
          $e = $_POST['email'];
          $p = $_POST['password'];
          $sql = "SELECT * FROM user WHERE email = '$e'";
          $result = mysqli_query($conn, $sql);
          if(mysqli_num_rows($result) != 0){
              $row = mysqli_fetch_assoc($result);
              $stored_password = $row['password'];
              if($p == $stored_password){
                  $role = $row['role'];
                  $username = $row['username']; 
                  $email = $row['email'];
                  setcookie('username', $username, time() + 3000, "/");
                  setcookie('email', $email, time() + 3000, "/");
                  setcookie('role', $role, time() + 3000, "/");
                  if ($role == 'admin'){
                      header("Location: adminHome.php");
                      exit(); // Stop further execution
                  }
              } else {
                  // Password is incorrect
                  header("Location: admin_login.php?error=incorrect_password");
                  exit(); // Stop further execution
              }
          } else {
              // Account not found
              header("Location: admin_login.php?error=account_not_found");
              exit(); // Stop further execution
          }
      }
      ?>
      <?php if(isset($_GET['error']) && $_GET['error'] == 'incorrect_password'): ?>
          <p style="color: red;">Incorrect password. Please try again.</p>
      <?php elseif(isset($_GET['error']) && $_GET['error'] == 'account_not_found'): ?>
          <p style="color: red;">Account not found.</p>
      <?php endif; ?>
      <form action="admin_login.php" method="post">
        <div>
        <input class="px-4 py-2 rounded-md border border-solid w-full mb-3" type="email" name="email" placeholder="Enter your email......" required>
        <input class="px-4 py-2 rounded-md border border-solid w-full mb-3" type="password" name="password" placeholder="Enter your password......" required>
        </div>
        <input type="submit" value="Login" class="px-6 py-2 bg-greenSecondary font-bold uppercase rounded-md text-white cursor-pointer transition duration-300 ease-in">
        <div class="my-2">
                            <span class="text-greenSecondary: 'rgb(34 197 94) hover:text-blue-700 hover:underline"><a href="Login.php">USER LOG IN</a></span></h1>
        </div>
      </form>
      </div>
    </div>
    </div>
  </section>
</body>
</html>
