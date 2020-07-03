<!DOCTYPE html>
<html>

<head>
<?php include 'admin_head.php'; ?>

</head>

<body>
    <header>
        <?php include 'admin_header.php'; ?>
</header>
        
 
<section>
    <div id="create_intro_wrap">
        <div id="create_intro_area">
            <div class="view_wrap">
                <div class="view_wrap_line">
                    <div class="contEditor">
                        <center>
                            <h3>천두동 소개</h3>
                        </center>
        
                        <?php    
                        include 'cdd_db_conn.php';   
                        $URL = "./admin_index.php";

                        $uname = $_SESSION['username'];
                        $query = "SELECT * FROM user_data WHERE username= '$uname'";
                        $result = $conn->query($query);
                        $rows = mysqli_fetch_assoc($result);

                        $username = $rows['username'];           

                        $adminCast = "admin";
                        $editorCast = "editor";

                        if($_SESSION['cast']!==$adminCast || $_SESSION['cast']!==$editorCast){
                            ?> 
                            <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                            </script>
                            <?php   
                        }

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
                            <form class="createForm" action="admin_create_intro_action.php" method="POST" enctype="multipart/form-data">
                                <p >
                                    <div class="createInput">
                                        <input class="createGrid2"  type="hidden" name="username" value="<?=$username?>" required />       
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                        <label class="createGrid1">내용</label>
                                        <div class="admin_editor">
                                            <textarea name="ir1_ko" id="ir1_ko" ></textarea>
                                        </div>
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                        <label class="createGrid1">Content</label>
                                        <div class="admin_editor">
                                            <textarea name="ir1_en" id="ir1_en" ></textarea>
                                        </div>
                                    </div>
                                </p>
                                <p>
                                    <input type="submit" onclick="submitContents(this);">
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
                </div>
            </div>
        </div>
    </div>
</section>
<footer>
    <?php include 'footer.php'; ?>
</footer>
 

<?php include "admin_jsGroup.php";?>
<?php include "jsGroup.php";?>
<!-- <script type="text/javascript">
    let oEditors = [];
    nhn.husky.EZCreator.createInIFrame({
     oAppRef: oEditors,
     elPlaceHolder: "ir1",
     sSkinURI: "SmartEditor2Skin.html",
     fCreator: "createSEditor2"
    });

    // ‘저장’ 버튼을 누르는 등 저장을 위한 액션을 했을 때 submitContents가 호출된다고 가정한다.
    function submitContents(elClickedObj) {
     // 에디터의 내용이 textarea에 적용된다.
     oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);

     // 에디터의 내용에 대한 값 검증은 이곳에서
     // document.getElementById("ir1").value를 이용해서 처리한다.

     try {
         elClickedObj.form.submit();
     } catch(e) {}
    }

</script> -->
<script type="text/javascript">
    let oEditors = [];
    let oEditors2 = [];
    nhn.husky.EZCreator.createInIFrame({
     oAppRef: oEditors,
     elPlaceHolder: "ir1_ko",
     sSkinURI: "SmartEditor2Skin.html",
     fCreator: "createSEditor2"
    });
    nhn.husky.EZCreator.createInIFrame({
     oAppRef: oEditors2,
     elPlaceHolder: "ir1_en",
     sSkinURI: "SmartEditor2Skin.html",
     fCreator: "createSEditor2"
    });

    // ‘저장’ 버튼을 누르는 등 저장을 위한 액션을 했을 때 submitContents가 호출된다고 가정한다.
    function submitContents(elClickedObj) {
     // 에디터의 내용이 textarea에 적용된다.
     oEditors.getById["ir1_ko"].exec("UPDATE_CONTENTS_FIELD", []);
     oEditors2.getById["ir1_en"].exec("UPDATE_CONTENTS_FIELD", []);

     // 에디터의 내용에 대한 값 검증은 이곳에서
     // document.getElementById("ir1").value를 이용해서 처리한다.

     try {
         elClickedObj.form.submit();
     } catch(e) {}
    }

</script>
</body>

</html>
