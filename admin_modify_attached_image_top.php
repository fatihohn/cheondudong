<?php

include 'cdd_db_conn.php';

$q = intval($_GET['id']); 
$sqlPlaceId = "SELECT place_id FROM images WHERE id = $q";
$resultPlaceId = mysqli_query($conn, $sqlPlaceId);
$rowPlaceId = $resultPlaceId->fetch_assoc();
$placeId = $rowPlaceId['place_id'];
        
        
        $sql = 
        "UPDATE images SET 
                `created`=NOW()
                WHERE `id`='$q'";


$result = mysqli_query($conn, $sql);

if($result){
                echo("<script>alert('이미지 순서가 수정되었습니다.');location.href='admin_detail.php?id='+".$placeId.";</script>");
            } else {
                echo '이미지 저장실패. 관리자에게 문의해주세요';
                error_log(mysqli_error($conn));
            }

    



?>