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
                <a href='admins.php' class="text-lg font-semibold uppercase">Users</a>
              </div>
            </div>
          </div>
          <?php
            // Fetch student feedback and ratings
            $query = "SELECT * FROM feedback";
            $result = mysqli_query($conn, $query);

            // Display student feedback and ratings in a table
          ?>
          <div class="col-span-5 bg-white rounded-tl-3xl h-screen pl-12 pt-12">
            <h2 class='text-2xl font-semibold mb-4'>Student Feedback and Ratings:</h2>
            <table class='w-full'>
              <thead>
                <tr>
                <th class='py-2 px-4 bg-gray-200 border-b-2 border-gray-300'>FeedbackNo.</th>

                  <th class='py-2 px-4 bg-gray-200 border-b-2 border-gray-300'>Email</th>
                  <th class='py-2 px-4 bg-gray-200 border-b-2 border-gray-300'>Feedback</th>
                  <th class='py-2 px-4 bg-gray-200 border-b-2 border-gray-300'>Meal Rating</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                  <tr>
                  <td class='py-2 px-4 border-b border-gray-300'><?php echo $row['feedback_id']; ?></td>

                    <td class='py-2 px-4 border-b border-gray-300'><?php echo $row['email']; ?></td>
                    <td class='py-2 px-4 border-b border-gray-300'><?php echo $row['text']; ?></td>
                    <td class='py-2 px-4 border-b border-gray-300'><?php echo $row['mealRating']; ?> </td>
                    <td class='py-2 px-4 border-b border-gray-300'> <form method="POST" action="handleDeleteFeedback.php">
                                                  <!-- Hidden input for email -->
                                                  <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                                                  <input type="hidden" name="feedID" value="<?php echo $row['feedback_id']; ?>">

                                                  <!-- Delete button -->
                                                  <button type="submit" class="btn btn-error">Delete</button>
                                              </form> </td>
                  
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <?php mysqli_close($conn); ?>
        </div>
      </section>
    </main>
</body>
</html>
