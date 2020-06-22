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
    
    <?php include "jsGroup.php"; ?>
    <?php include "admin_jsGroup.php"; ?>

</body>
</html>