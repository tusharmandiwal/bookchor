<?php
    include_once "includes/config.php";
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
    <?php include_once "includes/header.php"; ?>
    
    <?php include_once "includes/subheader.php"; ?>

    <!-- hero section -->
    <div class="flex flex-1 w-full">
        <img src="logoimage/heroImg.jpg" alt="">
    </div>

    <div class="w-full flex flex-1">
        <div class="">
            <?php include_once "includes/sidebar.php"; ?>
        </div>
        <div class="flex flex-col">
        <?php 
            $callingCatforBook = mysqli_query($connect, "Select * from categories");
            while($cat = mysqli_fetch_array($callingCatforBook)):
                $cat_id = $cat['cat_id'];
        ?>
        <div class=" p-5 gap-2 flex flex-col">
            <div class="flex">
                <h2 class="text-2xl px-2 font-semibold text-teal-900 underline"><?= $cat['cat_title'];?></h2>
            </div>
            <div class="flex flex-nowrap w-[100%] overflow-x-scroll gap-3 p-5 rounded-md bg-[#D8FEF1]">
                <?php
                    if(isset($_GET['filter'])){
                        $cat_id = $_GET['filter'];
                        $callingBooks = mysqli_query($connect, "select * from books JOIN categories ON books.category_id = categories.cat_id where category_id = '$cat_id'");
                    }
                    elseif(isset($_GET['find'])){
                        $search = $_GET['search'];

                        if(preg_match("/[0-9]{5,}/", $search)){
                            $callingBooks = mysqli_query($connect, "select * from books where isbn='$search'");
                            $singleBookData = mysqli_fetch_array($callingBooks);
                            $bid = $singleBookData['id'];
                            redirect_to("view.php?bid=$bid");
                        }
                        if(strlen($search) <= 3){
                            message("please use atleast more than 3 characters");
                            redirect_to("index.php");
                        }
                        else{
                            $callingBooks = mysqli_query($connect, "select * from books JOIN categories ON books.category_id = categories.cat_id where title LIKE '%$search%' and books.category_id='$cat_id'");
                        }
                    }
                    else{
                        $callingBooks = mysqli_query($connect, "select * from books JOIN categories ON books.category_id = categories.cat_id where books.category_id='$cat_id'");
                    }

                    $count = mysqli_num_rows($callingBooks);
                    if($count < 1){
                        echo "<h2 class='text-2xl p-4 font-semibold'>No Book Found!</h2>";
                    }
                    while($row = mysqli_fetch_array($callingBooks)):
                ?>
                <a href="view.php?bid=<?=$row['id'];?>" class="min-w-[15%]">
               <div class="border shadow-lg p-2 rounded-lg gap-2 bg-slate-50">
                    <img src="<?='images/products/' . $row['cover_image'];?>" alt="book cover image" class="w-full max-h-[220px]">
                    <h2 class="text-xl font-[400] mt-2 line-clamp-1"><?= $row['title'];?></h2>
                    <p class="text-xs text-slate-500 my-1"><?= $row['cat_title'];?></p>
                    <h2 class="text-2xl font-semibold">₹<?= $row['price'];?> <del class="font-semibold text-xs text-red-600">₹<?= $row['mrp'];?></del></h2>
                </div>
                </a>
                <?php endwhile; ?>
            </div>
        </div>
        <?php endwhile;?>
                    </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>