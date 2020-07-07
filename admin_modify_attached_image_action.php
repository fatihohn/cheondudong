<?php

include 'cdd_db_conn.php';



$q = intval($_POST['id']); 
$place_id = intval($_POST['place_id']); 

$ko_title = $_POST['ko_title'];
$ko_title = mysqli_real_escape_string($conn, $ko_title);

$en_title = $_POST['en_title'];
$en_title = mysqli_real_escape_string($conn, $en_title);

$ko_cont = $_POST['ko_cont'];
$ko_cont = mysqli_real_escape_string($conn, $ko_cont);

$en_cont = $_POST['en_cont'];
$en_cont = mysqli_real_escape_string($conn, $en_cont);




$uploadimg = include "admin_modify_attached_image_files.php";
$img = $uploadimg['img'];



        
$sql = 
"UPDATE iamges SET 
        
        `ko_title`='$ko_title', 
        `en_title`='$en_title', 
        `img`='{$img}$filename',
        `img_dir`='{$img}$target_file',
        `ko_cont`='$ko_cont',
        `en_cont`='$en_cont'
        WHERE `id`='$q'";




if($_FILES['img']['size']!==0) {

        $sql0 = 
        "UPDATE images SET 
        `ko_title`='$ko_title', 
        `en_title`='$en_title', 
        `img`='{$img}$filename',
        `img_dir`='{$img}$target_file',
        `ko_cont`='$ko_cont',
        `en_cont`='$en_cont'
        WHERE `id`='$q'";
        $sql = $sql0;
        echo "<br>sql0";

} else  {
        $sql1 = 
        "UPDATE images SET 
        `ko_title`='$ko_title', 
        `en_title`='$en_title', 
        `ko_cont`='$ko_cont',
        `en_cont`='$en_cont'
        WHERE `id`='$q'";
        $sql = $sql1;
        echo "<br>sql1";

}

$result = mysqli_query($conn, $sql);
// if ($category !== $category_original) {
//     $resultUpdateCat = mysqli_query($conn, $updateCatSql);
// }


// $result = $conn->query($sql);



if($result){
    echo("<script>alert('이미지가 수정되었습니다.'); location.replace('admin_modify_attached_image.php?id='+".$q.");</script>");
} else {
    echo '이미지 저장실패. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
}





?>