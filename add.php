<?php
session_start();
require_once "database.php";
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, md5($_POST['password']));
$sql = "SELECT name FROM user WHERE username ='" . $username . "'";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($query, MYSQLI_ASSOC);
if ($result) {
    echo "<script>alert('Username is used!')</script>";
    header("Refresh:0 , url = signup.html");
    exit();
}else{
if ($_POST['name'] != null && $_POST['mail'] != null && $_POST['phone'] != null && $_POST['pass'] != null && $_POST['cpass'] == $_POST['pass']) {
    $sql = "INSERT INTO user (Name,Mail,Pass,Phone) VALUES ('" . trim($_POST['name']) . "','" . trim(md5($_POST['mail'])) . "','" . trim($_POST['phone']) . "','" . trim($_POST['pass']) . "')";
    if ($conn->query($sql)) {
        echo "<script>alert('Registration is complete.')</script>";
        header("Refresh:0 , url = login.html");
        exit();
    } else {
        echo "<script>alert('Registration isn't complete.')</script>";
        exit();
	}
 }
mysqli_close($conn);
}