<?php
    //project configration
    define("PROJECT_NAME", "BookChor");

    //db connection
    $connect = mysqli_connect("localhost", "root", "", "bookchor") or die("unable to conncet!");

    //session start
    session_start();
    
    // $_SESSION['name'] = "value";

    //function work 
    function redirect_to($page){
        echo "<script>window.open('$page', '_self')</script>";
    }

    // alert function'
    function message($msg){
        echo "<script>alert('$msg')</script>";
    }

    // get logged user information
    function getUserInfo(){
        global $connect;
        $email = $_SESSION['user'];
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($connect, $query);
        $user_data = mysqli_fetch_array($result);
        return $user_data;
    }

    function countTable($table)
     {
        global $connect;
        $query ="SELECT * FROM $table";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        return $count;
    }


    // add to cart

    function addToCart($book_id){
        // global declaration
        global $connect;

        // redirect if user not signin
        if(!isset($_SESSION['user'])){
            redirect_to("login.php");
        }

        // get user id
        $user_id = getUserInfo()['user_id'];

        // check if order already exists
        $checkOrder = mysqli_query($connect, "select * from orders where user_id = '$user_id' and ordered=0");
        $existOrder = mysqli_fetch_array($checkOrder);
        $countExistOrder = mysqli_num_rows($checkOrder);


        if($countExistOrder > 0){
            // to do work id order record already exists
            $order_id = $existOrder['order_id'];
            $checkOrderItem = mysqli_query($connect, "select * from order_items where order_id='$order_id' and book_id='$book_id' and ordered=false and user_id='$user_id'");
            $countOrderItem = mysqli_num_rows($checkOrderItem);
            $orderItem = mysqli_fetch_array($checkOrderItem);

            if($countOrderItem > 0){
                // if order item of this order already exist then only increase the qty
                $qty = $orderItem['qty'] + 1;
                $query = "update order_items set qty='$qty' where order_id='$order_id' and book_id='$book_id' and user_id='$user_id' and ordered=false";
                $result = mysqli_query($connect, $query);

            }else{
                // create new order item
                $query = "insert into order_items (order_id, book_id, user_id, ordered) values ('$order_id', '$book_id', '$user_id', false)";
                $result = mysqli_query($connect, $query);
            }
        }else{
            // create new oder
            $query = "INSERT INTO orders(user_id, ordered) values ('$user_id', false)";
            $result = mysqli_query($connect, $query);
            $order_id = mysqli_insert_id($connect);


            $checkOrderItem = mysqli_query($connect, "select * from order_items where order_id='$order_id' and book_id='$book_id' and ordered=false and user_id='$user_id'");
            $countOrderItem = mysqli_num_rows($checkOrderItem);
            $orderItem = mysqli_fetch_array($checkOrderItem);

            if($countOrderItem > 0){
                // if order item of this order already exist then only increase the qty
                $qty = $orderItem['qty'] + 1;
                $query = "update order_items set qty='$qty' where order_id='$order_id' and book_id='$book_id' and user_id='$user_id' and ordered=false";
                $result = mysqli_query($connect, $query);

            }else{
                // create new order item
                $query = "insert into order_items (order_id, book_id, user_id, ordered) values ('$order_id', '$book_id', '$user_id', false)";
                $result = mysqli_query($connect, $query);
            }
        }
    }

    // remove from cart

    function removeFromCartqty($book_id){
        // global declaration
        global $connect;

        // redirect if user not signin
        if(!isset($_SESSION['user'])){
            redirect_to("login.php");
        }

        // get user id
        $user_id = getUserInfo()['user_id'];

        // check if order already exists
        $checkOrder = mysqli_query($connect, "select * from orders where user_id = '$user_id' and ordered=0");
        $existOrder = mysqli_fetch_array($checkOrder);
        $countExistOrder = mysqli_num_rows($checkOrder);


        if($countExistOrder > 0){
            // to do work id order record already exists
            $order_id = $existOrder['order_id'];
            $checkOrderItem = mysqli_query($connect, "select * from order_items where order_id='$order_id' and book_id='$book_id' and ordered=false and user_id='$user_id'");
            $countOrderItem = mysqli_num_rows($checkOrderItem);
            $orderItem = mysqli_fetch_array($checkOrderItem);

            if($countOrderItem > 0){
                // if order item of this order already exist then only increase the qty
                if($orderItem['qty'] == 1){
                    $query = "DELETE FROM order_items WHERE order_id='$order_id' and book_id='$book_id' and user_id='$user_id' and ordered=false";
                    $result = mysqli_query($connect, $query);
                }else{
                    $qty = $orderItem['qty'] - 1;
                    $query = "update order_items set qty='$qty' where order_id='$order_id' and book_id='$book_id' and user_id='$user_id' and ordered=false";
                    $result = mysqli_query($connect, $query);
                }
                

            }
        }
    }
?>