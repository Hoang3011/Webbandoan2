<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check credentials
    $query = "SELECT * FROM nhanvien WHERE tennv = '$username' AND mk = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Login successful
        $_SESSION['username'] = $username;
        header("Location: admin.php");
        exit();
    } else {
        // Login failed
        $_SESSION['error'] = "Tên đăng nhập hoặc mật khẩu không đúng!";
        header("Location: adminlogin.php");
        exit();
    }

    mysqli_close($conn);
}
?>