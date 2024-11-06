<?php
    include_once "includes/config.php";

    if(!isset($_SESSION['user'])){
        redirect_to("login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Book Chor</title>
    <link rel="stylesheet" href="output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body>
    <?php include_once "includes/header.php"; ?>
    <?php include_once "includes/sidebar.php"; ?>

    <div class="flex flex-1 px-5 py-2 w-full gap-4 items-start">
        <div class="w-9/12 flex flex-col gap-2 ">
        <h1 class="text-2xl font-[700] text-green-800">Shopping Cart</h1>
            <?php
            $user_id = getUserInfo()['user_id'];
            $callingCart = "select * from orders left join coupons on orders.coupon_id = coupons.coupon_id where ordered=false and user_id='$user_id'";
            $runCallingCart = mysqli_query($connect, $callingCart);
            $countCart = mysqli_num_rows($runCallingCart);
            $cart = mysqli_fetch_array($runCallingCart);

            if($countCart == 0){
                echo "<h1>Your cart is empty..</h1>";
            }
            else{
                $order_id = $cart['order_id'];
                $callingOrderItems = mysqli_query($connect, "select * from order_items join books on order_items.book_id = books.id where order_id = '$order_id' and ordered = false and user_id = '$user_id'");

                // calculation variable
                $total_mrp_amount = 0;
                $total_amount = 0;
                $total_discount = 0;
                $total_tax = 0;
                $total_payment_amount = 0;
                $total_coupon_amount = 0;

                while($item = mysqli_fetch_array($callingOrderItems)):

            ?>
            <div class="flex bg-[#D8FEF1] p-4 gap-2 rounded-lg ">
                <!-- for image -->
                <div class="w-3/12 flex items-center justify-center">
                    <img src="<?="images/products/" . $item['cover_image']; ?>" alt="" class="h-[180px]">
                </div>
                <!-- for title and quantity and add or remove -->
                <div class="w-9/12 flex flex-col justify-between">
                    <!-- heading and price -->
                    <div class="flex w-full justify-between">
                        <div class="flex">
                            <h2 class="text-2xl font-[500] text-gray-700"><?=$item['title'];?></h2>
                        </div>
                        <div class="flex px-8 flex-col gap-2">
                            <!-- price and mrp -->
                            <h2 class="text-[20px] font-semibold text-orange-600 truncate"><span class="text-sm">₹</span><?=$item['price'];?> x <?=$item['qty'];?> = <span><span class="text-sm">₹</span><?= $item['price'] * $item['qty'];?></span></h2>
                            <h3 class="text-sm font-semibold text-gray-500"><span class="text-sm">MRP: ₹</span><del><?=$item['mrp'];?></del></h3>
                        </div>
                    </div>
                    <!-- qty and remove -->
                    <div class="flex justify-between w-full items-center">
                    <div class="flex gap-1 p-2 mt-5">
                        <div class="flex gap-1">
                        <a href="?minus=<?= $item['id'];?>" class="flex items-center justify-center h-[30px] w-[30px] rounded-full border-2 border-white bg-teal-400 hover:bg-orange-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                        </a>
                        <span class=" px-6 py-[2px] border-[2px] border-white text-black bg-teal-200 text-center rounded-lg"><?=$item['qty'];?></span>
                        <a href="?add=<?= $item['id'];?>" class="flex items-center justify-center h-[30px] w-[30px] rounded-full bg-teal-400 hover:bg-orange-500  border-white border-2 ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"        class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>

                        </a>
                        </div>
                    </div>
                    <!-- remove and save -->
                    <div class="flex items-end justify-end gap-5 px-4 mt-6">
                        <a href="">Save for Later</a>
                        <a href="">Remove</a>
                    </div>
                    </div>
                </div>
            </div>
            <?php
                // calculate logic
                $total_mrp_amount += $item['mrp'] * $item['qty'];
                $total_amount += $item['price'] * $item['qty'];
                $total_discount = $total_mrp_amount - $total_amount;
                $total_tax = $total_amount * 0.18;
                $total_payment_amount = $total_amount + $total_tax;

                if($cart['coupon_id'] != NULL){
                    $total_payment_amount -= $cart['coupon_amount'];
                }

                endwhile; } 
            ?>
        </div>
        <!-- price details -->
        <?php 
        if($countCart != 0): ?>
        <div class="w-3/12 flex flex-col  bg-[#D8FEF1] rounded-lg shadow mt-10  py-2 ">
            <h1 class="text-xl font-[600] font-serif text-gray-700 border-b-2 border-gray-500 ml-3 mr-3">PRICE DETAILS</h1>
            <table class="w-full mt-2">
                <tr>
                    <th class=" py-3 px-6 text-start text-gray-600">Total Amount :</th>
                    <td class=" py-3 px-6 text-start font-semibold">₹<?= $total_mrp_amount;?>/-</td>
                </tr>
                <tr>
                    <th class=" py-3 px-4 text-start text-gray-600 truncate">Discount Amount :</th>
                    <td class=" py-3 px-6 text-start font-semibold">₹<?= $total_discount;?></td>
                </tr>
                <tr>
                    <th class=" py-3 px-6 text-start text-gray-600">Total GST(18%) :</th>
                    <td class=" py-3 px-6 text-start font-semibold">₹<?= $total_tax;?></td>
                </tr>
                <?php
                if($cart['coupon_id']):?>
                <tr class="">
                    <th class=" py-3 px-6 text-start text-gray-600 flex flex-col items-center">
                        <span class="truncate">Coupon Discount:</span>
                        <span class="text-[12px] text-orange-700 flex">COUPON: <?=$cart['coupon_code'];?>
                        <a href="" class="text-teal-600"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"     class="size-4 ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </a>
                        </span>
                    </th>
                    <td class=" py-3 px-6 text-start font-semibold">₹<?= $cart['coupon_amount'];?></td>
                </tr>
                <?php endif;?>                
                <tr class="bg-teal-400 text-white shadow-md">
                    <th class=" py-3 px-6 text-start text-gray-700">Total Payable :</th>
                    <td class=" py-3 px-6 text-start font-semibold text-[20px] text-black">₹<?= $total_payment_amount;?></td>
                </tr>
            </table>
            <!-- COUPON -->
            <?php
            if($cart['coupon_id'] == null):?>
            <div class="mt-2">
                <h2 class=" font-semibold text-gray-500 ml-4">Apply Coupons</h2>
                <div class="px-3 py-1">
                    <form action="cart.php" method="post">
                        <div class="flex gap-2 justify-center">
                            <input type="text" name="coupon_code" class="flex-1 border px-3 py-2 rounded" placeholder="Enter Coupon Code">
                            <button type="submit" name="apply_coupon" class="bg-teal-500 text-white px-3 py-2 rounded font-semibold">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php endif; ?>

            <a href="checkout.php" class="flex w-full mt-4 justify-center ml-2 mb-2">
                <div class="flex py-3 px-4 rounded-md bg-orange-600 hover:bg-orange-500 text-white font-semibold mr-4 w-full items-center justify-center">CheckOut</div>
            </a>
            
        </div>
        <?php endif; ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
<?php
    if(isset($_GET['add'])){
        $book_id = $_GET['add'];

        addToCart($book_id);
        redirect_to("cart.php");
    }

    // remove qty function
    if(isset($_GET['minus'])){
        $book_id = $_GET['minus'];
        removeFromCartqty($book_id);
        redirect_to("cart.php");
    }

    // coupon apply
    if(isset($_POST['apply_coupon'])){
        $code = $_POST['coupon_code'];

        // check coupon code
        $checkCode = mysqli_query($connect, "select * from coupons where coupon_code='$code' and coupon_status=1");
        $couponData = mysqli_fetch_array($checkCode);
        $couponCount = mysqli_num_rows($checkCode);

        if($couponCount){
            // order table update
            $coupon_id = $couponData['coupon_id'];
            $updateOrder = mysqli_query($connect, "update orders set coupon_id='$coupon_id' where user_id='$user_id' and order_id='$order_id' and ordered=false");
            redirect_to("cart.php");
        }else{
            message("invalid coupon code");
        }
    }
?>