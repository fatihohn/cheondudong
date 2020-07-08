<?php

include 'cdd_db_conn.php';

$q = intval($_GET['id']); 

        
        
        $sql = 
        "UPDATE images SET 
                `created`=NOW()
                WHERE `id`='$q'";


$result = mysqli_query($conn, $sql);

if($result){
                echo("<script>alert('이미지 순서가 수정되었습니다.');location.href='admin_detail.php?id='+".$q.";</script>");
            } else {
                echo '이미지 저장실패. 관리자에게 문의해주세요';
                error_log(mysqli_error($conn));
            }

    



?>