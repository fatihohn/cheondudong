<?php

include 'cdd_db_conn.php';



$q = intval($_POST['id']); 
$place_id = intval($_POST['place_id']); 

$username = $_POST['username'];
$username = mysqli_real_escape_string($conn, $username);

$category = $_POST['category'];
$category = mysqli_real_escape_string($conn, $category);

$mkimg_size = $_POST['mkimg_size'];
$mkimg_size = mysqli_real_escape_string($conn, $mkimg_size);

$ko_title = $_POST['ko_title'];
$ko_title = mysqli_real_escape_string($conn, $ko_title);

$en_title = $_POST['en_title'];
$en_title = mysqli_real_escape_string($conn, $en_title);

$ko_sub_title = $_POST['ko_sub_title'];
$ko_sub_title = mysqli_real_escape_string($conn, $ko_sub_title);

$en_sub_title = $_POST['en_sub_title'];
$en_sub_title = mysqli_real_escape_string($conn, $en_sub_title);

$ko_memo = $_POST['ko_memo'];
$ko_memo = mysqli_real_escape_string($conn, $ko_memo);

$en_memo = $_POST['en_memo'];
$en_memo = mysqli_real_escape_string($conn, $en_memo);

$ko_address = $_POST['ko_address'];
$ko_address = mysqli_real_escape_string($conn, $ko_address);

$en_address = $_POST['en_address'];
$en_address = mysqli_real_escape_string($conn, $en_address);

$lng = $_POST['lng'];
$lng = mysqli_real_escape_string($conn, $lng);

$lat = $_POST['lat'];
$lat = mysqli_real_escape_string($conn, $lat);

$ko_cont = $_POST['ir1_ko'];
$ko_cont = mysqli_real_escape_string($conn, $ko_cont);

$en_cont = $_POST['ir1_en'];
$en_cont = mysqli_real_escape_string($conn, $en_cont);




$uploadimg = include "admin_modify_place_files.php";
$mkimg = $uploadimg['img'];



        
$sql = 
"UPDATE places SET 
        `username`='$username', 
        `mkimg_size`='$mkimg_size', 
        `category`='$category', 
        `ko_title`='$ko_title', 
        `en_title`='$en_title', 
        `ko_sub_title`='$ko_sub_title', 
        `en_sub_title`='$en_sub_title', 
        `ko_memo`='$ko_memo', 
        `en_memo`='$en_memo', 
        `ko_address`='$ko_address', 
        `en_address`='$en_address', 
        `mkimg`='{$mkimg}$filename',
        `mkimg_dir`='{$mkimg}$target_file',
        `lng`='$lng', 
        `lat`='$lat', 
        `ko_cont`='$ko_cont',
        `en_cont`='$en_cont'
        WHERE `id`='$q'";




if($_FILES['img']['size']!==0) {

        $sql0 = 
        "UPDATE places SET 
        `username`='$username', 
        `category`='$category', 
        `mkimg_size`='$mkimg_size', 
        `ko_title`='$ko_title', 
        `en_title`='$en_title', 
        `ko_sub_title`='$ko_sub_title', 
        `en_sub_title`='$en_sub_title', 
        `ko_memo`='$ko_memo', 
        `en_memo`='$en_memo', 
        `ko_address`='$ko_address', 
        `en_address`='$en_address', 
        `mkimg`='{$mkimg}$filename',
        `mkimg_dir`='{$mkimg}$target_file',
        `lng`='$lng', 
        `lat`='$lat', 
        `ko_cont`='$ko_cont',
        `en_cont`='$en_cont'
        WHERE `id`='$q'";
        $sql = $sql0;
        echo "<br>sql0";

} else  {
        $sql1 = 
        "UPDATE places SET 
        `username`='$username', 
        `category`='$category', 
        `mkimg_size`='$mkimg_size', 
        `ko_title`='$ko_title', 
        `en_title`='$en_title', 
        `ko_sub_title`='$ko_sub_title', 
        `en_sub_title`='$en_sub_title', 
        `ko_memo`='$ko_memo', 
        `en_memo`='$en_memo', 
        `ko_address`='$ko_address', 
        `en_address`='$en_address', 
        `lng`='$lng', 
        `lat`='$lat', 
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
    echo("<script>alert('장소가 수정되었습니다.');location.href='admin_index.php';</script>");
} else {
    echo '장소 저장실패. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
}





?>