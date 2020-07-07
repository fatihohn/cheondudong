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
            <h3>이미지 수정</h3>
        </center>
        <?php    
        include 'cdd_db_conn.php'; 
        session_start();
        // $URL = "./admin_attach_image.php";


        $q = intval($_GET['q']);
        $place_id = $q;

        // $uname = $_SESSION['username'];
        // $query = "SELECT * FROM user_data WHERE username= '$uname'";
        // $result = $conn->query($query);
        // $rows = mysqli_fetch_assoc($result);

        // $username = $rows['username'];           

        // $adminCast = "admin";
        // $editorCast = "editor";

        $query = "SELECT * FROM images WHERE id=$q";
        $result = $conn->query($query);
        $rows = mysqli_fetch_assoc($result);

        $place_id = $rows['place_id'];

        $ko_title = $rows['ko_title'];
        $en_title = $rows['en_title'];

        $ko_cont = $rows['ko_cont'];
        $en_cont = $rows['en_cont'];

        $img = $rows['img'];
        $img_dir = $rows['img_dir'];



?>
            <form class="createForm" action="admin_modify_attached_image_action.php" method="POST" enctype="multipart/form-data">
                <p>
                    <div class="createInput">
                        <input class="createGrid2"  type="hidden" name="place_id" value="<?=$place_id?>" required />       
                    </div>
                </p>
                <p>
                    <div class="createInput">
                    <label class="createGrid1">이미지</label>
                    <input class="createGrid2" type="file" name="img" />
                    <?=$img?>
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
                            <textarea name="ko_cont" id="ko_cont" ><?=$ko_cont?></textarea>
                            <textarea name="en_cont" id="en_cont"><?=$ko_cont?></textarea>
                        </div>
                    </div>
                </p>
                <p>
                    <input id="attach_img" type="submit">
                    <button name="cancel"><a href = "javascript:history.back()">취소</a></button>
                </p>
            </form>
           

        
    </div>
        
</section>

</body>

</html>
