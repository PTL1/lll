<?php include ('login_code.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Anuphan:wght@100..700&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans+Thai:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Tauri&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> เข้าสู่ระบบ </title>
    <Link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class = "big_box">
        <div class = "main_box">
            <p class = "head" >Login</p>


            <form action="login_code.php" method = "post">
                <span class = "text">ชื่อ-นามสกุล - จริง</span>
                <br>

                <input type="text" name = "username" class = "name"     placeholder = "ชื่อ"> 

                <br>
                <span class = "text">รหัสผ่าน - กรอกเป็นรหัสนักเรียน</span>
                <br>

                <input type="text" name = "password" class = "password" placeholder = "รหัสผ่าน">
                
                <br>
                <button class = "button" name="login_user" type = "submit">เข้าสู่ระบบ</button>
            </form>


        </div>
    </div>
    
    
</body>
</html>
