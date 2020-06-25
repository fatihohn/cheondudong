<!DOCTYPE html>
<html lang="ko">
<head>
  <?php include "admin_head.php"; ?>
  
</head>
<body>
    <header>
        <?php include "admin_header.php"; ?>
    </header>
        
<section>
<!-- //****기본구성****// -->
    <!-- menu: 메뉴 내비 바 -->
    <?php include "admin_menu.php"; ?>

    <!-- detail: 랜드마크 세부 정보 보여줌 (이름, 위치, 설명, 사진, 참고자료, 관련 작업 등 -- 관리자페이지에서 스마트에디터로 편집 가능) -->
    <?php //include "admin_detail.php"; ?>

    <!-- map: 지도와 랜드마크 보여줌. 클릭/터치/드래그 화면 이동, 사용자 위치 표시 버튼, 확대/축소 버튼, 랜드마크 아이콘 표시, 랜드마크 아이콘 클릭하면 detail로 넘어감 -->
    <?php //include "map.php"; ?>
<!-- //****기본구성 끝****// -->


    <div class="userList_wrap">           
    <?php
    include 'cdd_db_conn.php';   
    session_start();
    $URL = "./admin_index.php";
                if(!isset($_SESSION['username'])) {
    ?>              <script>
                            alert("권한이 없습니다.");
                            location.replace("<?php echo $URL?>");
                    </script>

    <?php  
          
            }
            else {
        ?>
        <div>
            <center>
                <h2>사용자 목록</h2>
            </center>
        </div>
        <div id="adCsList">
            <div class="cs_box">
                <button class="view_btn1" onclick="location.href='./admin_create_user.php'">사용자 추가</button>
                <select name="searchSlct" id="searchSlct">
                    <option value="0">번호</option>
                    <option value="1">아이디</option>
                    <option value="2">이메일</option>
                    <option value="3">이름</option>
                    <option value="4">등급</option>
                </select>
                <input type="text" class="searchInput" id="searchInput" onkeyup="searchInput(this.name)" placeholder="검색">
            
            <script>
                function searchSet() {
                    let searchSlct = document.getElementById("searchSlct").value;
                    let searchInpt = document.getElementById("searchInput");
                    searchInpt.setAttribute("name", searchSlct);
                }
                document.getElementById("searchSlct").addEventListener("change", searchSet);
            </script>  
        </div>
        <div id="includeTable">
            <table class="cs_table sortTable user_table">
                <?php include 'admin_userSelect.php'; ?>
            </table>
        </div>
        <div id="tableBox"></div>
            <?php
        }
        ?>
    </div>
</section>
<footer id="bbdd_ft">
    <?php include "footer.php";?>
</footer>
    <script>
        function userListInit() {
            let headerWrap = document.getElementById("header_wrap");
            // let detailWrap = document.getElementById("detail_wrap");
            let mapWrap = document.getElementById("map_wrap");
            let menuWrap = document.getElementById("menu_wrap");
            let footerWrap = document.getElementById("footer_wrap");

            menuWrap.style.display = "none";
            headerWrap.style.display = "initial";
            // detailWrap.style.display = "none";
            // mapWrap.style.visibility = "hidden";
            footerWrap.style.display = "initial";
        }
        userListInit();
    </script>
<?php include "jsGroup.php"; ?>
<?php include "admin_jsGroup.php"; ?>

</body>
</html>