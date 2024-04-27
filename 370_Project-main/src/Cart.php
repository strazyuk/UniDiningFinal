<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.9.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <!-- Design plugins -->
    <script src="https://kit.fontawesome.com/5f28ebb90a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              yellowPrimary: '#FFBF00',
              redSecondary: '#D2222D',
              greenSecondary: '#008F11',
            }
          }
        }
      }
    </script>
</head>
<body>
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
                <div class='flex items-center ml-5 hover:text-redSecondary'>
                <i class="fa-solid fa-list mr-2"></i>
                  <a href='menu.php' class='text-xl font-semibold uppercase text-black rounded-md px-4 py-2'>Menu</a>
          </div>
        </div>
        <form action="search.php" method="post" class="flex items-center">
          <input type="text" name="search" placeholder="Search for food" class="px-3 py-1 border border-gray-300 rounded-md">
          <button type="submit" class="ml-2 px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">Search</button>
        </form>
        <div>
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
                        // Redirect to login page if user is not logged in
                        header("Location: login.php");
                        exit(); // Stop further execution
                    }
                ?>
            </div>
        </nav>
    </header>
    <main>
        <section class="px-[15rem]">
            <h1 class="text-center text-7xl font-extrabold my-10">
                Confirm Your Order
            </h1>
            <div class='overflow-x-auto'>
                <table class='table'>
                    <thead>
                        <tr>
                            <th>Food Name</th>
                            <th>Food Token</th>
                            <th>Quantity</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            require_once('DBconnect.php');
                            $useremail = $_COOKIE['email'];
                            $query = "SELECT * FROM cart WHERE email = '$useremail'";
                            $result = mysqli_query($conn, $query);
                            $totalCost = 0;
                            if (mysqli_num_rows($result) > 0){
                                while ($row = mysqli_fetch_assoc($result)){
                                    $itemID = $row['f_id']; 
                                    $query_product = "SELECT * FROM curMenu WHERE f_id = '$itemID'";
                                    $result_product = mysqli_query($conn, $query_product);
                                    $row_product = mysqli_fetch_assoc($result_product);

                                    $productname = $row_product['name']; 
                                    $tokenCost = $row_product['token']; 
                                    $productquantity = 1; 

                                    $totalCost += $tokenCost;

                                    ?>
                                    <tr>
                                        <td><?php echo $productname; ?></td>
                                        <td><?php echo $tokenCost; ?>$</td>
                                        <td class="uppercase"><?php echo $productquantity; ?></td>
                                        <td onclick="handleForm('<?php echo $useremail; ?>','<?php echo $itemID; ?>')"><i class='fa-solid fa-trash hover:text-red-500 cursor-pointer'></i></td>
                                    </tr>
                                    <?php
                                }
                            }?>
                    </tbody>
                </table>
            </div>
            <div class="my-20">
                <h1 class="text-2xl font-semibold uppercase">Total Token: <?php echo $totalCost; ?></h1>    
                <?php
                    require_once('DBconnect.php');
                    $useremail = $_COOKIE['email'];
                    $query = "SELECT tokenCnt FROM student WHERE email = '$useremail'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    $tokenLeft = $row['tokenCnt'];
                ?>
                <br>
                <h1 class="text-2xl font-semibold uppercase">Token Left:<?php echo $tokenLeft; ?></h1>
            </div>
            <div>
                <form action="payment.php" method="post">
                    <input type="hidden" name="total_cost" value="<?php echo $totalCost; ?>">
                    <button type="submit" class="text-xl font-semibold uppercase bg-red-500 text-white rounded-md px-4 py-2 hover:bg-red-600 transition-colors duration-300">Confirm Payment</button>
                </form>
            </div>
        </section>
    </main>
    <div class="hidden">
            <form action="handleRemoveCart.php" method="post" id="addForm">
                <input type="text" name="useremail">
                <input type="text" name="itemID">
                <input type ="number" name ="totalCost">
            </form>
        </div>
    <script>
        function handleForm(useremail, itemID ,totalCost) {
            document.getElementById('addForm').elements['itemID'].value = itemID;
            document.getElementById('addForm').elements['useremail'].value = useremail;
            document.getElementById('addForm').elements['totalCost'].value = totalCost;

            document.getElementById('addForm').submit();
        }
    </script>
</body>
</html>
