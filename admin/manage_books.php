<?php
    include_once "../includes/config.php";
    include_once "includes/redirectIfUnauth.php";
    $callingBooks = mysqli_query($connect, "select * from books");
    $count = mysqli_num_rows($callingBooks);
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
            <div class="flex px-8 py-2 gap-5">
                <div class="w-full">
                    <h2 class="my-4 text-2xl font-semibold text-blue-800">Manage Books(<?= $count;?>)</h2>
                    <table class="w-full">
                        <tr>
                            <th class="border px-3 py-2">Id</th>
                            <th class="border px-3 py-2">Title</th>
                            <th class="border px-3 py-2">Author</th>
                            <th class="border px-3 py-2">Price</th>
                            <th class="border px-3 py-2">Action</th>
                        </tr>
                        <?php
                           
                            while($row = mysqli_fetch_array($callingBooks)):
                        ?>
                        <tr>
                            <td class="p-2 border text-center"><?= $row['id'];?></td>
                            <td class="p-2 border text-start px-4"><?= $row['title'];?></td>
                            <td class="p-2 border "><?= $row['author'];?></td>
                            <td class="p-2 border text-center">₹<?= $row['price'];?> <del class="text-xs text-slate-500">₹<?= $row['mrp'];?></del></td>
                            <td class="p-2 border text-center">
                                <a href="" class="bg-red-500 text-white px-3 py-2 rounded shadow-md hover:bg-red-600">X</a>
                                <a href="" class="bg-sky-500 text-white px-3 py-2 rounded shadow-md hover:bg-sky-600">View</a>
                                <a href="" class="bg-green-500 text-white px-3 py-2 rounded shadow-md hover:bg-green-600">Edit</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>