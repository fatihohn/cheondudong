<!-- 관련작품 목록->ajax
    관련작품 목록 불러오기

관련작품 추가 버튼->ajax
    파일 인풋
    저장 버튼->ajax
        관련작품 목록에 추가 -->
    

    <!-- 이미지 목록->ajax
    이미지 목록 불러오기

이미지 추가 버튼->ajax
    파일 인풋
    저장 버튼->ajax
        이미지 목록에 추가 -->
    

<?php 
include 'cdd_db_conn.php';   
// $URL = "./admin_create_work.php";

// //현재 작성중 장소 id = new_id
// $sqlLatestPlace = "SELECT id FROM places ORDER BY id DESC LIMIT 1";
// $resultLatestPlace = $conn->query($sqlLatestPlace);
// $rowLatestPlace = mysqli_fetch_assoc($resultLatestPlace);
// $latest_id = $rowLatestPlace['id'];
// $new_id = intval(intval($latest_id) + 1);






?>



<div id="create_work_wrap">
    <div id="create_work">
        <iframe  class="attach_frame" src="admin_attach_work.php" style="width:100%; max-width:596px; height:240px;"></iframe>
    </div>
    <div id="work_attach">
        관련작품 새로고침
    </div>

    <div id="attached_work_list"></div>
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