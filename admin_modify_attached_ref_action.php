<?php

include 'cdd_db_conn.php';



$q = intval($_POST['id']); 
$place_id = intval($_POST['place_id']); 

$ko_title = $_POST['ko_title'];
$ko_title = mysqli_real_escape_string($conn, $ko_title);

$en_title = $_POST['en_title'];
$en_title = mysqli_real_escape_string($conn, $en_title);

$ref_link = $_POST['ref_link'];
$ref_link = mysqli_real_escape_string($conn, $ref_link);





        
$sql = 
"UPDATE refs SET 
        `ko_title`='$ko_title', 
        `en_title`='$en_title', 
        `ref_link`='$ref_link'
        WHERE `id`='$q'";




$result = mysqli_query($conn, $sql);
// if ($category !== $category_original) {
//     $resultUpdateCat = mysqli_query($conn, $updateCatSql);
// }


// $result = $conn->query($sql);



if($result){
    echo("<script>alert('참고자료가 수정되었습니다.'); setTimeout(function(){window.close();}, 1000);</script>");
} else {
    echo '참고자료 저장실패. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
}





?>