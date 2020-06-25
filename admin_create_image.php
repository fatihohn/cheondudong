<!-- 이미지 목록->ajax
    이미지 목록 불러오기

이미지 추가 버튼->ajax
    파일 인풋
    저장 버튼->ajax
        이미지 목록에 추가 -->
    

<?php 
include 'cdd_db_conn.php';   
$URL = "./admin_create_image.php";

// //현재 작성중 장소 id = new_id
// $sqlLatestPlace = "SELECT id FROM places ORDER BY id DESC LIMIT 1";
// $resultLatestPlace = $conn->query($sqlLatestPlace);
// $rowLatestPlace = mysqli_fetch_assoc($resultLatestPlace);
// $latest_id = $rowLatestPlace['id'];
// $new_id = intval(intval($latest_id) + 1);






?>



<div id="create_image_wrap">
    <div id="attached_image_list"></div>
    <div id="create_image">
        <iframe  class="attach_frame" src="admin_attach_image.php"></iframe>
    </div>
    <div>
    <button id="img_attach">이미지 확인</button>
    </div>
</div>

<script src="static/js/admin_attach.js"></script>
<!-- <?php //include "admin_jsGroup.php";?> -->
<!-- <script>
    function tableImgSize() {
        let tableImgAll = document.querySelectorAll(".table_img");
        let ti;
        for(ti=0; ti < tableImgAll.length; ti++) {
            tableImgAll[ti].style.width = "100%";
            tableImgAll[ti].style.maxWidth = "140px";
        }
    }
    tableImgSize();
</script> -->