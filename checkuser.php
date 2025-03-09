<?php
session_start();
$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Email = $_POST['Email'];
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ghost_cool";
$_SESSION['Username']=$Username;


$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
    die("เชื่อมต่อฐานข้อมูลไม่ได้: " . mysqli_connect_error());
}


// ค้นหาผู้ใช้
mysqli_select_db($conn,$dbname) or die("ไม่สามารถเลือกฐานข้อมูล session ได้");
$sqltxt = "SELECT * FROM users WHERE username = '$Username' OR email = '$Email'";
$result = mysqli_query($conn, $sqltxt);
$rs = mysqli_fetch_array($result);

if ($rs) {
    if ($rs['password'] == $Password && $rs['role'] == "user") { // ตรวจสอบรหัสผ่านที่ถูกเข้ารหัส
        $_SESSION['user_id'] = $rs['id'];
        echo $_SESSION['user_id'];
        $_SESSION['Username'] = $rs['username'];
        $_SESSION['Email'] = $rs['email'];
        header("Location: index.php");
        exit();
    }elseif($rs['password'] == $Password && $rs['role'] == "admin"){
        header("Location: Foradmin.php");
        exit();
    } 
    else {
        $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง";
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['error'] = "ไม่พบชื่อผู้ใช้หรืออีเมล";
    header("Location: login.php");
    exit();
}

mysqli_close($conn);
?>
