<?php

$user_id = getUserInfo()['user_id'];

   // checking address id exist in order table or not if not exist then redirect to cart page
   $order = mysqli_query($connect, "select * from orders left join coupons on orders.coupon_id= coupons.coupon_id where ordered = false and user_id = '$user_id'");
   $orderData = mysqli_fetch_array($order);

   if($orderData['address_id'] == null){
       // redirect_to("cart.php");
   }

    $order_id = $orderData['order_id'];

    $callingOrderItem = mysqli_query($connect, "select * from order_items join books on order_items.book_id = books.id where order_id = '$order_id' and ordered = false and user_id = '$user_id'");

    // calculation variable
    $total_mrp_amount = 0;
    $total_amount = 0;
    $total_discount = 0;
    $total_tax = 0;
    $total_payment_amount = 0;
    $total_coupon_amount = 0;

    while($item = mysqli_fetch_array($callingOrderItems)):

        $total_mrp_amount += $item['mrp'] * $item['qty'];
        $total_amount += $item['price'] * $item['qty'];
        $total_discount = $total_mrp_amount - $total_amount;
        $total_tax = $total_amount * 0.18;
        $total_payment_amount = $total_amount + $total_tax;

        if($orderData['coupon_id'] != NULL){
            $total_payment_amount -= $orderData['coupon_amount'];
        }
    endwhile;

    $query = mysqli_query($connect, "insert into payments(order_id, amount, mode) values ('$order_id', '$total_payment_amount', '$mode')");

    if($query){

        $Updatequery = mysqli_query($connect, "update orders set ordered = true where order_id = '$order_id' and user_id='$user_id'");

        if($Updatequery){

        }
    }


?>