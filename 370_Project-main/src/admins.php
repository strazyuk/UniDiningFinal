<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admins</title>
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
        <?php require_once('DBconnect.php'); ?>
        <?php
            if(isset($_COOKIE['username'])) {
                $username = $_COOKIE['username'];
            } else {
                echo "No username cookie set";
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
                <a href='admin_create_account.php' class="text-lg font-semibold uppercase">Create Account</a>
              </div>
              <div class="flex items-center hover:text-redSecondary">
                <i class="fa-solid fa-plus mr-2"></i>
                <a href='admin_feedback.php' class="text-lg font-semibold uppercase">Feedback</a>
              </div>
            </div>
          </div>
          <?php
            // Retrieve admins data from the database
            $queryAdmin = "SELECT email, username FROM user WHERE role = 'admin'";
            $resultAdmin = mysqli_query($conn, $queryAdmin);

            // Retrieve non-admin users data from the database
            $queryStudent = "SELECT email, username FROM user WHERE role  = 'student'";
            $resultUser = mysqli_query($conn, $queryStudent);
          ?>
          <div class="col-span-5 bg-white rounded-tl-3xl h-screen pl-12 pt-12 overflow-auto">
                  <div class="grid grid-cols-2 gap-8">
                      <div>
                          <h2 class='text-2xl font-semibold mb-4'>Admins</h2>
                          <?php if (mysqli_num_rows($resultAdmin) > 0) { ?>
                              <table>
                                  <tr><th>Email</th><th>Name</th><th>Action</th></tr>
                                  <?php while ($row = mysqli_fetch_assoc($resultAdmin)) { ?>
                                      <tr>
                                          <td class="py-2 px-4 border-b border-gray-300"><?php echo $row['email']; ?></td>
                                          <td class="py-2 px-4 border-b border-gray-300"><?php echo $row['username']; ?></td>
                                          <td class="py-2 px-4 border-b border-gray-300">
                                              <!-- Form to handle deletion -->
                                           
                                          </td>
                                      </tr>
                                  <?php } ?>
                              </table>
                          <?php } else { ?>
                              <p>No admins found.</p>
                          <?php } ?>
                      </div>
                      <div>
                          <h2 class='text-2xl font-semibold mb-4 px-4'>Users</h2>
                          <?php if (mysqli_num_rows($resultUser) > 0) { ?>
                              <table>
                                  <tr><th>Email</th><th>Name</th><th>Action</th></tr>
                                  <?php while ($row = mysqli_fetch_assoc($resultUser)) { ?>
                                      <tr>
                                          <td class="py-2 px-4 border-b border-gray-300"><?php echo $row['email']; ?></td>
                                          <td class="py-2 px-4 border-b border-gray-300"><?php echo $row['username']; ?></td>
                                          <td class="py-2 px-4 border-b border-gray-300">
                                          
                                              <!-- Form to handle deletion -->
                                              <form method="POST" action="deleteUser.php">
                                                  <!-- Hidden input for email -->
                                                  <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                                                  <!-- Delete button -->
                                                  <button type="submit" class="btn btn-error">Delete</button>
                                              </form>
                                          </td>
                                      </tr>
                                  <?php } ?>
                              </table>
                          <?php } else { ?>
                              <p>No users found.</p>
                          <?php } ?>
                      </div>
                  </div>
              </div>

          <?php mysqli_close($conn); ?>
        </div>
      </section>
    </main>
</body>
</html>
