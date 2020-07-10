<?php
session_start();
include "cdd_db_conn.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// $sqlPlace = "SELECT * FROM places ORDER BY ko_title DESC";
// $resultPlace = $conn->query($sqlPlace) or die($conn->error);

$q = intval($_GET['q']);
$sqlPlaceDetail = "SELECT * FROM places WHERE id = $q";

$stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlPlaceDetail)) {
            // echo "sqlPlaceDetail error";
    } else {
            // mysqli_stmt_bind_param($stmt, "s", $author);
            mysqli_stmt_execute($stmt);
            $resultPlaceDetail = mysqli_stmt_get_result($stmt);
    }

$rowPlaceDetail = $resultPlaceDetail->fetch_assoc();

$place_id = $rowPlaceDetail['place_id'];
$detailTitle = $rowPlaceDetail['ko_title'];
$detailTitle_en = $rowPlaceDetail['en_title'];
$detailSubTitle = $rowPlaceDetail['ko_sub_title'];
$detailSubTitle_en = $rowPlaceDetail['en_sub_title'];
$detailMemo = $rowPlaceDetail['ko_memo'];
$detailMemo_en = $rowPlaceDetail['en_memo'];
$detailMarker = $rowPlaceDetail['mkimg_dir'];
$detailAddress = $rowPlaceDetail['ko_address'];
$detailAddress_en = $rowPlaceDetail['en_address'];
$detailAddressArr = explode(" ", $rowPlaceDetail['ko_address']);
$detailCoord = $rowPlaceDetail['lat'].", ".$rowPlaceDetail['lng'];
$detailCoordLat = $rowPlaceDetail['lat'];
$detailCoordLng = $rowPlaceDetail['lng'];
$detailCont = $rowPlaceDetail['ko_cont'];
$detailCont_en = $rowPlaceDetail['en_cont'];


$sqlPlaceImg = "SELECT * FROM images WHERE place_id = $place_id ORDER BY created DESC";
$stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlPlaceImg)) {
            // echo "sqlPlaceImg error";
    } else {
            // mysqli_stmt_bind_param($stmt, "s", $author);
            mysqli_stmt_execute($stmt);
            $resultPlaceImg = mysqli_stmt_get_result($stmt);
    }

$sqlPlaceWork = "SELECT * FROM works WHERE place_id = $place_id ORDER BY created DESC";
$stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlPlaceWork)) {
            // echo "sqlPlaceWork error";
    } else {
            // mysqli_stmt_bind_param($stmt, "s", $author);
            mysqli_stmt_execute($stmt);
            $resultPlaceWork = mysqli_stmt_get_result($stmt);
    }
    
    $sqlPlaceRef = "SELECT * FROM refs WHERE place_id = $place_id ORDER BY created DESC";
    $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlPlaceRef)) {
                // echo "sqlPlaceRef error";
        } else {
                // mysqli_stmt_bind_param($stmt, "s", $author);
                mysqli_stmt_execute($stmt);
                $resultPlaceRef = mysqli_stmt_get_result($stmt);
        }
   
// $detailWork = "임시 관련작품 == 리스트 == 입력 시 리스트로 변환";
// $detailWork_en = "works list";
// $detailRef = "임시 참고자료 == 리스트 == 입력 시 리스트로 변환";
// $detailRef_en = "reference list";


// $detailTitle = "임시 제목";
// $detailTitle_en = "Title";
// $detailMarker = "임시 마커 이미지 링크";
// $detailAddress = "임시 주소";
// $detailAddress_en = "Address";
// $detailCoord = "임시 위치 == 입력 시 위도 경도 좌표 정보 획득";
// $detailCont = "임시 설명 및 이미지 == 스마트에디터";
// $detailCont_en = "detail contents.";
// $detailImg = "이미지";
// $detailImg_dir = "이미지 경로";
// $detailWork = "임시 관련작품 == 리스트 == 입력 시 리스트로 변환";
// $detailWork_en = "works list";
// $detailRef = "임시 참고자료 == 리스트 == 입력 시 리스트로 변환";
// $detailRef_en = "reference list";

?>


