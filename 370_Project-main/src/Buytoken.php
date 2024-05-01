<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Tokens</title>
    <!-- Design plugins -->
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
<body>
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
            <i class="fa-solid fa-list mr-2"></i>
            <a href="menu.php" class="text-xl font-semibold uppercase">Menu</a>
        </div>
        <div class="flex items-center ml-5 hover:text-redSecondary">
            <i class="fa-solid fa-list-check mr-2"></i>
            <a href="student_feedback.php" class="text-xl font-semibold uppercase">FeedBack</a>
        </div>
    </div>
    <div class="flex items-center space-x-5">
        <?php
        if (isset($_COOKIE['username'])) {
            $username = $_COOKIE['username'];
            echo "<div class='flex items-center'>
                <i class='fa-solid fa-user mr-2 text-2xl'></i>
                <h1 class='text-xl font-semibold uppercase'>$username</h1>
            </div>";
        } else {
            header("location: login.php");
        }
        ?>
        <div class="flex items-center ml-2">
            <div class="flex items-center ml-2 hover:text-redSecondary">
                <a href="login.php" class="text-xl font-semibold uppercase bg-red-500 text-white rounded-md px-4 py-2 hover:bg-red-600 transition-colors duration-300">Logout</a>
            </div>
        </div>
    </div>
</nav>
<main>  
    <section class="pl-40 pt-4 h-screen">
        <section class="px-[15rem]">
            <h1 class="text-center text-5xl font-extrabold my-10">
                Buy Tokens
            </h1>
            <div class="my-24">
                <form action="handleBuyTokens.php" method="POST">
                    <?php 
                    if(isset($_COOKIE['email'])) {
                        $email = $_COOKIE['email'];
                    } else {
                        echo header("Location: login.php");
                    }
                    ?>
                    <div class="flex flex-row items-center mr-6">
                        <h1 class="text-2xl font-semibold mr-4 w-72">Your email:</h1>
                        <input type="text" name="buyerEmail" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" value="<?php echo $email; ?>" readonly>
                    </div>
                    <div class="flex flex-row items-center mr-6">
                        <h1 class="text-2xl font-semibold mr-4 w-72">Buy Token</h1>
                        <select class="select w-full my-4 border-2 border-gray-300 px-4 font-semibold text-xl py-2" name="tokenPackage" required>
                            <option disabled selected>Select Token amount from the option</option>
                            <option value="10">10 tokens - 500tk</option>
                            <option value="20">20 tokens - 900tk</option>
                            <option value="30">30 tokens - 1600tk</option>
                            <option value="40">40 tokens - 2500tk</option>
                            <option value="50">50 tokens - 3500tk</option>
                        </select>
                    </div>
                    <div class="flex flex-row items-center mr-6">
                        <h1 class="text-2xl font-semibold mr-4 w-72">Credit Card Info:</h1>
                        <input type="text" name="creditCardInfo" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" required>
                    </div>
                    <div class="flex flex-row items-center mr-6">
                        <h1 class="text-2xl font-semibold mr-4 w-72">Enter pin:</h1>
                        <input type="password" name="creditCardPin" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" required>
                    </div>
                    <button type="button" class="bg-yellow-300 py-3 w-half rounded-lg my-4 text-white" onclick="window.location.href='tranferTokensLatest.php';">
                        Transfer Tokens
                  </button>
                    <input type="submit" value="Confirm Purchase" class="bg-yellow-300 py-3 w-full rounded-lg my-4 text-white">

                   
                </form>
            </div>
        </section>
    </section>
</main>
</body>
</html>
