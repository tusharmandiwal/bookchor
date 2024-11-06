<?php
    include_once "../includes/config.php";
    include_once "includes/redirectIfUnauth.php";

    $callingCat = mysqli_query($connect, "select * from categories");
    $count = mysqli_num_rows($callingCat);
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
                <div class="w-7/12">
                    <h2 class="my-4 text-2xl font-semibold text-blue-800">Manage Categories(2)</h2>
                    <table class="w-full">
                        <tr>
                            <th class="border px-3 py-2">Id</th>
                            <th class="border px-3 py-2">Title</th>
                            <th class="border px-3 py-2">Description</th>
                            <th class="border px-3 py-2">Action</th>
                        </tr>
                        <?php
                            $callingCat = mysqli_query($connect, "select * from categories");
                            while($row = mysqli_fetch_array($callingCat)):
                        ?>
                        <tr>
                            <td class="text-center border py-2 px-3"><?= $row['cat_id']; ?></td>
                            <td class="text-center border py-2 px-3"><?= $row['cat_title']; ?></td>
                            <td class="text-center border py-2 px-3"><?= $row['cat_desc']; ?></td>
                            <td class="text-center border py-2 px-3">
                                <a href="" class="bg-red-500 px-3 py-2 rounded-md ">X</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
                <div class="w-5/12">
                    <h2 class="my-4 text-2xl font-semibold text-blue-800">Insert Categories(2)</h2>
                    <div class="bg-slate-200 border p-4">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="">Category Title</label>
                                <input type="text" name="cat_title" class="border w-full px-3 py-2">
                            </div>
                            <div class="mb-3">
                                <label for="">Category Description</label>
                                <textarea rows="5" type="text" name="cat_desc" class="border w-full"></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="submit" name="cat_insert" class="bg-teal-600 hover:bg-teal-500 text-white px-3 py-2 w-full" value="Insert Category">
                            </div>
                        </form>
                        <?php
                            if(isset($_POST['cat_insert'])){
                                $cat_title = $_POST['cat_title'];
                                $cat_desc = $_POST['cat_desc'];

                                $query = mysqli_query($connect, "insert into categories(cat_title, cat_desc) value ('$cat_title', '$cat_desc')");

                                if($query){
                                    redirect_to('manage_categories.php');
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>