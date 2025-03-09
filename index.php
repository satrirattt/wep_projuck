<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ghost_cool";

session_start();
if(!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();  
}
// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// เช็คการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลสถานที่ทั้งหมด
$sql = "SELECT * FROM places";
$result = $conn->query($sql);

$places = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $places[] = $row;
    }
} else {
    die("No places found");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haunted Place</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Creepster&display=swap');
        .THAI{
            font-family: 'Mitr', sans-serif;
        }
        
        /* ปรับขนาดของแผนที่ */
        body {
            font-family: 'Creepster', cursive;
            margin: 0;
            padding: 0;
            background: #eee;
        }

        .header {
            background: #910000;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
        }

        .header a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        .content {
            padding: 20px;
        }



        .cards-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .card {
            width: 30%;
            background: #ccc;
            padding: 10px;
            box-sizing: border-box;
        }

        .card img {
            width: 100%;
        }

        #map {
            height: 500px;
            width: 100%;
        }

        .container-custom {
            margin-top: 30px;
        }

        .place-info {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .left-column {
            flex: 0 0 50%;
            padding-right: 30px;
        }

        .right-column {
            flex: 0 0 50%;
        }

        .right-column img {
            max-width: 100%;
            border-radius: 8px;
        }

        /* หัวข้อ */
        .title {
            text-align: left;
            font-size: 2.5em;
            font-weight: bold;
            margin-top: 20px;
            font-family: Luckiest Guy;
        }

        /* คอนเทนเนอร์ของรีวิว */
        .review-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
            color: black;
        }

        /* การ์ดรีวิว */
        .review-card {
            background: rgb(255, 255, 255);
            border-radius: 10px;
            overflow: hidden;
            width: 300px;
            text-align: center;
            padding-bottom: 15px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .review-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .review-text {
            font-size: 1.1em;
            font-weight: bold;
            margin: 10px;
            text-align: left;
        }

        /* ส่วนข้อมูลผู้ใช้ */
        .review-user {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
        }

        .review-user img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .username {
            font-size: 0.9em;
            font-weight: normal;
        }

        .description {
            font-size: 0.8em;
            color: gray;
        }

        /* ปุ่ม Like / Dislike */
        .review-actions span {
            font-size: 1.5em;
            cursor: pointer;
            margin: 0 5px;
        }

        .review-actions span:hover {
            color: red;
        }

        /* Footer */
        footer {
            background-color: white;
            padding: 40px 60px;
            border-top: 2px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 1200px;
            margin: auto;
        }

        .footer-left h2 {
            font-size: 1.8em;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .social-icons {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        .social-icons a img {
            width: 24px;
            height: 24px;
            opacity: 0.6;
            transition: 0.3s ease-in-out;
        }

        .social-icons a img:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .footer-right {
            display: flex;
            gap: 60px;
        }

        .footer-column h3 {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .footer-column a {
            display: block;
            color: black;
            text-decoration: none;
            margin-bottom: 6px;
            font-size: 0.95em;
            transition: color 0.3s ease-in-out;
        }

        .footer-column a:hover {
            color: #ff0000;
            text-decoration: underline;
        }
    </style>

</head>

<body class="bg-dark text-white">
    
    <div class="header">
        <div>GhostCool 👻</div>
        <nav>
            <a href="#map">Map</a>
            <a href="logout.php">Log Out</a>
        </nav>
    </div>
    <div class="content">
        <div style="font-size: 75px;" >GHOSTCOOL</div>
        <p style="font-family: 'Mitr', sans-serif">ขึ้นชื่อว่าสถานที่เฮี้ยน!!...คงไม่มีใครอยากไป
            แต่สำหรับคนที่อยากลองของหรือท้าทายสิ่งเร้นลับที่มองไม่เห็นด้วยตาเปล่า
            สถานที่ผีเฮี้ยนที่ GhostCool นำมาฝากกันไว้ในวันนี้น่าจะเป็นประโยชน์
        </p>
        <div class="cards-container">
            <div class="card">
                <img src="./im/soplay.jpg" alt="สถานที่เฮี้ยน">
                <h3 >Top 1 </h3><h3 style="font-family: 'Mitr', sans-serif">สุสานโสเภณี จ.กาญจนบุรี</h3>
                <p style="font-family: 'Mitr', sans-serif">&ensp;&ensp; สถานบันเทิงเก่าแห่งหนึ่งเคยบังคับหญิงบริการ
                    ให้รับแขกอย่างโหดร้ายจนพวกเธอเสียชีวิตจำนวนมาก
                    กลายเป็นสถานที่ที่เต็มไปด้วยเรื่องราวอันน่าสะพรึงกลัว</p>
            </div>
            <div class="card">
                <img src="./im/hos.jpg" alt="โรงพยาบาลร้าง">
                <h3>Top 2</h3><h3 style="font-family: 'Mitr', sans-serif">โรงพยาบาลสยอง จ.ระยอง</h3>
                <p style="font-family: 'Mitr', sans-serif">&ensp;&ensp;โรงพยาบาลร้างจากพิษเศรษฐกิจ
                    กลายเป็นสถานที่เลื่องลือเรื่องความเฮี้ยน
                    มีผู้พบเห็นไฟเปิดเองและเตียงคนไข้เคลื่อนที่ได้เอง
                    สร้างความหวาผวาจนถึงปัจจุบัน
                </p>
            </div>
            <div class="card">
                <img src="./im/sa.jpg" alt="ตึกสาธรยูนิก">
                <h3>Top 3 </h3><h3 style="font-family: 'Mitr', sans-serif">ตึกสาทรยูนิก จ.กรุงเทพมหานคร</h3>
                <p style="font-family: 'Mitr', sans-serif">&ensp;&ensp; ตึกสร้างกลางเมืองที่ถูกขนานนาม "ตึกผีสิง"
                    โด่งดังจากอาถรรพ์สุสานเก่าและการพบศพ
                    ปริศนาในปี 2557
                </p>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <!-- แผนที่ -->
        <div id="map"></div>

        <!-- ส่วนแสดงข้อมูลเมื่อคลิกหมุด -->
        <div id="place-info" class="container-custom mt-4" style="display: none;">
            <div class="place-info">
                <!-- ข้อมูลเรื่องราวซ้าย -->
                <div class="left-column">
                    <h2 id="place-name"></h2>
                    <p id="place-description"></p>
                    <h4 style="font-family: 'Mitr', sans-serif">เรื่องราว:</h4>
                    <p id="place-story"></p>
                    <div id="place-rating"></div>
                    <div id="place-reviews"></div>
                </div>
                <div id="map"><!-- ข้อมูลรูปภาพขวา -->
                <div class="right-column">
                    <h5 style="font-family: 'Mitr', sans-serif">ภาพสถานที่:</h5>
                    <div id="place-images"></div>
                </div>
            </div>
        </div>

        <script>
            var map = L.map('map').setView([15, 100], 5); // ปักหมุดเริ่มต้นที่ศูนย์กลางประเทศไทย
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            // ปักหมุดทุกสถานที่จากฐานข้อมูล
            <?php foreach ($places as $place): ?>
                var marker = L.marker([<?php echo $place['latitude']; ?>, <?php echo $place['longitude']; ?>]).addTo(map);
                marker.bindPopup("<b><?php echo $place['name']; ?></b><br><a href='#place-info' onclick='showPlaceInfo(<?php echo $place['id']; ?>)'>Click to view</a>");
            <?php endforeach; ?>

            // ฟังก์ชันโหลดข้อมูลเมื่อคลิกที่หมุด
            function showPlaceInfo(place_id) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "get_place_info.php?place_id=" + place_id, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById("place-info").style.display = 'block';
                        document.getElementById("place-info").innerHTML = xhr.responseText;
                    }
                };
                xhr.send();
            }
        document.querySelector('a[href="#map"]').addEventListener('click', function(event) {
        event.preventDefault(); // ป้องกันการกระโดดไปยังแฮช
        document.getElementById('map').scrollIntoView({ behavior: 'smooth' }); // เลื่อนอย่างนุ่มนวลไปยังแผนที่
    });
        </script>
        </div>
        <br>
        <button class="btn btn-primary" id="showFormButton" onclick="toggleForm()" style="font-family: 'Mitr', sans-serif">เพิ่มสถานที่ใหม่</button>

        <div class="container" id="addPlaceForm" style="display: none; margin-top: 20px;">
            <h2 style="font-family: 'Mitr', sans-serif">เพิ่มสถานที่ใหม่</h2>
            <form method="POST" action="add_place.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label" style="font-family: 'Mitr', sans-serif">ชื่อสถานที่</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="latitude" class="form-label" style="font-family: 'Mitr', sans-serif">ละติจูด</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" required>
                </div>
                <div class="mb-3">
                    <label for="longitude" class="form-label" style="font-family: 'Mitr', sans-serif">ลองจิจูด</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" required>
                </div>
                <div class="mb-3">
                    <label for="story" class="form-label" style="font-family: 'Mitr', sans-serif">เรื่องราว</label>
                    <textarea class="form-control" id="story" name="story" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label" style="font-family: 'Mitr', sans-serif">อัปโหลดรูปภาพ</label>
                    <input type="file" class="form-control" id="image" name="image[]" accept="image/*" multiple required>
                </div>
                <button type="submit" class="btn btn-primary" style="font-family: 'Mitr', sans-serif">เพิ่มสถานที่</button>
            </form>
        </div>
    </div>

<br><br><br><br>

    <script>
        function toggleForm() {
            var form = document.getElementById("addPlaceForm");
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
</body>

</html>