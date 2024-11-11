<?php 
    if(isset($_SESSION['user'])){
        $user = getUserInfo();
    }
?>


<div class="flex flex-1 bg-teal-800 items-center justify-between py-2 px-[28px]">
    <div class="flex items-center">
        <!-- drawer init and toggle -->
        <div class="text-center">
        <button class="text-white font-medium rounded-lg text-sm px-3 py-2.5  focus:outline-none" type="button" data-drawer-target="sidebar" data-drawer-show="sidebar" aria-controls="sidebar">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>

        </button>
    </div>
    <!-- Title of website -->
    <h1 class="py-3 px-5 text-3xl font-semibold text-white">BookChor</h1>
    </div>

    <form action="index.php" class="flex w-[500px]" >
        <input type="search" name="search" placeholder="Search book by ttile, author, isbn..." class="border px-3 py-2 w-full rounded bg-slate-200 outline-none border-none">
        <input type="submit" value="Go" name="find" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 cursor-pointer font-medium rounded ml-1">
    </form>

    <div class="flex gap-5 px-4">
        <a class="flex items-center gap-1 text-[20px] font-medium text-white hover:text-black" href="index.php">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            Home
        </a>
        <a href="my-orders.php" class="flex items-center gap-1 text-[20px] font-medium text-white hover:text-black bg-orange-600 hover:bg-orange-700 px-4 py-2 rounded">My Orders</a> 
        <a class="flex items-center gap-1 text-[20px] font-medium text-white hover:text-black" href="cart.php">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
          </svg>
            Cart
        </a>
        <?php
            if(isset($_SESSION['user'])):
        ?>

        <!-- Drop down Profile -->
        
        <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer" src="https://static.vecteezy.com/system/resources/previews/002/318/271/original/user-profile-icon-free-vector.jpg" alt="User dropdown">
        
        <!-- Dropdown menu -->
        <div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
              <div><?= $user['fullname'];?></div>
              <div class="font-medium truncate"><?= $user['email'];?></div>
            </div>
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
              </li>
            </ul>
            <div class="py-1">
              <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
            </div>
        
        </div>

        <?php else: ?>
        <a class="text-[20px] font-medium text-white hover:text-black" href="register.php">Signup</a>
        <a class="text-[20px] font-medium text-white hover:text-black" href="login.php">Login</a>

        <?php endif; ?>
    </div>
</div>