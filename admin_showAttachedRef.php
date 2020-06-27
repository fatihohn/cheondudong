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
                $sqlRefList = "SELECT * FROM refs WHERE place_id = $new_id";
            } else {
                $sqlRefList = null;
            }



$resultRefList = $conn->query($sqlRefList) or die($conn->error);




if ($resultRefList->num_rows > 0) {
    // <th>파일명</th> 
    // <th>장소 번호</th>
    echo "
<table id='attached_ref_table' style='width:100%; max-width:596px;'>
    <tbody>
        <tr>
            <th>제목</th> 
            <th>링크</th>
            <th style='width:35px' >삭제</th>
        
        </tr>";
    // output data of each row
    while($row = $resultrefList->fetch_assoc()) {
           $ref_id = $row["id"];
           $ref_ko_title = $row["ko_title"];
           $ref_en_title = $row["en_title"];
           $ref_link = $row["link"];
  
        //    <td class='".$ref_id."'>".$ref_link."</td>
           echo
           "<tr id='".$ref_id."' >
           <td class='".$ref_id."'>".$ref_ko_title."<br>".$ref_en_title."</td>
          <td class='".$ref_id."'><a href='".$ref_link."'>".$ref_link."</a></td>
        <td  style='width:35px' class='".$ref_id."'>
                <button class='del_btn' name='".$ref_id."' onclick='refDel(this.name)'>
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
    echo "참고자료가 없습니다.";
}
$conn->close();
?>
