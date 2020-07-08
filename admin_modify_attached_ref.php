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
            <h3>참고자료 수정</h3>
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

        $query = "SELECT * FROM refs WHERE id=$q";
        $result = $conn->query($query);
        $rows = mysqli_fetch_assoc($result);

        $place_id = $rows['place_id'];

        $ko_title = $rows['ko_title'];
        $en_title = $rows['en_title'];

        $ref_link = $rows['ref_link'];



?>
            <form class="createForm" action="admin_modify_attached_ref_action.php" method="POST" enctype="multipart/form-data">
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
                        <label class="createGrid1">링크</label>
                        <div class="admin_editor">
                            <input type="url" name="ref_link" id="ref_link" value="<?=$ref_link?>" />
                        </div>
                    </div>
                </p>
                <p>
                <input type="hidden" name="id" value="<?=$q?>">
                    <input id="attach_work" type="submit">
                    <button name="cancel"><a href = "javascript:history.back()">취소</a></button>
                </p>
            </form>
           

        
    </div>
        
</section>

</body>

</html>
