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
                <a href='admin_create_account.php' class="text-lg font-semibold uppercase">Create Account</a>
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
          <section class="px-[15rem]">
            <h1 class="text-center text-5xl font-extrabold my-10">
              <!--change the text -->
                Fill up the form before you add an Item
            </h1>
            <div class="my-24">
              <form action="handleAddFoods.php" method="POST">
                <?php 
                      $email = $_COOKIE['email']
                ?>
                <div class="grid grid-cols-2">
                  <div class="flex items-center mr-6">
                      <h1 class="text-2xl font-semibold mr-4 w-72">Your email:</h1>
                      <input type="text" name="adminEmail" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" value="<?php echo $email; ?>" readonly>
                  </div>
                  <div>
                    <select class="select w-full my-4 border-2 border-gray-300 px-4 font-semibold text-xl py-2" name="itemType" required>
                    
                      <option disabled selected>Select Meal Category</option>
                      <option>Main dish</option>
                      <option>Side dish</option>
                      
                      <option>Beverages & Snacks</option>
                      <option>Condiments</option>
                    </select>
                  </div>
                </div>
                <div>
                    <select class="select w-full my-4 border-2 border-gray-300 px-4 font-semibold text-xl py-2" name="itemTiming" required>

                      <option disabled selected>Select Meal timing</option>
                      <option>Breakfast</option>
                      <option>Lunch</option>
                     <option>Dinner</option>
                      <option>Snacks</option>
                    </select>
                  </div>
                </div>
                <div class="grid grid-cols-2">
                  <div class="flex flex-row items-center mr-6 flex-1">
                                                                  <!--changed-->
                      <h1 class="text-2xl font-semibold mr-4 w-72">Item Name:</h1>
                      <input type="text" name="itemName" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" required>
                  </div>
                  <div class="flex flex-row items-center flex-1">
                    <h1 class="text-2xl font-semibold mr-4 w-72">Required Token:</h1>
                    <input type="number" min="0" name="tokenCount" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" required>
                  </div>
                </div>
                <div class="flex flex-row items-center">
                    <h1 class="text-2xl font-semibold w-80">Product Image URl:</h1>
                    <input type="text" name="itemImage" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" required>
                </div>
                <input type="submit" value="submit" class="bg-yellowPrimary py-3 w-full rounded-lg my-4">
              </form>
            </div>
          </section>
        </div>
      </section>
    </main>
</body>
</html>