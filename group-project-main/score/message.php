<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 90vh;
            background: url("https://sakolraj.ac.th/wp-content/uploads/2023/08/370503211_870068174821898_4480323347210594771_n.jpg") center/cover no-repeat;
            font-family: "Kanit", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            color: white;
        }

        .text {
            font-size: 30px;
            margin-bottom: 20px;
        }

        .score {
            font-size: 150px;
            margin-bottom: 20px;
        }

        .image {
            border-radius: 5px;
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php
        // กำหนดค่าของฐานข้อมูล
        $servername = "localhost"; // เปลี่ยนเป็นชื่อโฮสต์ของเซิร์ฟเวอร์ฐานข้อมูล
        $username = "ชื่อผู้ใช้"; // เปลี่ยนเป็นชื่อผู้ใช้ MySQL
        $password = "รหัสผ่าน"; // เปลี่ยนเป็นรหัสผ่าน MySQL
        $dbname = "ชื่อฐานข้อมูล"; // เปลี่ยนเป็นชื่อของฐานข้อมูลที่ต้องการใช้งาน

        // สร้างการเชื่อมต่อ
        $conn = new mysqli($servername, $username, $password, $dbname);

        // ตรวจสอบการเชื่อมต่อ
        if ($conn->connect_error) {
            die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
        }

        // กำหนดค่าที่ต้องการอัปเดต
        $user_id = 12345; // รหัสผู้ใช้ที่ต้องการอัปเดต

        // สร้างคำสั่ง SQL SELECT เพื่อดึงค่า user_status จากฐานข้อมูล
        $sql = "SELECT user_status FROM users WHERE user_id=?";

        // เตรียมคำสั่ง SQL แบบ prepared statement
        $stmt = $conn->prepare($sql);

        // ผูกค่ากับพารามิเตอร์
        $stmt->bind_param("i", $user_id);

        // ประมวลผลคำสั่ง SQL
        if (!$stmt->execute()) {
            die("เกิดข้อผิดพลาดในการประมวลผลคำสั่ง SQL: " . $stmt->error);
        }

        // เก็บผลลัพธ์
        $stmt->bind_result($new_status);

        // ดึงค่าจากผลลัพธ์
        $stmt->fetch();

        // ปิดคำสั่ง prepared statement
        $stmt->close();

        // ปิดการเชื่อมต่อ
        $conn->close();

        // ใช้ค่าที่ดึงมาจากฐานข้อมูลในการแสดงผล
        $status_text = ($new_status == 1) ? "Active" : "Inactive";
    ?>

    <div class="box">
        <div class="text">User Status:</div>
        <div class="score"><?php echo $status_text; ?></div>
        <img src="https://sakolraj.ac.th/wp-content/uploads/2023/08/370503211_870068174821898_4480323347210594771_n.jpg" alt="User Image" class="image">
    </div>
</body>
</html>