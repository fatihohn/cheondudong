<?php

include 'cdd_db_conn.php';

function getSalt() {
    // $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/\][{};:?.>,<!@#$%^&*()-_=+|';
    $randStringLen = 64;

    $randString = "";
    for ($i = 0; $i < $randStringLen; $i++) {
        $randString .= $charset[mt_rand(0, strlen($charset) - 1)];
    }

    return $randString;
}

$realname = $_POST['realname'];
$realname = mysqli_real_escape_string($conn, $realname);

$username = $_POST['username'];
$username = mysqli_real_escape_string($conn, $username);

$password=$_POST['password'];
$password = mysqli_real_escape_string($conn, $password);
// $salt = getSalt();
$salt = mysqli_real_escape_string($conn, getSalt());
$pwSalt = $password.$salt;
$password = base64_encode(hash('sha512', $pwSalt, true));

$email = $_POST['email'];
$email = mysqli_real_escape_string($conn, $email);

$cast = $_POST['cast'];
$cast = mysqli_real_escape_string($conn, $cast);

$pw_one = $_POST['password'];
$pw_one = mysqli_real_escape_string($conn, $pw_one);

$pw_two = $_POST['password_conf'];
$pw_two = mysqli_real_escape_string($conn, $pw_two);


$nameSql = "SELECT * FROM user_data WHERE username='$username'";
$nameCheck = mysqli_query($conn, $nameSql);
    $nameCheck = $nameCheck->fetch_array();
    if($nameCheck >= 1){
		echo "<script>alert('아이디가 중복됩니다.'); history.back();</script>";
	}else{

            if($pw_one !== $pw_two) {
                echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.back();</script>";

            } else {
                // $sql = "
                //     INSERT INTO user_data
                //         (realname, username, password, salt, email, cast, created)
                //     VALUES(
                //         '{$realname}',
                //         '{$username}',
                //         '{$password}',
                //         '{$salt}',
                //         '{$cast}',
                //         '{$email}',
                        
                //         NOW()
                // )";

        $sql = "
            INSERT INTO `user_data`
                (`realname`, `username`, `password`, `salt`, `email`, `cast`, `created`)
            VALUES(
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                NOW()
            );";

            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "sql error";
            } else {
                    mysqli_stmt_bind_param($stmt, "ssssss", $realname, $username, $password, $salt, $email, $cast);
                    // mysqli_stmt_execute($stmt);
                    // $result = mysqli_stmt_get_result($stmt);
                    if(!mysqli_stmt_execute($stmt)){
                    // if($result === false){
                        echo '저장실패. 관리자에게 문의해주세요';
                        error_log(mysqli_error($conn));
                    }
                    else{
                        echo("<script>alert('회원가입이 완료되었습니다.');location.href='admin_index.php';</script>");
                    }
                    // mysqli_stmt_close();
                }



            }
            
    }
    
// $result = mysqli_query($conn, $sql);
// if($result === false){
//     echo '저장실패. 관리자에게 문의해주세요';
//     error_log(mysqli_error($conn));
// }
// else{
//     echo("<script>alert('회원가입이 완료되었습니다.');location.href='admin_index.php';</script>");
// }
// echo $sql;


?>