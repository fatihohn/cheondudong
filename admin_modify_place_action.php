<?php

include 'cdd_db_conn.php';



$q = intval($_POST['id']); 
$username = $_POST['username'];
$username = mysqli_real_escape_string($conn, $username);
// $mkimg = $_POST['mkimg'];
// $mkimg = mysqli_real_escape_string($conn, $mkimg);
// $mkimg_dir = $_POST['mkimg_dir'];
// $mkimg_dir = mysqli_real_escape_string($conn, $mkimg_dir);
$mkimg_size = $_POST['mkimg_size'];
$mkimg_size = mysqli_real_escape_string($conn, $mkimg_size);
$ko_title = $_POST['ko_title'];
$ko_title = mysqli_real_escape_string($conn, $ko_title);
$en_title = $_POST['en_title'];
$en_title = mysqli_real_escape_string($conn, $en_title);
$ko_cont = $_POST['ir1_ko'];
$ko_cont = mysqli_real_escape_string($conn, $ko_cont);
$en_cont = $_POST['ir1_en'];
$en_cont = mysqli_real_escape_string($conn, $en_cont);

$uploadimg = include "admin_modify_place_files.php";
$mkimg = $uploadimg['img'];





        $sql = 
                "UPDATE contents SET 
                `author`='$author', 
                `username`='$username', 
                `category`='$category', 
                `sess`='$sess', 
                `zin`='$zin', 
                `title`='$title', 
                `content`='$content', 
                `display`='$display', 
                `memo`='$memo'
                WHERE `id`='$q'";
//         $sql = 
//                 "UPDATE contents SET 
//                 `author` = ?, 
//                 `username` = ?, 
//                 `category` = ?, 
//                 `sess` = ?, 
//                 `zin` = ?, 
//                 `title` = ?, 
//                 `content` = ?, 
//                 `display` = ?, 
//                 `memo` = ?
//                 WHERE `id` = ?";

// $stmt = mysqli_stmt_init($conn);
//         if (!mysqli_stmt_prepare($stmt, $sql)) {
//                 echo "sql error";
//         } else {
//                 mysqli_stmt_bind_param($stmt, "sssssssssi", $author, $username, $category, $sess, $zin, $title, $content, $display, $memo, $q);
//                 // mysqli_stmt_execute($stmt);
//                 // $result = mysqli_stmt_get_result($stmt);
//                 if(!mysqli_stmt_execute($stmt)){
//                 // if($result === false){
//                     echo '게시물 저장실패. 관리자에게 문의해주세요';
//                     error_log(mysqli_error($conn));
//                 }
//                 else{
//                     echo("<script>alert('게시물이 수정되었습니다.');location.href='admin_contList.php';</script>");
//                 }
//                 // mysqli_stmt_close();
//             }


$result = mysqli_query($conn, $sql);
// $result = $conn->query($sql);


   
    if($result){
        echo("<script>alert('게시물이 수정되었습니다.');location.href='admin_contList.php';</script>");
    }
    else{
        echo '게시물 저장실패. 관리자에게 문의해주세요';
        error_log(mysqli_error($conn));
    }




?>