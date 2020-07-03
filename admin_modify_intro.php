<!DOCTYPE html>
<html>

<head>
<?php include 'admin_head.php'; ?>

</head>

<body>
    <header>
        <?php include "admin_header.php"; ?>
    </header>


<section>
     <!-- menu: 메뉴 내비 바 -->
     <?php include "admin_menu.php"; ?>

    <div id="create_wrap">
        <div id="create_area">
            <div class="view_wrap">
                <div class="view_wrap_line">
                    <div class="contEditor">
                        <center>
                            <h3>소개 수정</h3>
                        </center>

<?php    
           include 'cdd_db_conn.php';   
           
           
           $URL = "./admin_index.php";

                // $authorSql = "SELECT * FROM user_data WHERE `cast` != 'normal'";
                // $resultAuthor = $conn->query($authorSql);

                $q = intval($_GET['id']);
                $query = "SELECT * FROM intro WHERE id= $q";
                $result = $conn->query($query);
                $rows = mysqli_fetch_assoc($result);
                // $author = $rows['author'];
                // $place_id = $rows['place_id'];
                // $username = $rows['username'];
                // $mkimg = $rows['mkimg'];
                // $mkimg_dir = $rows['mkimg_dir'];
                // $mkimg_size = $rows['mkimg_size'];
                // $ko_title = $rows['ko_title'];
                // $en_title = $rows['en_title'];
                // $ko_address = $rows['ko_address'];
                // $en_address = $rows['en_address'];
                // $lat = $rows['lat'];
                // $lng = $rows['lng'];
                $ko_cont = $rows['ko_cont'];
                $en_cont = $rows['en_cont'];

                $adminCast = "admin";


                session_start();
 
 
 
                if(!isset($_SESSION['username'])) {
        ?>              <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                        </script>
        <?php   }
                //cast: admin||editor인 경우 || 작가 본인
                else if($_SESSION['cast']==$adminCast) {
        ?>

        <form class="createForm" action="admin_modify_place_action.php" method="POST" enctype="multipart/form-data">
            <p >
                <div class="createInput">
                    <input class="createGrid2"  type="hidden" name="username" value="<?=$username?>" required />       
                </div>
            </p>
            <p>
                <div class="createInput">
                    <label class="createGrid1">내용</label>
                    <div class="admin_editor">
                        <textarea name="ir1_ko" id="ir1_ko" ><?=$ko_cont?></textarea>
                    </div>
                </div>
            </p>
            <p>
                <div class="createInput">
                    <label class="createGrid1">Content</label>
                    <div class="admin_editor">
                        <textarea name="ir1_en" id="ir1_en" ><?=$en_cont?></textarea>
                    </div>
                </div>
            </p>
                                
            <p>
                <input type="hidden" name="id" value="<?=$q?>">
                <div class="submit_box">
                    <input type="submit" onclick="submitContents(this);">
                    <button name="cancel"><a href = "javascript:history.back()">취소</a></button>
                </div>
            </p>
        </form>
        
        



        <?php   } else {
                ?>

                        <script>
                                alert("권한이 없습니다.");
                                // location.replace("<?php echo $URL?>");
                                history.back();
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
        <?php include 'admin_footer.php'; ?>

    </footer>
    
    <?php include "admin_jsGroup.php";?>

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

</div>

</body>

</html>