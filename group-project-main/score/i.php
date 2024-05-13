<!DOCTYPE html>
<html>
<head>
    <title>คำนวณปันผลจากค่าหุ้นและเงินเฉลี่ยคืนต่อปี</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .reset-btn {
            width: 100%;
            padding: 10px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .reset-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>คำนวณปันผลจากค่าหุ้นและเงินเฉลี่ยคืนต่อปี</h2>
        <h2>สมมุติค่า อัตราดอกเบี้ย 5.6 (%):</h2>
        <p>ตัวอย่าง การคิด เงินปันผลหมายถึงเงินที่สมาชิกได้รับเป็นผลตอบแทนจากการที่สมาชิกมีหุ้นอยู่ในสหกรณ์</p>
        <p>ตัวอย่าง: หากสมาชิกส่งค่าหุ้นเดือนละ 1,000 บาท ณ สิ้นเดือนสิงหาคม 64 และมีทุนเรือนหุ้นรวมทั้งหมด 100,000 บาท</p>
        <p>เงินปันผลปี 64 ได้เท่าไร (อัตราเงินปันผลปี 64 เท่ากับ 5.6%)</p>
        <p>หมายเหตุ: การซื้อหุ้นภายในวันที่ 5 ของเดือนนั้น จะคิดปันผลให้เต็มเดือน ซื้อตั้งแต่วันที่ 6 ของเดือนนั้น จะคิดปันผลให้ในเดือนต่อไป</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="stock_value">ค่าหุ้นยกมาจากปีก่อน:</label>
            <input type="number" id="stock_value" name="stock_value" step="0.01" required><br>

            <label for="interest_rate">อัตราดอกเบี้ย (%):</label>
            <input type="number" id="interest_rate" name="interest_rate" step="0.01" required><br>

            <button type="submit">คำนวณ</button>
            <button type="button" class="reset-btn" onclick="resetForm()">รีเซ็ตค่า</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $stock_value = $_POST["stock_value"];
            $interest_rate = $_POST["interest_rate"];

            // คำนวณปันผลจากค่าหุ้น
            $dividend_from_stock = $stock_value * ($interest_rate / 100);

            // คำนวณปันผลรายเดือน
            $dividend_per_month = [];
            for ($month = 1; $month <= 12; $month++) {
                $stock_per_month = 13 - $month;
                $dividend_per_month[$month] = ($stock_per_month / 12) * $interest_rate;
            }

            // รวมปันผลรายเดือน
            $total_dividend_per_month = array_sum($dividend_per_month);

            // รวมเงินปันผลทั้งหมด
            $total_dividend = $dividend_from_stock + $total_dividend_per_month;

            echo "<h2>ผลลัพธ์</h2>";
            echo "<p>ปันผลจากค่าหุ้น: " . number_format($dividend_from_stock, 2) . " บาท</p>";
            echo "<p>ปันผลรายเดือน:</p>";
            echo "<ul>";
            foreach ($dividend_per_month as $month => $dividend) {
                echo "<li>เดือน " . $month . ": " . number_format($dividend, 2) . " บาท</li>";
            }
            echo "</ul>";
            echo "<p>รวมเงินปันผลทั้งหมด: " . number_format($total_dividend, 2) . " บาท</p>";
        }
        ?>

        <script>
            function resetForm() {
                document.getElementById("stock_value").value = "";
                document.getElementById("interest_rate").value = "";
            }
        </script>
    </div>
</body>
</html>
