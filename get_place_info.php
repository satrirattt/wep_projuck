<?php
session_start(); // เริ่ม session
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

// รับ place_id จาก URL
$place_id = $_GET['place_id'];

// ดึงข้อมูลสถานที่
$sql = "SELECT * FROM places WHERE id = $place_id";
$result = $conn->query($sql);
$place = $result->fetch_assoc();

// ดึงข้อมูลจำนวนรีวิว
$sql_reviews = "SELECT COUNT(*) AS review_count, AVG(rating) AS avg_rating FROM reviews WHERE place_id = $place_id";
$result_reviews = $conn->query($sql_reviews);
$reviews_data = $result_reviews->fetch_assoc();

// คำนวณจำนวนดาวเฉลี่ย
$average_rating = round($reviews_data['avg_rating']);
$review_count = $reviews_data['review_count'];

// ดึงข้อมูลรูปภาพจาก place_images
$sql_images = "SELECT * FROM place_images WHERE place_id = $place_id";  // ดึงข้อมูลรูปภาพทั้งหมด
$result_images = $conn->query($sql_images);

// ดึงข้อมูลคอมเมนต์พร้อมชื่อผู้ใช้
$sql_comments = "
    SELECT reviews.*, users.username 
    FROM reviews 
    JOIN users ON reviews.user_id = users.id 
    WHERE reviews.place_id = $place_id 
    ORDER BY reviews.created_at DESC";
$result_comments = $conn->query($sql_comments);


?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Creepster&display=swap');
    .body{
        font-family: 'Mitr', sans-serif;
    }
    .star-rating {
        direction: rtl;
        display: inline-block;
    }

    .star-rating input {
        display: none;
    }

    .star-rating label {
        font-size: 30px;
        color: #ccc;
        cursor: pointer;
    }

    .star-rating input:checked~label {
        color: #f39c12;
        /* สีดาวที่เลือก */
    }

    .star-rating label:hover,
    .star-rating label:hover~label {
        color: #f39c12;
        /* สีดาวเมื่อชี้เมาส์ */
    }

    .review-container {
        display: flex;
        /* ใช้ flexbox เพื่อจัดเรียงคอมเมนต์ในแนวนอน */
        align-items: center;
        /* จัดแนวกลางในแนวตั้ง */
        overflow-x: auto;
        /* ทำให้สามารถเลื่อนในแนวนอนได้ */
        padding: 10px;
        /* ระยะห่างภายในกล่อง */
        margin-top: 10px;
        /* ระยะห่างด้านบน */
        background-color: rgb(33, 37, 41);
        /* สีพื้นหลังของกล่อง */
        border: 0px solid #ccc;
        /* ขอบของกล่อง */
        border-radius: 5px;
        /* มุมโค้งของกล่อง */
    }

    .review-content {
        display: flex;
        /* ใช้ flexbox เพื่อจัดเรียงคอมเมนต์ในแนวนอน */
    }

    .review-card {
        min-width: 250px;
        /* กำหนดความกว้างขั้นต่ำของการ์ดคอมเมนต์ */
        margin-right: 10px;
        /* ระยะห่างระหว่างการ์ด */
        border: 1px solid #ddd;
        /* ขอบของการ์ด */
        border-radius: 5px;
        /* มุมโค้งของการ์ด */
        padding: 10px;
        /* ระยะห่างภายในการ์ด */
        background-color: #fff;
        /* สีพื้นหลังของการ์ด */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* เงาของการ์ด */
    }

    .like-btn,
    .dislike-btn {
        border: none;
        background: none;
        cursor: pointer;
        font-size: 18px;
        margin-right: 10px;
    }

    .like-btn:hover {
        color: #0d6efd;
    }

    .dislike-btn:hover {
        color: #dc3545;
    }
</style>

