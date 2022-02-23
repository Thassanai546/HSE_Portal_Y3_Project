<?php
include("connection.php");
function check_login($conn){
    if(isset($_SESSION['user_id'])){
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = '$id' limit 1";
        $result = mysqli_query($conn,$query);
        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    //redirect to login
    header("Location: login.php");
    die;
}

function random_num($length){
    // session management
    // this is 'user_id' in the database
    $text = "";
    if($length < 5) {
        $length = 5;
    }
    $len = rand(4,$length);

    for($i=0;$i<$len;$i++){
        $text .= rand(0,9);
    }
    return $text;
}
function hash_this($value){
    $hash = password_hash($value, PASSWORD_DEFAULT);
    return bin2hex($hash);
}
?>