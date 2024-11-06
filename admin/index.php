<?php
    include_once "../includes/config.php";
    include_once "includes/redirectIfUnauth.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Chor</title>
    <link rel="stylesheet" href="../output.css">
    <script src= "https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body>
    <?php include_once "includes/adminHeader.php"; ?>
    
    <div class="flex flex-1">
        <div class="w-1/5">
            <?php include_once "includes/links.php"; ?>
        </div>
        <div class="w-4/5">
            <div class="grid grid-cols-4 p-8 gap-5">
                <div class="flex flex-1 flex-col bg-purple-500 text-white rounded border border-purple-600 p-5 gap-2 shadow-lg">
                    <h1 class="text-3xl font-semibold"><?= countTable('books');?></h1>
                    <h6 class="text-sm">Total Books</h6>
                </div>
                <div class="flex flex-1 flex-col bg-blue-500 text-white rounded border border-blue-600 p-5 gap-2 shadow-lg">
                    <h1 class="text-3xl font-semibold"><?= countTable('categories');?></h1>
                    <h6 class="text-sm">Total Categories</h6>
                </div>
                <div class="flex flex-1 flex-col bg-orange-500 text-white rounded border border-orange-600 p-5 gap-2 shadow-lg">
                    <h1 class="text-3xl font-semibold"><?= countTable('users');?></h1>
                    <h6 class="text-sm">Total Users</h6>
                </div>
                <div class="flex flex-1 flex-col bg-green-500 text-white rounded border border-green-600 p-5 gap-2 shadow-lg">
                    <h1 class="text-3xl font-semibold">10+</h1>
                    <h6 class="text-sm">Total Books</h6>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>