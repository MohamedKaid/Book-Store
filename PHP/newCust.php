<?php
    include_once 'dbConnect.php';

    $uname=$_POST['username'];

    $sql = "INSERT INTO customer (first_name, last_name, pin, user_name, street, city, stat, zip)
    VALUES ('$_POST[firstname]', '$_POST[lastname]', '$_POST[pin]', '$uname', '$_POST[address]', '$_POST[city]','$_POST[state]','$_POST[zip]');";

        if(mysqli_query($conn, $sql)){
            echo "it saved for customer";
        } else{
            echo "ERROR: Unable to execute $sql. " . mysqli_error($conn);
        }

    $qrr = "INSERT INTO payment_info (card_num, ptype, exp_date, user_name)
    VALUES ('$_POST[card_number]','$_POST[credit_card]','$_POST[expiration]','$uname');";
        if(mysqli_query($conn, $qrr)){
            echo " \nData saved!";
        }else{
            echo "ERROR: Unable to execute $qrr. " . mysqli_error($conn);
        }	

    header("Location: index.php");
?>