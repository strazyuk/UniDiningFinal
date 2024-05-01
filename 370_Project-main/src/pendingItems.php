<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pending</title>
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
                // Redirect to login page if user is not logged in
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
                        <?php
                        // Only display pending items link if the user is logged in
                        if(isset($_COOKIE['username'])) {
                            echo "<div class='flex items-center hover:text-redSecondary'>
                                <i class='fa-solid fa-hourglass-end mr-2'></i>
                                <a href='pendingItems.php' class='text-lg font-semibold uppercase'>Pending Items</a>
                            </div>";
                        }
                        ?>
                    </div>
                </div>
                <div class="col-span-5 bg-white rounded-tl-3xl h-screen pl-12 pt-12">
                    <div>
                        <h1 class="text-4xl font-bold uppercase text-center mb-8">Current pending Items</h1>
                    </div>
                    <div class='overflow-x-auto'>
                        <table class='table'>
                            <thead>
                                <tr>
                                    <th class="uppercase">Food Name</th>
                                    <!-- <th class="uppercase">Product Price</th>-->
                                    <!-- <th class="uppercase">sellername</th> -->
                                    <th class="uppercase">total sold</th>
                                    <th class="uppercase">status</th>
                                     <th class="uppercase">Timing</th>

                                    <th class="uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            require_once('DBconnect.php');
                            $useremail = $_COOKIE['email'];
                            $query = "SELECT * FROM curMenu where status = 'pending'";
                            $result = mysqli_query($conn, $query);
                            $totalCost = 0;
                            if (mysqli_num_rows($result) > 0){
                                while ($row = mysqli_fetch_assoc($result)){
                                    $itemID = $row['f_id'];
                                    $itemName = $row['name'];
                                    $itemToken = $row['token'];
                                    $itemSellCount = $row['sellCount'];
                                    $itemTiming=$row['time'];
                                    $itemStatus = $row['status'];
                                    ?>
                                        <tr>
                                            <td><?php echo $itemName ?></td>
                                            <td><?php echo $itemSellCount ?></td>
                                            <td><?php echo $itemStatus ?></td>

                                            <td><?php echo $itemTiming ?></td>
                                            <td><button style="background-color: #AFE1AF; color: black; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;" onclick="handleStatus('<?php echo $itemID ?>', '<?php echo $itemStatus ?>', 'approve')">Publish</td>
                                        </tr>
                                <?php
                                    }
                            }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="hidden">
                        <form action="handleStatusPending.php" id='statusForm' method="post">
                            <input type="text" name="action">
                            <input type="text" name="itemID">
                            <input type="text" name="itemStatus">
                        </form>
                    </div>
                    <script>
                        function handleStatus(itemID, itemStatus, action){
                            document.getElementById('statusForm').elements['action'].value = action;
                            document.getElementById('statusForm').elements['itemID'].value = itemID;
                            document.getElementById('statusForm').elements['itemStatus'].value = itemStatus;
                            document.getElementById('statusForm').submit();
                        }
                    </script>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
