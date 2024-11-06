<?php
    include_once "includes/config.php";

    if(!isset($_GET['bid'])){
        redirect_to("index.php");
    }

    $bid = $_GET['bid'];
    $query = mysqli_query($connect, "select * from books JOIN categories ON books.category_id = categories.cat_id where id='$bid'");

    if(mysqli_num_rows($query)==0){
        redirect_to("index.php");

    }

    $singleBook = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Chor</title>
    <link rel="stylesheet" href="output.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body>
    <?php include_once "includes/header.php";?>
    <?php include_once "includes/subheader.php";?>
    <?php include_once "includes/sidebar.php";?>

    <!-- book calling work -->
    <div class="flex flex-1 px-[5%] flex-col">
        <div class="flex flex-1 mt-5 mb-5 gap-10">
            <div class="w-3/12 ">
                <img src="./images/products/<?= $singleBook['cover_image'];?>" class="w-full" alt="" class="shadow-lg">
            </div>
            <!-- middle area section -->
            <div class="w-6/12 ">
                <div class="flex flex-col gap-1">
                    <h2 class="text-3xl  font-semibold tracking-wider"><?= $singleBook['title'];?></h2>
                    <p class="text-base text-teal-600"><span class="text-gray-600">by</span> <?=$singleBook['author'];?> <span class="text-gray-600">(Author)</span></p>
                    <p class="text-base">Category: <?=$singleBook['cat_title'];?></p>                   
                    <p class="text-base">ISBN: <?=$singleBook['isbn'];?></p>
                    <p class="text-base">Number of pages: <?=$singleBook['nop'];?></p>
                    <div class="flex my-2 justify-between">
                        <div class="flex px-2 bg-orange-600 text-white rounded-sm text-['10px']">#1 Best Seller</div>
                        <div class="flex px-2 text-['10px'] underline mr-4 hover:text-blue-700"><a href="">See all formats and editions.</a></div>
                    </div>
                    <hr>
                </div>
                <div class="flex flex-1 flex-col">
                    <div class="border px-3 py-2 font-semibold">
                    Description
                    </div>
                <div class="border px-3 py-2">
                    <?= $singleBook['description'];?>
                </div>
            </div>
                <!-- order return and replacement -->
                <div class="flex flex-1 w-full bg-teal-500 p-2 justify-between items-center rounded mt-3 mb-3">
                    <div class="flex items-center flex-col">
                        <img src="logoimage/free-Delivery.svg" alt="" class="w-[24px] h-[24px]">
                        <h3 class="text-sm font-medium truncate text-white">Free Delivery</h3>
                    </div>
                    <div class="flex items-center flex-col">
                        <img src="logoimage/cash-Delivery.svg" alt="" class="w-[24px] h-[24px]">
                        <h3 class="text-sm font-medium truncate text-white">Cash on Delivery</h3>
                    </div>
                    <div class="flex items-center flex-col">
                        <img src="logoimage/Original-Products.svg" alt="" class="w-[20px] h-[20px]">
                        <h3 class="text-sm font-medium truncate text-white">Original Products</h3>
                    </div>
                    <div class="flex items-center flex-col">
                        <img src="logoimage/Replacement-icon.svg" alt="" class="w-[20px] h-[20px]">
                        <h3 class="text-sm font-medium truncate text-white">Easy Replacement</h3>
                    </div>
                </div>
                <hr>
            </div>
            <!-- cart section -->
            <div class="w-3/12 p-[6px] bg-teal-400 rounded h-auto">
                <div class="flex  w-ful bg-white flex-col h-full">
                    <!-- price box -->
                    <div class="flex flex-col p-5">
                        <div class="flex">
                            <h2 class="text-3xl text-black font-semibold"><span class="text-sm align-top">₹</span><?=$singleBook['price'];?>/-</h2>
                        </div>
                        <div class="flex">
                            <del class="text-[12px] font-semibold text-gray-500 ml-2">MRP:  ₹<?=$singleBook['mrp'];?></del>
                        </div>
                        <div class="flex font-medium">Inclusive of all taxes</div>  
                    </div>
                    <!-- price box end -->
                    <div class="flex py-2 px-3 gap-1">
                        <h3 class="font-semibold text-orange-600 underline">COUPON:</h3>
                        <p class="text-sm font-normal text-start">For every 100 Spent,You earn 1 Bookchor Coins</p>
                    </div>
                    <div class="flex px-3 py-2 gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    <p class="text-sm font-normal text-start">Delivering to Patna 800001 - <a href="" class="underline text-blue-600">Update location</a></p>
                    </div>
                    <!-- button -->
                    <div class="flex flex-col px-2 py-2 gap-2">
                        <a href="view.php?add_to_cart=<?=$singleBook['id'];?>&bid=<?=$singleBook['id'];?>" class="py-2 font-semibold w-full rounded bg-orange-600 hover:bg-orange-500 text-white text-center">Add to Cart</a>
                        <a href="" class="py-2 font-semibold w-full rounded bg-orange-600 hover:bg-orange-500 text-white text-center">Buy Now</a>
                    </div>
                    <div class="flex my-4">
                        <div class="flex flex-col  outline-none border-none mx-6">
                            <img src="logoimage/original.png" alt="" class="w-[60px] h-[60px]">
                            <p class="text-sm font-normal">100% Original Products</p>
                        </div>
                        <div class="flex flex-col outline-none border-none">
                            <img src="logoimage/quality.png" alt="" class="w-[60px] h-[60px]">
                            <p class="text-sm font-normal">100% Original Products</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- related book -->
        <div class="flex flex-1 px-5">
            <h2 class="text-teal-600 border-l-2 border-teal-700 text-2xl px-2 font-semibold">Related Books</h2>
        </div>
        <div class="w-full p-5">
            <div class="grid grid-cols-1 md:grid-cols-6 gap-5">
                <?php
                    $cat_id = $singleBook['cat_id'];
                    $callingBooks = mysqli_query($connect, "select * from books JOIN categories ON books.category_id = categories.cat_id where category_id = '$cat_id' and books.id != '$bid'");
                    while($row = mysqli_fetch_array($callingBooks)):
                ?>
                <a href="view.php?bid=<?=$row['id'];?>">
               <div class="border shadow-lg p-2 rounded-b-lg">
                    <img src="<?='images/products/' . $row['cover_image'];?>" alt="book cover image" class="w-full">
                    <h2 class="text-xl font-[400] mt-2 line-clamp-1"><?= $row['title'];?></h2>
                    <p class="text-xs text-slate-500 my-1"><?= $row['cat_title'];?></p>
                    <h2 class="text-2xl font-semibold">₹<?= $row['price'];?> <del class="font-semibold text-xs text-red-600">₹<?= $row['mrp'];?></del></h2>
                </div>
                </a>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>

<!-- add to cart -->
<?php
    if(isset($_GET['add_to_cart'])){
        $book_id = $_GET['add_to_cart'];

        addToCart($book_id);
        redirect_to("cart.php");
    }
?>