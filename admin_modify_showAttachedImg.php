<?php

include 'cdd_db_conn.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();



$q = intval($_GET['q']);

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
                // //현재 작성중 장소 id = new_id
                // $sqlLatestPlace = "SELECT id FROM places ORDER BY id DESC LIMIT 1";
                // $resultLatestPlace = $conn->query($sqlLatestPlace);
                // $rowLatestPlace = mysqli_fetch_assoc($resultLatestPlace);
                // $latest_id = $rowLatestPlace['id'];
                // $new_id = intval(intval($latest_id) + 1);
                //추가한 이미지 목록
                $sqlImgList = "SELECT * FROM images WHERE place_id = $q";
            } else {
                $sqlImgList = null;
            }



$resultImgList = $conn->query($sqlImgList) or die($conn->error);




if ($resultImgList->num_rows > 0) {
    // <th>파일명</th> 
    // <th>장소 번호</th>
    echo "
<table id='attached_img_table' style='width:100%; max-width:596px;'>
    <tbody>
        <tr>
            <th style='width:140px;'>이미지</th> 
            <th>제목</th> 
            <th>내용</th>
            <th style='width:35px' >삭제</th>
        
        </tr>";
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



// <td class='".$img_id."'>".$img_filename."</td>
// <td class='".$img_id."'>".$new_id."</td>    
echo
        "<tr id='".$img_id."' >
            <td style='width:140px;' class='".$img_id."'><img class='table_img' src='".$img_dir."' alt='".$img_ko_title."' style='width:100%; max-width:140px;'></td>
            <td class='".$img_id."'>".$img_ko_title."<br>".$img_en_title."</td>
            <td class='".$img_id."'>".$img_ko_cont."<br>".$img_en_cont."</td>
            <td  style='width:35px' class='".$img_id."'>
                <button class='del_btn' name='".$img_id."' onclick='imgDel(this.name)'>
                    삭제
                </button>
            </td>
        </tr>
                ";
                
            }
echo "
    </tbody>
</table>
        
        ";
} else {
    echo "이미지가 없습니다.";
}
$conn->close();
?>



<script>
    // function tableImgSize() {
    //     let tableImgAll = document.querySelectorAll(".table_img");
    //     if(tableImgAll) {
    //         let ti;
    //         for(ti=0; ti < tableImgAll.length; ti++) {
    //             tableImgAll[ti].style.width = "100%";
    //             tableImgAll[ti].style.maxWidth = "140px";
    //         }
    //     }
    // }
    // tableImgSize();

//     function imgDel(str) {
//     let delConfirm = confirm('삭제 후 복원이 불가능합니다. 삭제하시겠습니까?');
//     if (delConfirm == true) {
//         location.href = './admin_delete_image.php?id=' + str;
//         alert('삭제중입니다')
//     } else {
//         alert('취소되었습니다');
//     }
// }
</script>
<!-- <script src="imgList.js"></script> -->
<!-- <script src="sortTable.js"></script> -->
<!-- <td id='{$row["id"]}' class='{$row["id"]}' onclick = 'imgList(this.id)'>{$row['title']}</td> -->