<div class="place-info">
    <!-- ข้อมูลเรื่องราวซ้าย -->
    <div class="left-column">
        <h2><?php echo $place['name']; ?></h2>
        <h4 style="font-family: 'Mitr', sans-serif">เรื่องราว:</h4>
        <p><?php echo $place['story']; ?></p>

        <div>
            <?php
            // แสดงดาวที่ได้รับจากค่าเฉลี่ย rating
            for ($i = 0; $i < $average_rating; $i++) { ?>
                <span class="text-warning">★</span>
            <?php }
            for ($i = $average_rating; $i < 5; $i++) { ?>
                <span class="text-muted">★</span>
            <?php } ?>
            <span style="font-family: 'Mitr', sans-serif">คนรีวิวมาแล้ว <?php echo $review_count; ?> คน</span>
        </div>
    </div>

    <!-- ข้อมูลรูปภาพขวา -->
    <div class="right-column">
        <h5 style="font-family: 'Mitr', sans-serif">ภาพสถานที่:</h5>
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php if ($result_images->num_rows > 0): ?>
                    <?php $first = true; ?>
                    <?php while ($image_data = $result_images->fetch_assoc()): ?>
                        <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                            <img src="<?php echo $image_data['image_url']; ?>" class="d-block w-100" alt="Place Image">
                        </div>
                        <?php $first = false; ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="carousel-item active">
                        <img src="path/to/default-image.jpg" class="d-block w-100" alt="Default Image">
                    </div>
                <?php endif; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- ฟอร์มให้คะแนน -->
        <form method="POST" action="add_review.php">
            <input type="hidden" name="place_id" value="<?php echo $place_id; ?>">
            <div class="mb-3">
                <label for="rating" class="form-label" style="font-family: 'Mitr', sans-serif">ให้คะแนน:</label>
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" required>
                    <label for="star5" class="star">★</label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4" class="star">★</label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3" class="star">★</label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2" class="star">★</label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1" class="star">★</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label" style="font-family: 'Mitr', sans-serif">ความคิดเห็น:</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="font-family: 'Mitr', sans-serif">ส่งคะแนน</button>
        </form>
    </div>
</div>

<!-- แสดงคอมเมนต์ -->
<h3 style="font-family: 'Mitr', sans-serif">ความคิดเห็น:</h3>
<div class="review-container" id="reviewContainer">
    <div class="review-content" id="reviewContent">
        <?php if ($result_comments->num_rows > 0): ?>
            <?php while ($comment = $result_comments->fetch_assoc()): ?>
                <?php
                // ดึงจำนวน Like และ Dislike จาก review_votes
                $review_id = $comment['id'];
                $sql_likes = "SELECT 
                    SUM(CASE WHEN vote = 'like' THEN 1 ELSE 0 END) AS likes,
                    SUM(CASE WHEN vote = 'dislike' THEN 1 ELSE 0 END) AS dislikes
                    FROM review_votes WHERE review_id = $review_id";
                $result_likes = $conn->query($sql_likes);
                $likes_data = $result_likes->fetch_assoc();
                $likes_count = $likes_data['likes'] ?? 0;
                $dislikes_count = $likes_data['dislikes'] ?? 0;
                
                ?>

                <div class="review-card">
                    <p class="review-text"><?php echo $comment['comment']; ?></p>
                    <div class="review-user">
                        <div>
                            <p class="username"><?php echo $comment['username']; ?></p>
                            <p class="description"><?php echo $comment['created_at']; ?></p>
                        </div>
                    </div>

                    <!-- ฟอร์ม Like -->
                    <form action="update_reaction.php" method="post">
                        <input type="hidden" name="review_id" value="<?php echo $comment['id']; ?>">
                        <input type="hidden" name="action" value="like">
                        <button type="submit" class="like-btn">
                            👍 <span><?php echo $likes_count; ?></span>
                        </button>
                    </form>

                    <!-- ฟอร์ม Dislike -->
                    <form action="update_reaction.php" method="post">
                        <input type="hidden" name="review_id" value="<?php echo $comment['id']; ?>">
                        <input type="hidden" name="action" value="dislike">
                        <button type="submit" class="dislike-btn">
                            👎 <span><?php echo $dislikes_count; ?></span>
                        </button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="color: white;" style="font-family: 'Mitr', sans-serif">ยังไม่มีความคิดเห็น</p>
        <?php endif; $conn->close();?>
    </div>
</div>




