<?php
session_start();
include 'db.php';

if(isset($_GET['booking_id'])){
    $booking_id = $_GET['booking_id'];
    $amount = $_GET['amount'];
    
    // 1. ክፍያውን መዝግብ
    $sql_pay = "INSERT INTO payments (booking_id, amount) VALUES ('$booking_id', '$amount')";
    $conn->query($sql_pay);
    
    // 2. Booking Status ወደ 'Confirmed' ቀይር
    $sql_update = "UPDATE bookings SET status='Confirmed' WHERE booking_id='$booking_id'";
    $conn->query($sql_update);
    
    // ጨርሰናል! ወደ ዳሽቦርድ እንመልሰው
    echo "<script>alert('ክፍያዎ ተፈጽሟል! (Payment Successful)'); window.location='dashboard.php';</script>";
}
?>