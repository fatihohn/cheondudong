<?php

include 'cdd_db_conn.php';



$q = intval($_POST['id']); 


$ko_cont = $_POST['ir1_ko'];
$ko_cont = mysqli_real_escape_string($conn, $ko_cont);

$en_cont = $_POST['ir1_en'];
$en_cont = mysqli_real_escape_string($conn, $en_cont);





        
$sql = 
"UPDATE intro SET 
        `username`='$username', 
        `ko_cont`='$ko_cont',
        `en_cont`='$en_cont'
        WHERE `id`='$q'";


$result = mysqli_query($conn, $sql);
// if ($category !== $category_original) {
//     $resultUpdateCat = mysqli_query($conn, $updateCatSql);
// }


// $result = $conn->query($sql);



if($result){
    echo("<script>alert('소개가 수정되었습니다.');location.href='admin_index.php';</script>");
} else {
    echo '소개 저장실패. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
}





?>