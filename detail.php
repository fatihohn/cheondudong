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

$detailTitle = $rowPlaceDetail['ko_title'];
$detailTitle_en = $rowPlaceDetail['en_title'];
$detailMarker = $rowPlaceDetail['mkimg_dir'];
$detailAddress = $rowPlaceDetail['ko_address'];
$detailAddress_en = $rowPlaceDetail['en_address'];
$detailCoord = $rowPlaceDetail['lat'].", ".$rowPlaceDetail['lng'];
$detailCont = $rowPlaceDetail['ko_cont'];
$detailCont_en = $rowPlaceDetail['en_cont'];


$sqlPlaceImg = "SELECT * FROM images WHERE place_id = $q";
$stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlPlaceImg)) {
            // echo "sqlPlaceImg error";
    } else {
            // mysqli_stmt_bind_param($stmt, "s", $author);
            mysqli_stmt_execute($stmt);
            $resultPlaceImg = mysqli_stmt_get_result($stmt);
    }

   
$detailWork = "임시 관련작품 == 리스트 == 입력 시 리스트로 변환";
$detailWork_en = "works list";
$detailRef = "임시 참고자료 == 리스트 == 입력 시 리스트로 변환";
$detailRef_en = "reference list";


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
                        <div id="detail_point">
                            
                            <div class="detail_address ko">
                                <?php echo $detailAddress;?>
                            </div>
                            <div class="detail_address en">
                                <?php echo $detailAddress_en;?>
                            </div>
                            <div class="detail_coord ko">
                                <?php echo $detailCoord;?>
                            </div>
                            <div class="detail_coord en">
                                <?php echo $detailCoord;?>
                            </div>
                        </div>
                        <div id="detail_cont">
                            <div class="ko">
                                <?php echo $detailCont;?>
                            </div>
                            <div class="en">
                                <?php echo $detailCont_en;?>
                            </div>
                        </div>
                        <div id="detail_img">
                            <div class="detail_attachment_title">
                                <div class="img_title ko ddobag">
                                    이미지
                                </div>
                                <div class="img_title en ddobag">
                                    Images
                                </div>
                            </div>
                            <ul class="detail_attachment_list">
                                <?php
                                    if($resultPlaceImg->num_rows > 0) {
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
                                    }
                                ?>
                            </ul>
                        </div>
                        <div id="detail_work">
                            <div class="detail_attachment_title">
                                <div class="work_title ko ddobag">
                                    관련 작품
                                </div>
                                <div class="work_title en ddobag">
                                    Works
                                </div>
                            </div>
                            <?php echo $detailWork;?>
                        </div>
                        <div id="detail_ref">
                            <div class="detail_attachment_title">
                                <div class="ref_title ko ddobag">
                                    참고 자료
                                </div>
                                <div class="ref_title en ddobag">
                                    References
                                </div>
                            </div>
                            <?php echo $detailRef;?>
                        </div>
                    </div>
                </div>
            </div>

            <?php include "map.php"; ?>

        </section>

        <footer>
        <!-- footer: detail, menu 화면 아래에서 저작권 정보 보여줌. -->
            <?php include "footer.php"; ?>
        </footer>
        
        
        <?php include "jsGroup.php"; ?>

        <script>
            function detailInit() {
                let headerWrap = document.getElementById("header_wrap");
                let mapWrap = document.getElementById("map_wrap");
                let detailWrap = document.getElementById("detail_wrap");
                let menuWrap = document.getElementById("menu_wrap");
                let footerWrap = document.getElementById("footer_wrap");

                headerWrap.style.display = "initial";
                detailWrap.style.display = "initial";
                mapWrap.style.visibility = "hidden";
                menuWrap.style.display = "none";
                footerWrap.style.display = "initial";
            }
            detailInit();
        </script>
    </body>
</html>