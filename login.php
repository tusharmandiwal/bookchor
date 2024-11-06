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

    <div class="flex h-full flex-1 items-center bg-[url(logoimage/login-bg.png)]">
        <div class="w-3/12 mx-auto -mt-10">
            <div class="border bg-white shadow-lg flex-1 p-5 rounded-md" >
                <form action="" method="post">
                    <div class="mb-3">
                        <h2 class="text-xl font-medium underline">Login Here</h2>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="block text-sm font-medium text-gray-700">Enter Password</label>
                        <input type="password" name="password" id="password" class="mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="login" value="Login" class="bg-teal-600 w-full p-3 text-white hover:bg-teal-800 rounded-md">
                    </div>
                    <div class="text-[14px] flex justify-between">
                        <a href="login.php" class="text-teal-600 hover:text-teal-800 font-semibold">Create new account</a>
                        <a href="login.php" class="text-teal-600 hover:text-teal-800 font-semibold">Forget password?</a>
                    </div>
                </form>
                
                <?php
                    if(isset($_POST['login'])){
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $password = md5($password);

                        $query = "SELECT * FROM users where email = '$email' AND password = '$password'";
                        $result = mysqli_query($connect, $query);

                        $data = mysqli_fetch_array($result);
                        // admin pannel redirect
                        if($data['isAdmin'] == 1){
                            $_SESSION['admin'] = $email;
                            redirect_to("admin/index.php");
                        }
                        else{
                            $count = mysqli_num_rows($result);

                            if($count > 0){
                                $_SESSION['user'] = $email;
                                redirect_to("index.php");
                            }
                            else{
                                message("username or password in incorrect");
                                redirect_to("login.php");
                            }
                        }
                        
                    }
                ?>
            </div> 
        </div>
    </div>   


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>