<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- design plugs -->
    <script src="https://kit.fontawesome.com/5f28ebb90a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet" type="text/css" />
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
<body class="bg-yellowPrimary">
    <header>
      <nav class="h-24 px-40 flex justify-between items-center">
        <div class="flex items-center">
          <img class="h-16 w-16" src="../ICON/logo.png" alt="">
          <h1 class="text-3xl font-bold ml-3">UNIDining</h1>
        </div> 
        <?php
            if(isset($_COOKIE['username'])) {
                $username = $_COOKIE['username'];
            } else {
                header("Location: admin_login.php");
                exit(); // Stop further execution
            }
        ?> 
        <div>
          <h1 class="text-2xl font-semibold uppercase">Welcome to admin dashboard, <?php echo $username ?></h1>
        </div>
      </nav>
    </header>
    <main>
      <section class="pl-40 pt-4 h-screen">
        <div class="grid grid-cols-6">
          <div class="mt-16">
            <div class="flex flex-col items-start">
              <div class="flex items-center hover:text-redSecondary mb-6">
                <i class="fa-solid fa-chart-column mr-2 text-lg"></i>
                <a href="adminHome.php" class="text-lg font-semibold uppercase">statistics</a>
              </div>
              <div class="flex items-center hover:text-redSecondary mb-6">
                <i class="fa-regular fa-clipboard mr-2 text-lg"></i>
                <a href="publishedItems.php" class="text-lg font-semibold uppercase">Published Items</a>
              </div>
              <div class="flex items-center hover:text-redSecondary">
                <i class="fa-solid fa-plus mr-2"></i>
                <a href='addfoods.php' class="text-lg font-semibold uppercase">Add </a>
              </div>
              <div class="flex items-center hover:text-redSecondary">
                <i class="fa-solid fa-plus mr-2"></i>
                <a href='admins.php' class="text-lg font-semibold uppercase">Users</a>
              </div>
              <div class="flex items-center hover:text-redSecondary">
                <i class="fa-solid fa-plus mr-2"></i>
                <a href='admin_feedback.php' class="text-lg font-semibold uppercase">Feedback</a>
              </div>
            </div>
          </div>
          <div class="col-span-5 bg-white rounded-tl-3xl h-screen pl-12 pt-12">
            <div>
              <section class="px-[15rem]">
                <h1 class="text-center text-5xl font-extrabold my-10">
                  Fill up the form to create an admin account
                </h1>
                <div class="my-24">
                  <?php
                    require_once('DBconnect.php');

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        // Check if the email already exists
                        $check_email_query = "SELECT * FROM user WHERE email='$email'";
                        $check_email_result = mysqli_query($conn, $check_email_query);
                        if (mysqli_num_rows($check_email_result) > 0) {
                            echo "<span style='color: red;'>An account with this email already exists.</span>";
                        } else {
                            // Check if the password already exists
                            $check_password_query = "SELECT * FROM user WHERE password='$password'";
                            $check_password_result = mysqli_query($conn, $check_password_query);
                            if (mysqli_num_rows($check_password_result) > 0) {
                                echo "<span style='color: red;'>A user with this password already exists. Please try another password.</span>";
                            } else {
                                // Insert new user if account doesn't exist
                                $role = 'admin';
                                $sql = "INSERT INTO user (email, username, password, role) VALUES ('$email', '$name', '$password', '$role')";
                                $result = mysqli_query($conn, $sql);
                                if ($result) {
                                    // Insert admin data into the Admin table
                                    $queryAdmin = "INSERT INTO `Admin` (`email`, `password`, `revenue`, `wrkHrs`) VALUES ('$email', '$password', NULL, NULL)";
                                    $resultAdmin = mysqli_query($conn, $queryAdmin);
                                    if ($resultAdmin) {
                                        echo "Admin account created successfully!";
                                    } else {
                                        echo "Error: " . mysqli_error($conn);
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($conn);
                                }
                            }
                        }
                    }
                  ?>
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <div>
                        <label for="name" class="text-2xl font-semibold">Your Name:</label>
                        <input type="text" name="name" id="name" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" required>
                      </div>
                      <div>
                        <label for="email" class="text-2xl font-semibold">Your Email:</label>
                        <input type="email" name="email" id="email" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" required>
                      </div>
                      <div>
                        <label for="password" class="text-2xl font-semibold">Password:</label>
                        <input type="password" name="password" id="password" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" required>
                      </div>
                    </div>
                    <button type="submit" class="bg-yellowPrimary text-white font-semibold px-8 py-4 rounded-lg mt-6">Create Admin Account</button>
                  </form>
                </div>
              </section>
            </div>
          </div>
        </div>
      </section>
    </main>
</body>
</html>
