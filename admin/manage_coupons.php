<?php
include_once "../includes/config.php";
include_once "includes/redirectIfUnauth.php";

// Fetching coupons
$callingCoupons = mysqli_query($connect, "SELECT coupon_id, coupon_code, coupon_amount, coupon_status FROM coupons");
$count = mysqli_num_rows($callingCoupons);

// Handle coupon insertion
if (isset($_POST['coupon_insert'])) {
    $coupon_code = $_POST['coupon_code'];
    $coupon_amount = $_POST['coupon_amount'];

    $query = mysqli_query($connect, "INSERT INTO coupons (coupon_code, coupon_amount, coupon_status) VALUES ('$coupon_code', '$coupon_amount', 1)");

    if ($query) {
        redirect_to('manage_coupons.php');
    }
}

// Handle coupon activation/deactivation
if (isset($_GET['toggle_status'])) {
    $coupon_id = $_GET['toggle_status'];
    
    // Fetch current status
    $statusQuery = mysqli_query($connect, "SELECT coupon_status FROM coupons WHERE coupon_id='$coupon_id'");
    $statusRow = mysqli_fetch_array($statusQuery);
    $currentStatus = $statusRow['coupon_status'];

    // Toggle the status
    $newStatus = ($currentStatus == 1) ? 0 : 1;
    mysqli_query($connect, "UPDATE coupons SET coupon_status='$newStatus' WHERE coupon_id='$coupon_id'");
    
    redirect_to('manage_coupons.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coupons | Book Chor</title>
    <link rel="stylesheet" href="../output.css">
    <script src="https://cdn.tailwindcss.com"></script>
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
                    <h2 class="my-4 text-2xl font-semibold text-blue-800">Manage Coupons</h2>
                    <table class="w-full">
                        <tr>
                            <th class="border px-3 py-2">Id</th>
                            <th class="border px-3 py-2">Code</th>
                            <th class="border px-3 py-2">Amount</th>
                            <th class="border px-3 py-2">Status</th>
                            <th class="border px-3 py-2">Action</th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_array($callingCoupons)):
                        ?>
                        <tr>
                            <td class="text-center border py-2 px-3"><?= $row['coupon_id']; ?></td>
                            <td class="text-center border py-2 px-3"><?= $row['coupon_code']; ?></td>
                            <td class="text-center border py-2 px-3"><?= $row['coupon_amount']; ?></td>
                            <td class="text-center border py-2 px-3"><?= $row['coupon_status'] == 1 ? 'Active' : 'Inactive'; ?></td>
                            <td class="text-center border py-2 px-3">
                                <a href="?toggle_status=<?= $row['coupon_id']; ?>" class="bg-teal-600 hover:bg-teal-500 text-white px-3 py-2 rounded-md"><?= $row['coupon_status'] == 1 ? 'Deactivate' : 'Activate'; ?></a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
                <div class="w-5/12">
                    <h2 class="my-4 text-2xl font-semibold text-blue-800">Insert Coupon</h2>
                    <div class="bg-slate-200 border p-4">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="">Coupon code</label>
                                <input type="text" name="coupon_code" class="border w-full px-3 py-2" required>
                            </div>
                            <div class="mb-3">
                                <label for="">Coupon Amount</label>
                                <input type="text" name="coupon_amount" class="border w-full px-3 py-2" required>
                            </div>
                            <div class="mb-3">
                                <input type="submit" name="coupon_insert" class="bg-teal-600 hover:bg-teal-500 text-white px-3 py-2 w-full" value="Insert Coupon">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
