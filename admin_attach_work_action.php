<?php

include 'cdd_db_conn.php';



$place_id = $_POST['place_id'];
$place_id = mysqli_real_escape_string($conn, $place_id);

$ko_title = $_POST['ko_title'];
$ko_title = mysqli_real_escape_string($conn, $ko_title);

$en_title = $_POST['en_title'];
$en_title = mysqli_real_escape_string($conn, $en_title);

$ko_cont = $_POST['ko_cont'];
$ko_cont = mysqli_real_escape_string($conn, $ko_cont);

$en_cont = $_POST['en_cont'];
$en_cont = mysqli_real_escape_string($conn, $en_cont);
                
                
$sql = "
INSERT INTO works
    (place_id, ko_title, en_title, ko_cont, en_cont, created)
VALUES(
    '{$place_id}',
    '{$ko_title}',
    '{$en_title}',
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
                echo("<script>alert('작업이 추가되었습니다.');location.href='admin_attach_image.php';</script>");
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