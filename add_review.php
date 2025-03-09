<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ghost_cool";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// เช็คการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่ามีการส่งข้อมูลมาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $place_id = $_POST['place_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];
    
    // เพิ่มคอมเมนต์ลงในฐานข้อมูล
    $sql = "INSERT INTO reviews (place_id, user_id, rating, comment, created_at) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $place_id, $user_id, $rating, $comment);

    if ($stmt->execute()) {
        // ถ้าสำเร็จให้กลับไปที่หน้า index
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>