<!DOCTYPE html>
<html>

<head>
<?php include 'admin_head.php'; ?>

</head>

<body>
 
        
 
<section>
    
    <div id="create_img_wrap">
        <center>
            <h3>장소 추가</h3>
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

        if($_SESSION['cast']!==$adminCast){
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
        } else if($_SESSION['cast']==$adminCast) {
            //cast: admin인 경우
            ?>
            <form class="createForm" action="admin_attach_image_action.php" method="POST" enctype="multipart/form-data">
                <p>
                    <div class="createInput">
                        <input class="createGrid2"  type="hidden" name="username" value="<?=$username?>" required />       
                    </div>
                </p>
                <p>
                    <div class="createInput">
                    <label class="createGrid1">이미지</label>
                    <input class="createGrid2" type="file" name="img"  required />
                    </div>
                </p>
                <p>
                    <div class="createInput">
                    <label class="createGrid1">제목</label>
                    <input class="createGrid2" name="ko_title" placeholder="제목" required />
                    </div>
                </p>
                <p>
                    <div class="createInput">
                        <label class="createGrid1">Title</label>
                        <input class="createGrid2" name="en_title" placeholder="Title" required />
                    </div>
                </p>
                <p>
                    <div class="createInput">
                        <label class="createGrid1">내용</label>
                        <div class="admin_editor">
                            <textarea name="ko_cont" id="ko_cont" ></textarea>
                        </div>
                    </div>
                </p>
                <p>
                    <div class="createInput">
                        <label class="createGrid1">Content</label>
                        <div class="admin_editor">
                            <textarea name="en_cont" id="en_cont" ></textarea>
                        </div>
                    </div>
                </p>
                <p>
                    <!-- <input type="submit" onclick="submitContents(this);"> -->
                    <input type="submit">
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

</body>

</html>
