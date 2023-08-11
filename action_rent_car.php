<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (isset($_POST['rentcar'])) {
    $vehicleId = intval($_GET['id']);
    $userEmail = $_SESSION['login'];

    // Get AgencyId from vehicles
    $sql = "SELECT AgencyId,RentPerDay from vehicles where id=:vehicleId";
    $query = $dbh->prepare($sql);
    $query->bindParam(':vehicleId', $vehicleId, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_OBJ);
    $aId = $results->AgencyId;
    // Retrieve other form data
    $RentPerDay = $results->RentPerDay;
    $bookingdays = $_POST['bookingdays'];
    $amount = $RentPerDay * $bookingdays;

    $startdate = $_POST['startdate'];
    // echo "<script>alert(`aId: $aId`);</script>";

    // echo "<script>alert(`vehicleId: $vehicleId`);</script>";

    // echo "<script>alert(`userEmail: $userEmail`);</script>";

    // echo "<script>alert(`amount: $amount`);</script>";

    // echo "<script>alert(`bookingdays: $bookingdays`);</script>";

    // echo "<script>alert(`startdate: $startdate`);</script>";

    // Insert data into bookings table
    $sql = "INSERT INTO bookings(VehicleId,AgencyId,UserEmail,Amount,DaysRented,StartDate) VALUES(:vehicleId,:aId,:userEmail,:amount,:bookingdays,:startdate)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':vehicleId', $vehicleId, PDO::PARAM_INT);
    $query->bindParam(':aId', $aId, PDO::PARAM_INT);
    $query->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
    $query->bindParam(':amount', $amount, PDO::PARAM_STR);
    $query->bindParam(':bookingdays', $bookingdays, PDO::PARAM_STR);
    $query->bindParam(':startdate', $startdate, PDO::PARAM_STR);
    $query->execute();

    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "<script>alert('Booking successful.');</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
    header("location:index.php");

}
?>