<!DOCTYPE html>
<html lang="ko">
    <head>
        <?php include "head.php"; ?>
    </head>
    <body>

        <header>
        <!-- header: 헤더, 메뉴바 역할. 메뉴 버튼 클릭하면 menu화면 보여줌. 제목 클릭하면 map으로 넘어감-->
            <?php include "header.php"; ?>
        </header>
        
        
            
        <section>
                
            
            <!-- menu: 메뉴 내비 바 -->
            <?php include "menu.php"; ?>


            <div id="detail_wrap">
                <div id="detail_box">
                    <div id="detail_box_area">
                        <div id="detail_marker">
                            <img src="<?php echo $detailMarker;?>" alt="<?php echo $detailTitle;?>">
                        </div>
                        <div id="detail_title">
                            <h3 class="ddobag ko">
                                <?php echo $detailTitle;?>
                            </h3>
                            <h3 class="ddobag en">
                                <?php echo $detailTitle_en;?>
                            </h3>
                        </div>
                        <div id="detail_sub_title">
                            <h4 class="ddobag ko">
                                <?php echo $detailSubTitle;?>
                            </h4>
                            <h4 class="ddobag en">
                                <?php echo $detailSubTitle_en;?>
                            </h4>
                        </div>
                        <div id="detail_point" onclick="showExMap(<?=$detailAddressArr[0]?>+'_'+<?=$detailAddressArr[1]?>+'_'+<?=$detailAddressArr[2]?>+'_'+<?=$detailAddressArr[3]?>)">
                            
                            <div class="detail_address ko">
                                <?php echo $detailAddress;?>
                            </div>
                            <div class="detail_address en">
                                <?php echo $detailAddress_en;?>
                            </div>
                            <div class="detail_coord">
                                <?php echo $detailCoord;?>
                            </div>
                            <!-- <div class="detail_coord en">
                                <?php //echo $detailCoord;?>
                            </div> -->
                        </div>
                        <?php
                        $sessLang = $_SESSION['language'];
                        if($detailMemo && !$detailMemo_en) {
                            if($sessLang == "ko") {
                                ?>
                                <div id="detail_memo">
                                    <div class="ddobag ko">
                                        <?php echo $detailMemo;?>
                                    </div>
                                    
                                </div>
                                <?php
                            }
                        } else if(!$detailMemo && $detailMemo_en){
                            if($seseLang == "en") {
                                ?>
                                <div id="detail_memo">
                                    <div class="ddobag en">
                                        <?php echo $detailMemo_en;?>
                                    </div>
                                </div>
                                <?php
                            }
                        } else if($detailMemo && $detailMemo_en){
                            if($sessLang == "ko") {
                                ?>
                                <div id="detail_memo">
                                    <div class="ddobag ko">
                                        <?php echo $detailMemo;?>
                                    </div>
                                    
                                </div>
                                <?php
                            } else {
                                ?>
                                <div id="detail_memo">
                                
                                    <div class="ddobag en">
                                        <?php echo $detailMemo_en;?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div id="detail_cont">
                            <div class="ko">
                                <?php echo $detailCont;?>
                            </div>
                            <div class="en">
                                <?php echo $detailCont_en;?>
                            </div>
                        </div>
                        <div id="detail_img">
                            <!-- <div class="detail_attachment_title">
                                <div class="img_title ko ddobag">
                                    이미지
                                </div>
                                <div class="img_title en ddobag">
                                    Images
                                </div>
                            </div> -->
                            <!-- <ul class="detail_attachment_list"> -->
                                <?php
                                    if($resultPlaceImg->num_rows > 0) {
                                        echo "
                                        <div class='detail_attachment_title'>
                                            <div class='img_title ko ddobag'>
                                                이미지
                                            </div>
                                            <div class='img_title en ddobag'>
                                                Images
                                            </div>
                                        </div>
                                        <ul class='detail_attachment_list'>
                                        ";
                                        while($rowPlaceImg = $resultPlaceImg->fetch_assoc()) {
                                            $detailImg_title_ko = $rowPlaceImg['ko_title'];
                                            $detailImg_title_en = $rowPlaceImg['en_title'];
                                            $detailImg_cont_ko = $rowPlaceImg['ko_cont'];
                                            $detailImg_cont_en = $rowPlaceImg['en_cont'];
                                            $detailImg_dir = $rowPlaceImg['img_dir'];
                                            
                                            echo "<li class='attached_img'>";
                                                echo "<img src='".$detailImg_dir."' alt='".$detailImg_title_ko."'>";
                                                echo "<div class='attached_img_tag'>";
                                                    echo "<div class='attached_img_title ko'>";
                                                    echo $detailImg_title_ko;
                                                    echo "</div>";
                                                    echo "<div class='attached_img_title en'>";
                                                    echo $detailImg_title_en;
                                                    echo "</div>";
                                                    echo "<div class='attached_img_cont ko'>";
                                                    echo $detailImg_cont_ko;
                                                    echo "</div>";
                                                    echo "<div class='attached_img_cont en'>";
                                                    echo $detailImg_cont_en;
                                                    echo "</div>";
                                                echo "</div>";
                                            echo "</li>";

                                        }
                                        echo "</ul>";
                                    }
                                ?>
                            <!-- </ul> -->
                        </div>
                        <div id="detail_work">
                            <!-- <div class="detail_attachment_title">
                                <div class="work_title ko ddobag">
                                    관련 작품
                                </div>
                                <div class="work_title en ddobag">
                                    Works
                                </div>
                            </div>
                            <ul class="detail_attachment_list"> -->
                                <?php
                                    if($resultPlaceWork->num_rows > 0) {
                                        echo "
                                        <div class='detail_attachment_title'>
                                            <div class='work_title ko ddobag'>
                                                관련 작품
                                            </div>
                                            <div class='work_title en ddobag'>
                                                Works
                                            </div>
                                        </div>
                                        <ul class='detail_attachment_list'>
                                        ";
                                        while($rowPlaceWork = $resultPlaceWork->fetch_assoc()) {
                                            $detailWork_title_ko = $rowPlaceWork['ko_title'];
                                            $detailWork_title_en = $rowPlaceWork['en_title'];
                                            $detailWork_cont_ko = $rowPlaceWork['ko_cont'];
                                            $detailWork_cont_en = $rowPlaceWork['en_cont'];
                                            
                                            echo "<li class='attached_work'>";
                                                // echo "<img src='".$detailImg_dir."' alt='".$detailImg_title_ko."'>";
                                                echo "<div class='attached_work_tag'>";
                                                    echo "<div class='attached_work_title ko'>";
                                                    echo $detailWork_title_ko;
                                                    echo "</div>";
                                                    echo "<div class='attached_work_title en'>";
                                                    echo $detailWork_title_en;
                                                    echo "</div>";
                                                    echo "<div class='attached_work_cont ko'>";
                                                    echo $detailWork_cont_ko;
                                                    echo "</div>";
                                                    echo "<div class='attached_work_cont en'>";
                                                    echo $detailWork_cont_en;
                                                    echo "</div>";
                                                echo "</div>";
                                            echo "</li>";

                                        }
                                        echo "</ul>";
                                    }
                                ?>
                            <!-- </ul> -->
                        </div>
                        <div id="detail_ref">
                            <!-- <div class="detail_attachment_title">
                                <div class="ref_title ko ddobag">
                                    참고 자료
                                </div>
                                <div class="ref_title en ddobag">
                                    References
                                </div>
                            </div> -->
                            <?php
                                    if($resultPlaceRef->num_rows > 0) {
                                        echo "
                                        <div class='detail_attachment_title'>
                                            <div class='ref_title ko ddobag'>
                                                참고 자료
                                            </div>
                                            <div class='ref_title en ddobag'>
                                                References
                                            </div>
                                        </div>
                                        <ul class='detail_attachment_list'>
                                        ";
                                        while($rowPlaceRef = $resultPlaceRef->fetch_assoc()) {
                                            $detailRef_title_ko = $rowPlaceRef['ko_title'];
                                            $detailRef_title_en = $rowPlaceRef['en_title'];
                                            $detailRef_link = $rowPlaceRef['link'];
                                            
                                            echo "<li class='attached_ref'>";
                                                // echo "<img src='".$detailImg_dir."' alt='".$detailImg_title_ko."'>";
                                                echo "<div class='attached_ref_tag'>";
                                                    echo "<div class='attached_ref_link'>";
                                                        echo "<a href='";
                                                        echo $detailRef_link;
                                                        echo "'>";
                                                            echo "<div class='attached_ref_title ko'>";
                                                            echo $detailRef_title_ko;
                                                            echo "</div>";
                                                            echo "<div class='attached_ref_title en'>";
                                                            echo $detailRef_title_en;
                                                            echo "</div>";
                                                        echo "</a>";
                                                    echo "</div>";
                                                echo "</div>";
                                            echo "</li>";

                                        }
                                        echo "</ul>";
                                    }
                                ?>
                        </div>
                        <div id="detail_func_wrap">
                            <div class="back_btn" title="뒤로가기">
                                <img src="static/img/back_btn.png" alt="back_btn">
                            </div>
                        
                            <div class="share_btn" title="공유하기">
                                <img src="static/img/share_btn.png" alt="share_btn">
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <?php //include "map.php"; ?>

        </section>

        <footer>
        <!-- footer: detail, menu 화면 아래에서 저작권 정보 보여줌. -->
            <?php include "footer.php"; ?>
        </footer>
        
        
        <?php include "jsGroup.php"; ?>

        <script>
            function detailInit() {
                let headerWrap = document.getElementById("header_wrap");
                // let mapWrap = document.getElementById("map_wrap");
                let detailWrap = document.getElementById("detail_wrap");
                let menuWrap = document.getElementById("menu_wrap");
                let footerWrap = document.getElementById("footer_wrap");

                headerWrap.style.display = "initial";
                detailWrap.style.display = "initial";
                // mapWrap.style.visibility = "hidden";
                menuWrap.style.display = "none";
                footerWrap.style.display = "initial";
            }
            detailInit();
        </script>
    </body>
</html>