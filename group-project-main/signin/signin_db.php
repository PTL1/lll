<?php
session_start();
include('signin_code.php');
$errors = array();
if (isset($_POST['reg_user'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password']);
    if (empty($username)) {
        array_push($errors, "ชื่อผู้ใช้ เป็นสิ่งจำเป็น");
    }
    if (empty($password_1)) {
        array_push($errors, "จำเป็นต้องมีรหัสผ่าน");
    }
    $user_check_query = "SELECT * FROM user WHERE username='$username' and password='$password_1'";
    $query = mysqli_query($conn, $user_check_query);
    $result = mysqli_fetch_assoc($query);
    if ($result){
        if($result['username'] === $username){
            array_push($errors,"มีชื่อผู้ใช้อยู่แล้ว");
        }
        if($result['password'] === $password_1){
            array_push($errors,"มีรหัสนี้อยู่แล้ว");
        }
    }
    if (count($errors) == 0){
        $password = md5($password_1);
        $Sql = "INSERT INTO user (username, password) VALUES ('$username','$password')";
        mysqli_query($conn, $Sql);
        $_SESSION['username'] = $username;
        $_SESSION['success'] =  "you are now logged in";
        header('Location: signin.php');
    }
}
?>
