<!DOCTYPE html>
<html>

<head>
<?php include 'admin_head.php'; ?>

</head>

<body>
 
        
 
<section>
    
    <!-- <div id="create_work_wrap"> -->
    <div class="attach_box">
        <center>
            <h3>관련작품 추가</h3>
        </center>
        <?php    
        include 'cdd_db_conn.php';   
        $URL = "./admin_attach_work.php";

        $uname = $_SESSION['username'];
        $query = "SELECT * FROM user_data WHERE username= '$uname'";
        $result = $conn->query($query);
        $rows = mysqli_fetch_assoc($result);

        $username = $rows['username'];           

        $adminCast = "admin";
        $editorCast = "editor";

        //현재 작성중 장소 id = new_id
        // $sqlLatestPlace = "SELECT id FROM places ORDER BY id DESC LIMIT 1";
        $sqlLatestPlace = "SELECT place_id FROM places ORDER BY place_id DESC LIMIT 1";
        $resultLatestPlace = $conn->query($sqlLatestPlace);
        $rowLatestPlace = mysqli_fetch_assoc($resultLatestPlace);
        // $latest_id = $rowLatestPlace['id'];
        $latest_id = $rowLatestPlace['place_id'];
        $new_id = intval(intval($latest_id) + 1);
        $place_id = $new_id;

        session_start();



        if(!isset($_SESSION['username'])) {
            ?>              
            <script>
                alert("권한이 없습니다.");
                location.replace("<?php echo $URL?>");
            </script>
            <?php   
        } else if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast) {
            //cast: admin인 경우
            ?>
            <form class="createForm" action="admin_attach_work_action.php" method="POST" enctype="multipart/form-data">
                <p>
                    <div class="createInput">
                        <input class="createGrid2"  type="hidden" name="place_id" value="<?=$place_id?>" required />       
                    </div>
                </p>
                <p>
                    <div class="createInput">
                        <label class="createGrid1">제목</label>
                        <div>
                            <input class="createGrid2" name="ko_title" placeholder="제목" required />
                            <input class="createGrid2" name="en_title" placeholder="Title" required />
                        </div>
                    </div>
                </p>
                <p>
                    <div class="createInput">
                        <label class="createGrid1">내용</label>
                        <div class="admin_editor">
                            <textarea name="ko_work_cont" id="work_cont_ko" ></textarea>
                        </div>
                    </div>
                </p>
                <p>
                    <div class="createInput">
                        <label class="createGrid1">Content</label>
                        <div class="admin_editor">
                            <textarea name="en_work_cont" id="work_cont_en" ></textarea>
                        </div>
                    </div>
                </p>
                <p>
                    <!-- <input type="submit" onclick="submitContents(this);"> -->
                    <input id="attach_work" type="submit" onclick="submitContents(this);">
                    <button name="cancel"><a href = "javascript:history.back()">취소</a></button>
                </p>
            </form>
            <?php
        } else {
            ?>
            <script>
                alert("권한이 없습니다.");
                location.replace("<?php echo $URL?>");
            </script>                 
            <?php
        }               
        ?>
        
    </div>
        
</section>
<script type="text/javascript" src="se2/js/service/HuskyEZCreator.js" charset="utf-8"></script>
<script type="text/javascript">
    let oEditors = [];
    let oEditors2 = [];
    nhn.husky.EZCreator.createInIFrame({
     oAppRef: oEditors,
     elPlaceHolder: "work_cont_ko",
     sSkinURI: "SmartEditor2Skin.html",
     fCreator: "createSEditor2"
    });
    nhn.husky.EZCreator.createInIFrame({
     oAppRef: oEditors2,
     elPlaceHolder: "work_cont_en",
     sSkinURI: "SmartEditor2Skin.html",
     fCreator: "createSEditor2"
    });

    // ‘저장’ 버튼을 누르는 등 저장을 위한 액션을 했을 때 submitContents가 호출된다고 가정한다.
    function submitContents(elClickedObj) {
     // 에디터의 내용이 textarea에 적용된다.
     oEditors.getById["work_cont_ko"].exec("UPDATE_CONTENTS_FIELD", []);
     oEditors2.getById["work_cont_en"].exec("UPDATE_CONTENTS_FIELD", []);

     // 에디터의 내용에 대한 값 검증은 이곳에서
     // document.getElementById("ir1").value를 이용해서 처리한다.

     try {
         elClickedObj.form.submit();
     } catch(e) {}
    }

</script>

</body>

</html>
