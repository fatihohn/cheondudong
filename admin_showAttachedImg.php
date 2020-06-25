<?php

include 'cdd_db_conn.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

$adminCast = "admin";

$uname = $_SESSION['username'];



$URL = "./admin_index.php";
if(!isset($_SESSION['username'])) {
    ?>              <script>
                            // alert("권한이 없습니다.");
                            location.replace("<?php echo $URL?>");
                    </script>
    <?php   }
            //cast: admin인 경우
            else if($_SESSION['cast']==$adminCast) {
                //현재 작성중 장소 id = new_id
                $sqlLatestPlace = "SELECT id FROM places ORDER BY id DESC LIMIT 1";
                $resultLatestPlace = $conn->query($sqlLatestPlace);
                $rowLatestPlace = mysqli_fetch_assoc($resultLatestPlace);
                $latest_id = $rowLatestPlace['id'];
                $new_id = intval(intval($latest_id) + 1);
                //추가한 이미지 목록
                $sqlImgList = "SELECT * FROM images WHERE place_id = $new_id";
            } else {
                $sqlImgList = null;
            }



$resultImgList = $conn->query($sqlImgList) or die($conn->error);


echo "
<table id='attached_img_table'>
<tbody>
<tr>
    <th>장소 번호</th>
    <th>파일명</th> 
    <th>이미지</th> 
    <th>제목</th> 
    <th>내용</th>
</tr>";


if ($resultImgList->num_rows > 0) {
    // output data of each row
    while($row = $resultImgList->fetch_assoc()) {
           $img_id = $row["id"];
           $img_filename = $row["img"];
           $img_dir = $row["img_dir"];
           $img_ko_title = $row["ko_title"];
           $img_en_title = $row["en_title"];
           $img_ko_cont = $row["ko_cont"];
           $img_en_cont = $row["en_cont"];
// echo
//         "<tr id='{$row["id"]}' >
//             <td class='{$row["id"]}'>{$row['id']}</td>    
//             <td class='{$row["id"]}'>{$row['username']}</td>
//             <td class='{$row["id"]}'>{$row['email']}</td>
//             <td class='{$row["id"]}'>{$row['realname']}</td>
//             <td class='{$row["id"]}'>{$row['cast']}</td>";
echo
        "<tr id='".$img_id."' >
            <td class='".$img_id."'>".$new_id."</td>    
            <td class='".$img_id."'>".$img_filename."</td>
            <td class='".$img_id."'><img src='".$img_dir."' alt='".$img_ko_title."'></td>
            <td class='".$img_id."'>".$img_ko_title."<br>".$img_en_title."</td>
            <td class='".$img_id."'>".$img_ko_cont."<br>".$img_en_cont."</td>
            </tbody>
            </table>
            ";
        
    }
} else {
    echo "0 results";
}
$conn->close();
?>
<!-- <script src="imgList.js"></script> -->
<!-- <script src="sortTable.js"></script> -->
<!-- <td id='{$row["id"]}' class='{$row["id"]}' onclick = 'imgList(this.id)'>{$row['title']}</td> -->