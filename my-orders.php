<?php
    include_once "includes/config.php";

    if(!isset($_SESSION['user'])){
        redirect_to("login.php");
    }

    // order query
    $user_id = getUserInfo()['user_id'];
    $orderQuery = mysqli_query($connect, "select * from orders where ordered = true and user_id = '$user_id' order by orders.order_id desc");
    $count = mysqli_num_rows($orderQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders | Book Chor</title>
    <link rel="stylesheet" href="output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body>
    <?php include_once "includes/header.php"; ?>
    <?php include_once "includes/sidebar.php"; ?>
    <?php include_once "includes/subheader.php"; ?>

    <div class="flex flex-col flex-1 px-[10%]">
        <h2 class="my-5 text-3xl font-semibold">My Orders (<?=$count;?>)</h2>

        <!-- loops for orders -->
        <?php
                while($order = mysqli_fetch_array($orderQuery)):
        ?>
        <div class="flex flex-1 mb-3">
            <div class="border flex flex-1 flex-col">
                <div class="bg-slate-200 flex justify-between p-3">
                    <!-- card header -->
                    <h2>Order Id: <?=$order['order_id'];?></h2>
                    <h2>Date of order: <?=Date("D d-m-y h:i:s A", strtotime($order['dateoforder']));?></h2>
                </div>
                <?php
                $order_id = $order['order_id'];
                $orderItemQuery = mysqli_query($connect, "select * from order_items JOIN books on books.id = order_items.book_id where order_id = '$order_id' and user_id = '$user_id'");
                while($orderItem = mysqli_fetch_array($orderItemQuery)):
                ?>
                <div class="flex p-4 flex-1 gap-5">
                    <div class="w-1/12">
                        <img src="<?="images/products/" . $orderItem['cover_image']; ?>" alt="">
                    </div>
                    <div class="w-11/12">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-semibold"><?=$orderItem['title'];?></h3>
                            <p class="text-gray-500">Author: <?=$orderItem['author'];?></p>
                            <p class="text-gray-500">₹<?=$orderItem['price'];?></p>
                            <p class="text-gray-500">Qty: <?=$orderItem['qty'];?></p>
                            <p class="text-gray-500">₹<?=$orderItem['qty'] * $orderItem['price'];?> </p>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>    
        </div>
        <?php endwhile; ?>
    </div>
</body>
</html>