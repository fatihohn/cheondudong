<!DOCTYPE html>
<html>

<head>
<?php include 'admin_head.php'; ?>

</head>

<body>
 
        
 
<section>
    
    <!-- <div id="create_img_wrap"> -->
    <div class="attach_box">
        <center>
            <h3>관련작품 수정</h3>
        </center>
        <?php    
        include 'cdd_db_conn.php'; 
        session_start();
        // $URL = "./admin_attach_image.php";


        $q = intval($_GET['id']);
        // $place_id = $q;

        // $uname = $_SESSION['username'];
        // $query = "SELECT * FROM user_data WHERE username= '$uname'";
        // $result = $conn->query($query);
        // $rows = mysqli_fetch_assoc($result);

        // $username = $rows['username'];           

        // $adminCast = "admin";
        // $editorCast = "editor";

        $query = "SELECT * FROM works WHERE id=$q";
        $result = $conn->query($query);
        $rows = mysqli_fetch_assoc($result);

        $place_id = $rows['place_id'];

        $ko_title = $rows['ko_title'];
        $en_title = $rows['en_title'];

        $ko_cont = $rows['ko_cont'];
        $en_cont = $rows['en_cont'];



?>
            <form class="createForm" action="admin_modify_attached_image_action.php" method="POST" enctype="multipart/form-data">
                <p>
                    <div class="createInput">
                        <input class="createGrid2"  type="hidden" name="place_id" value="<?=$place_id?>" required />       
                    </div>
                </p>
                
                <p>
                    <div class="createInput">
                        <label class="createGrid1">제목</label>
                        <div>
                            <input class="createGrid2" name="ko_title" value="<?=$ko_title?>" required />
                            <input class="createGrid2" name="en_title" value="<?=$en_title?>" required />
                        </div>
                    </div>
                </p>
              
                <p>
                    <div class="createInput">
                        <label class="createGrid1">내용</label>
                        <div class="admin_editor">
                            <textarea name="ko_work_cont" id="work_cont_ko" ><?=$ko_cont?></textarea>
                            <textarea name="en_work_cont" id="work_cont_en"><?=$en_cont?></textarea>
                        </div>
                    </div>
                </p>
                <p>
                <input type="hidden" name="id" value="<?=$q?>">
                    <input id="attach_img" type="submit">
                    <button name="cancel"><a href = "javascript:history.back()">취소</a></button>
                </p>
            </form>
           

        
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
