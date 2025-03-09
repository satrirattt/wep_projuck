<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ghost_cool";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือยัง
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // ส่งกลับไปหน้า login
    exit();
}

$user_id = $_SESSION['user_id'];
$review_id = $_POST['review_id'];
$action = $_POST['action']; // 'like' หรือ 'dislike'

// ตรวจสอบว่ามีการโหวตมาก่อนหรือไม่
$sql = "SELECT vote FROM review_votes WHERE user_id = ? AND review_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $review_id);
$stmt->execute();
$result = $stmt->get_result();
$existing_vote = $result->fetch_assoc();

if ($existing_vote) {
    if ($existing_vote['vote'] === $action) {
        // ถ้ากดซ้ำให้ลบโหวต
        $sql = "DELETE FROM review_votes WHERE user_id = ? AND review_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $review_id);
    } else {
        // ถ้าเปลี่ยนจาก like -> dislike หรือ dislike -> like
        $sql = "UPDATE review_votes SET vote = ? WHERE user_id = ? AND review_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $action, $user_id, $review_id);
    }
} else {
    // ถ้ายังไม่เคยโหวต ให้เพิ่มข้อมูลใหม่
    $sql = "INSERT INTO review_votes (user_id, review_id, vote) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $user_id, $review_id, $action);
}

$stmt->execute();
$stmt->close();

header("Location: index.php"); // รีเฟรชหน้าหลังจากโหวต
$conn->close();
?>
