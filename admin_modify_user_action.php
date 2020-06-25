<?php
    include 'cdd_db_conn.php';
    
    function getSalt() {
        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        // $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/\][{};:?.>,<!@#$%^&*()-_=+|';
        $randStringLen = 64;
    
        $randString = "";
        for ($i = 0; $i < $randStringLen; $i++) {
            $randString .= $charset[mt_rand(0, strlen($charset) - 1)];
        }
    
        return $randString;
    }
    
    
    $q = intval($_POST['id']); 
    $realname = $_POST['realname'];
    $username = $_POST['username'];
    $pw_one = $_POST['password'];
    $salt = getSalt();
    $pwSalt = $pw_one.$salt;
    $password = base64_encode(hash('sha512', $pwSalt, true));
    
    $pw_two = $_POST['password_conf'];

    $email = $_POST['email'];
    $cast = $_POST['cast'];

    
    $nameSql = "SELECT * FROM user_data WHERE username='$username'";
    $nameCheck = mysqli_query($conn, $nameSql);
    $nameCheck = $nameCheck->fetch_array();

    $nameFromIdSql = "SELECT * FROM user_data WHERE id=$q";
    $nameFromIdCheck = mysqli_query($conn, $nameFromIdSql);
    $nameFromIdCheck = $nameFromIdCheck->fetch_assoc();
    if($nameCheck >= 1 && $nameFromIdCheck['username'] !== $username){
		echo "<script>alert('아이디가 중복됩니다.'); history.back();</script>";
	}else{
		

        if($pw_one !== $pw_two) {
            echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.back();</script>";

        } else {


                $query = 
                "UPDATE user_data SET 
                `realname`='$realname', 
                `username`='$username', 
                `password`='$password', 
                `salt`='$salt', 
                `email`='$email', 
                `cast`='$cast'
                WHERE `id`=$q";
            
                if(strlen($pw_one) > 0 && strlen($pw_two) > 0 && strlen($realname) > 0) {
                $query0 = 
                "UPDATE user_data SET 
                `realname`='$realname', 
                `username`='$username', 
                `password`='$password', 
                `salt`='$salt', 
                `email`='$email', 
                `cast`='$cast'
                WHERE `id`=$q";
                $query = $query0;
                echo "<br>query0";
            } else if(strlen($pw_one) == 0 && strlen($pw_two) == 0 && strlen($realname) > 0) {
                $query1 = 
                "UPDATE user_data SET 
                `realname`='$realname', 
                `username`='$username', 
                `email`='$email', 
                `cast`='$cast'
                WHERE `id`=$q";
                $query = $query1;
                echo "<br>query1";
            }  else if(strlen($pw_one) > 0 && strlen($pw_two) > 0 && strlen($realname) == 0) {
                $query2 = 
                "UPDATE user_data SET 
                `username`='$username', 
                `password`='$password', 
                `salt`='$salt',
                `email`='$email', 
                `cast`='$cast'
                WHERE `id`=$q";
                $query = $query2;
                echo "<br>query2";
            } else if(strlen($pw_one) == 0 && strlen($pw_two) == 0 && strlen($realname) == 0) {
                $query3 = 
                "UPDATE user_data SET 
                
                `username`='$username', 
                `email`='$email', 
                `cast`='$cast'
                WHERE `id`=$q";
                $query = $query3;
                echo "<br>query3";
            }
        }
    }






$result = $conn->query($query);

    if($result) {
?>
        <script>
            alert("수정되었습니다.");
            location.replace("./admin_userList.php");
        </script>
<?php    }
    else {
        echo "fail";
        echo("Error description: " . mysqli_error($conn));
    }
?>