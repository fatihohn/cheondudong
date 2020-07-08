<?php

include 'cdd_db_conn.php';



$q = intval($_POST['id']); 
$place_id = intval($_POST['place_id']); 

$ko_title = $_POST['ko_title'];
$ko_title = mysqli_real_escape_string($conn, $ko_title);

$en_title = $_POST['en_title'];
$en_title = mysqli_real_escape_string($conn, $en_title);

$ko_cont = $_POST['ko_work_cont'];
$ko_cont = mysqli_real_escape_string($conn, $ko_cont);

$en_cont = $_POST['en_work_cont'];
$en_cont = mysqli_real_escape_string($conn, $en_cont);





        
$sql = 
"UPDATE works SET 
        `ko_title`='$ko_title', 
        `en_title`='$en_title', 
        `ko_cont`='$ko_cont',
        `en_cont`='$en_cont'
        WHERE `id`='$q'";




$result = mysqli_query($conn, $sql);
// if ($category !== $category_original) {
//     $resultUpdateCat = mysqli_query($conn, $updateCatSql);
// }


// $result = $conn->query($sql);



if($result){
    echo("<script>alert('관련작품이 수정되었습니다.'); setTimeout(function(){window.close();}, 1000);</script>");
} else {
    echo '관련작품 저장실패. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
}





?>