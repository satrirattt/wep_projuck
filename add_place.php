<?php
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

// รับข้อมูลจากฟอร์ม
$name = $_POST['name'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$story = $_POST['story'];

$sql = "INSERT INTO places (name, latitude, longitude, story) VALUES ('$name', '$latitude', '$longitude', '$story')";

if ($conn->query($sql) === TRUE) {
    $place_id = $conn->insert_id; 

    $images = $_FILES['image'];
    $uploadDir = 'uploads/';

    foreach ($images['tmp_name'] as $key => $tmpName) {
        $imagePath = $uploadDir . basename($images['name'][$key]);

        if (move_uploaded_file($tmpName, $imagePath)) {
            $sqlImage = "INSERT INTO place_images (place_id, image_url) VALUES ('$place_id', '$imagePath')";
            if (!$conn->query($sqlImage)) {
                echo "เกิดข้อผิดพลาดในการเพิ่มรูปภาพ: " . $conn->error;
            }
        } else {
            echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์: " . $images['name'][$key];
        }
    }

    header("Location: index.php");
    exit(); 
} else {
    echo "เกิดข้อผิดพลาด: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>