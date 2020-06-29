<?php

include 'cdd_db_conn.php';

 //현재 작성중 장소 id = new_id
 $sqlLatestPlace = "SELECT id FROM places ORDER BY id DESC LIMIT 1";
 $resultLatestPlace = $conn->query($sqlLatestPlace);
 $rowLatestPlace = mysqli_fetch_assoc($resultLatestPlace);
 $latest_id = $rowLatestPlace['id'];
 $new_id = intval(intval($latest_id) + 1);
 $place_id = $new_id;

$username = $_POST['username'];
$username = mysqli_real_escape_string($conn, $username);

$mkimg_size = $_POST['mkimg_size'];
$mkimg_size = mysqli_real_escape_string($conn, $mkimg_size);

$ko_title = $_POST['ko_title'];
$ko_title = mysqli_real_escape_string($conn, $ko_title);

$en_title = $_POST['en_title'];
$en_title = mysqli_real_escape_string($conn, $en_title);

$ko_address = $_POST['ko_address'];
$ko_address = mysqli_real_escape_string($conn, $ko_address);

$en_address = $_POST['en_address'];
$en_address = mysqli_real_escape_string($conn, $en_address);

$lat = $_POST['lat'];
$lat = mysqli_real_escape_string($conn, $lat);

$lng = $_POST['lng'];
$lng = mysqli_real_escape_string($conn, $lng);


$ko_cont = $_POST['ir1_ko'];
$ko_cont = mysqli_real_escape_string($conn, $ko_cont);

$en_cont = $_POST['ir1_en'];
$en_cont = mysqli_real_escape_string($conn, $en_cont);

$uploadimg = include "admin_create_place_files.php";
$mkimg = $uploadimg['img'];
                
                
$sql = "
INSERT INTO places
        (place_id, username, mkimg, mkimg_dir, mkimg_size, ko_title, en_title, ko_address, en_address, lat, lng, ko_cont, en_cont, created)
    VALUES(
            '{$place_id}',
            '{$username}',
            '{$mkimg}$filename',
            '{$mkimg}$target_file',
            '{$mkimg_size}',
            '{$ko_title}',
            '{$en_title}',
            '{$ko_address}',
            '{$en_address}',
            '{$lat}',
            '{$lng}',
            '{$ko_cont}',
            '{$en_cont}',
            NOW()
            )";
            
            $result = mysqli_query($conn, $sql);
            if($result === false){
                echo '저장실패. 관리자에게 문의해주세요';
                error_log(mysqli_error($conn));
            }
            else{
                echo("<script>alert('장소가 생성되었습니다.');location.href='admin_index.php';</script>");
            }
                    
                    
        //             // $created = mysqli_real_escape_string($conn, NOW());
        //             $sql = "
        //             INSERT INTO `contents`
        //                     (`no`, `author`, `username`, `category`, `sess`, `zin`, `title`, `content`, `display`, `memo`, `created`)
        //                 VALUES(
        //                         ?,
        //                         ?,
        //                         ?,
        //                         ?,
        //                         ?,
        //                         ?,
        //                         ?,
        //                         ?,
        //                         ?,
        //                         ?,
        //                         NOW()
        //                 );";

        // $stmt = mysqli_stmt_init($conn);
        // if (!mysqli_stmt_prepare($stmt, $sql)) {
        //         echo "sql error";
        // } else {
        //         mysqli_stmt_bind_param($stmt, "isssssssss", $no, $author, $username, $category, $sess, $zin, $title, $content, $display, $memo);
        //         // mysqli_stmt_execute($stmt);
        //         // $result = mysqli_stmt_get_result($stmt);
        //         if(!mysqli_stmt_execute($stmt)){
        //         // if($result === false){
        //             echo '저장실패. 관리자에게 문의해주세요';
        //             error_log(mysqli_error($conn));
        //         }
        //         else{
        //             echo("<script>alert('게시물이 생성되었습니다.');location.href='admin_contList.php';</script>");
        //         }
        //         // mysqli_stmt_close();
        //     }
            
            


?>