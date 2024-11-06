<!-- drawer component -->
<div id="sidebar" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-[#D8FEF1] w-[280px] aria-labelledby=drawer-label">



   <!-- for closing sidebar -->
   <button type="button" data-drawer-hide="sidebar" aria-controls="sidebar" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
      <span class="sr-only">Close menu</span>
   </button>

   <!-- list items -->

   <div class="flex flex-col gap-y-2 mt-7">
      <?php
         $callingCat = mysqli_query($connect, "select * from categories");
         while($cat = mysqli_fetch_array($callingCat)):
      ?>
        <a href="index.php?filter=<?= $cat['cat_id'];?>" class="py-2 px-3 font-semibold hover:bg-green-200 text-xl truncate"><?=$cat['cat_title'];?></a>
      <?php endwhile; ?>
   </div>
</div>