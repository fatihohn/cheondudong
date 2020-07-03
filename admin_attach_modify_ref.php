<!DOCTYPE html>
<html>

<head>
<?php include 'admin_head.php'; ?>

</head>

<body>
 
        
 
<section>
    
    <!-- <div id="create_ref_wrap"> -->
    <div class="attach_box">
        <center>
            <h3>참고자료 추가</h3>
        </center>
        <?php    
        include 'cdd_db_conn.php';   
        $URL = "./admin_attach_ref.php";




        $q = intval($_GET['q']);
        $place_id = $q;


        $uname = $_SESSION['username'];
        $query = "SELECT * FROM user_data WHERE username= '$uname'";
        $result = $conn->query($query);
        $rows = mysqli_fetch_assoc($result);

        $username = $rows['username'];           

        $adminCast = "admin";
        $editorCast = "editor";

        // //현재 작성중 장소 id = new_id
        // $sqlLatestPlace = "SELECT id FROM places ORDER BY id DESC LIMIT 1";
        // $resultLatestPlace = $conn->query($sqlLatestPlace);
        // $rowLatestPlace = mysqli_fetch_assoc($resultLatestPlace);
        // $latest_id = $rowLatestPlace['id'];
        // $new_id = intval(intval($latest_id) + 1);
        // $place_id = $new_id;

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
            <form class="createForm" action="admin_attach_ref_action.php" method="POST" enctype="multipart/form-data">
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
                        <label class="createGrid1">링크</label>
                        <div class="admin_editor">
                            <input type="url" name="ref_link" id="ref_link" />
                        </div>
                    </div>
                </p>
                <p>
                    <!-- <input type="submit" onclick="submitContents(this);"> -->
                    <input id="attach_ref" type="submit" >
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
