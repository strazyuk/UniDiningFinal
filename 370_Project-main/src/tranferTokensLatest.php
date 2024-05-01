<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MENU</title>
    <!-- Design plugs -->
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
        };
    </script>
</head>
<body class="bg-yellowPrimary">
    <header>
        <nav class="h-24 px-60 flex justify-between items-center">
            <div class="flex items-center">
                <img class="h-16 w-16" src="../ICON/logo.png" alt="">
                <h1 class="text-3xl font-bold ml-3">UNIDining</h1>
            </div>  
            <div class="flex items-center">
                <div class="flex items-center hover:text-redSecondary">
                    <i class="fa-solid fa-house fa-rotate-by mr-2"></i>
                    <a href="studentHome.php" class="text-xl font-semibold uppercase">Home</a>
                </div>
                <div class="flex items-center ml-5 hover:text-redSecondary">
                    <i class="fa-solid fa-shopping-cart mr-2"></i>
                    <a href="Cart.php" class="text-xl font-semibold uppercase text-black rounded-md px-4 py-2">Cart</a>
                </div>
            </div>
            <form action="search.php" method="post" class="flex items-center">
                <input type="text" name="search" placeholder="Search for food" class="px-3 py-1 border border-gray-300 rounded-md">
                <button type="submit" class="ml-2 px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">Search</button>
            </form>
            <div>
                <?php
                if(isset($_COOKIE['username'])) {
                    $username = $_COOKIE['username'];
                    echo 
                    "<div class='flex items-center'>
                      <i class='fa-solid fa-user mr-2 text-2xl'></i>
                      <h1 class='text-xl font-semibold uppercase'>$username</h1>
                    </div>";
                } else {
                    echo "No username cookie set";
                    header("Location: login.php");
                    exit(); 
                }
                ?>
            </div>
        </nav>
    </header>
    <main>
        
                <?php
                require_once('DBconnect.php');
                
                $queryStudent = "SELECT email, username FROM user WHERE role = 'student'";
                $resultUser = mysqli_query($conn, $queryStudent);
                ?>
                <div class="col-span-5 bg-white rounded-tl-3xl h-screen pl-12 pt-12 overflow-auto">
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <h2 class="text-2xl font-semibold mb-4">Select user you want to send to</h2>
                            <?php if (mysqli_num_rows($resultUser) > 0) { ?>
                                <table class="w-full">
                                    <tr>
                                        <th class="py-2 px-4 border-b border-gray-300">Email</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Name</th>
                                        <th class="py-2 px-4 border-b border-gray-300">Amount</th>
                                    </tr>
                                    <?php while ($row = mysqli_fetch_assoc($resultUser)) { ?>
                                        <tr>
                                            <form action="handletokenTransfer.php" method="post">
                                                <td class="py-2 px-4 border-b border-gray-300"><?php echo $row['email']; ?></td>
                                                <td class="py-2 px-4 border-b border-gray-300"><?php echo $row['username']; ?></td>
                                                <td class="py-2 px-4 border-b border-gray-300">
                                                    <input type="number" min="0" name="tokenCount" class="w-1/2 h-8 border border-gray-300 rounded px-2 my-2" required>
                                                    <input type="hidden" name="userEmail" value="<?php echo $row['email']; ?>">
                                                </td>
                                                <td class="py-2 px-4 border-b border-gray-300">
                                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                                        Transfer
                                                    </button>
                                                </td>
                                            </form>
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
