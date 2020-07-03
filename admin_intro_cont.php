<?php 
session_start();
include "cdd_db_conn.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sqlIntro = "SELECT * FROM intro ORDER BY id DESC LIMIT 1";
$resultIntro = $conn->query($sqlIntro) or die($conn->error);

if($resultIntro->num_rows > 0) {
   $rowIntro = $resultIntro->fetch_assoc();
   
   $ko_cont =  $rowIntro['ko_cont'];
   $en_cont =  $rowIntro['en_cont'];
   $intro_id =  $rowIntro['id'];
} else {
   $ko_cont =  "소개가 없습니다.";
   $en_cont =  "No Intro.";
   
}

?>

<?php
    // echo "<p class='ko'>";
    // echo    $ko_cont; 
    // echo "</p>";
    // echo "<p class='en'>";
    // echo    $en_cont;
    // echo "</p>";
     ?>

     <div class="ko">
        <?=$ko_cont?>
     </div>
     <div class="en">
        <?=$en_cont?>
     </div>

      <div id="<?php echo $intro_id; ?>" class="delete_btn" title="삭제하기" onclick="introDel(this.id)">
         <a>
            <img src="static/img/delete_btn.png" alt="delete_btn">
         </a>
      </div>