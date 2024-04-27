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
        <div class="flex items-center">
          <?php
            // Check if username cookie is set
            if(isset($_COOKIE['username'])) {
                $username = $_COOKIE['username'];
            } else {
                // Redirect to login page if user is not logged in
                header("Location: admin_login.php");
                exit(); // Stop further execution
            }
          ?>
          <h1 class="text-2xl font-semibold uppercase">Welcome to admin dashboard, <?php echo $username ?></h1>
          <div class="ml-4">
            <a href="Login.php?action=logout" class="text-xl font-semibold uppercase bg-red-500 text-white rounded-md px-4 py-2 hover:bg-red-600">Logout</a>
          </div>
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
                <a href='admin_create_account.php' class="text-lg font-semibold uppercase">Create Account</a>
              </div>
              <div class="flex items-center hover:text-redSecondary">
                <i class="fa-solid fa-plus mr-2"></i>
                <a href='admin_create_account.php' class="text-lg font-semibold uppercase">Users</a>
              </div>
              <div class="flex items-center hover:text-redSecondary">
                <i class="fa-solid fa-plus mr-2"></i>
                <a href='admin_feedback.php' class="text-lg font-semibold uppercase">Feedback</a>
              </div>
              
            </div>
          </div>
          <?php
            require_once('DBconnect.php');
            $query = "SELECT COUNT(*) AS student_count FROM user WHERE role = 'student'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $student_count = $row['student_count'];
            
            $query = "SELECT SUM(revenue) AS total_salary FROM admin";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $total_salary = $row['total_salary'];
            $query="SELECT SUM(sellCount) as total_sales from curMenu";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            $total_sales= $row['total_sales']
          ?>
          <div class="col-span-5 bg-white rounded-tl-3xl h-screen pl-12 pt-12">
            <div class="font-bold">
              <h1 class="text-1xl">Total revenue <?php echo $total_salary ?></h1>
              <h1 class="text-1xl">Total sales made <?php echo $total_sales ?></h1>
              <h1 class="text-1xl">Total students: <?php echo $student_count ?></h1>
            </div>
            </div>
          </div>
        </div>
      </section>
    </main>
</body>
</html>
