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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root, head, body{
            height: 100%;
        }
    </style>
</head>
<body>
    <?php include_once "includes/header.php"; ?>

    <div class="flex h-[100%] flex-1 items-center bg-[url(logoimage/login-bg.png)] ">
        <div class="w-3/12 mx-auto -mt-8">
            <div class="border bg-white shadow-sm flex-1 p-5 rounded-md" >
                <form action="" method="post">
                    <div class="mb-3">
                        <h2 class="text-xl font-medium underline">Signup Here</h2>
                    </div>
                    <div class="mb-3">
                        <label for="fullname" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="fullname" id="fullname" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                        <input type="text" name="contact" id="contact" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="block text-sm font-medium text-gray-700">Create Password</label>
                        <input type="password" name="password" id="password" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="signup" value="SignUp" class="bg-teal-600 w-full p-3 text-white hover:bg-teal-800 rounded-md">
                    </div>
                    <div class="text-[15px]">
                        <a href="login.php" class="text-teal-600 hover:text-teal-800 font-semibold">Already have an account?</a>
                    </div>
                </form>
                <?php
                    if(isset($_POST['signup'])){
                        $fullname = $_POST['fullname'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $contact = $_POST['contact'];

                        //encryption
                        $password = md5($password);

                        $sql = "INSERT INTO users(fullname, email, contact, password) values ('$fullname', '$email', '$contact', '$password')";

                        $result = mysqli_query($connect, $sql);
                        if($result){
                            echo "<script>alert('Registration Successful')</script>";
                            redirect_to('login.php');
                        }
                        else{
                            echo "<script>alert('Registration Failed')</script>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>   


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>