<?php
        include 'cdd_db_conn.php';   

        // $id = $_POST['username'];
        $q = intval($_GET['id']);
        $query0 = "SELECT * FROM intro WHERE id= $q";
        // $query0 = "SELECT id, username, created, title, img0, img0_dir, addressinfo, contact, img1, img1_dir, autoparking, img2, img2_dir, publictrans, extmaplink FROM visit WHERE id= $q";
        $result0 = $conn->query($query0);
        $rows = mysqli_fetch_assoc($result0);

        $query1 = "DELETE FROM intro WHERE id= $q";

        session_start();


        $URL = "./admin_index.php";


        $result = $conn->query($query1);
    
        echo "삭제되었습니다"
        ?> 
        <script>        
                location.replace("<?php echo $URL?>");
        </script>
        <?php          
?>

