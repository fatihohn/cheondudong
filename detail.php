<?php
session_start();



$detailTitle = "임시 제목";
$detailTitle_en = "Title";
$detailMarker = "임시 마커 이미지 링크";
$detailAddress = "임시 주소";
$detailAddress_en = "Address";
$detailCoord = "임시 위치 == 입력 시 위도 경도 좌표 정보 획득";
$detailCont = "임시 설명 및 이미지 == 스마트에디터";
$detailCont_en = "detail contents.";
$detailImg = "이미지";
$detailImg_dir = "이미지 경로";
$detailWork = "임시 관련작품 == 리스트 == 입력 시 리스트로 변환";
$detailWork_en = "works list";
$detailRef = "임시 참고자료 == 리스트 == 입력 시 리스트로 변환";
$detailRef_en = "reference list";

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
                            
                            <p class="detail_address ko">
                                <?php echo $detailAddress;?>
                            </p>
                            <p class="detail_address en">
                                <?php echo $detailAddress_en;?>
                            </p>
                            <p class="detail_coord ko">
                                <?php echo $detailCoord;?>
                            </p>
                            <p class="detail_coord en">
                                <?php echo $detailCoord;?>
                            </p>
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
                            <?php echo $detailImg;?>
                        </div>
                        <div id="detail_work">
                            <p class="work_title ko ddobag">
                                관련 작품
                            </p>
                            <p class="work_title en ddobag">
                                Works
                            </p>
                            <?php echo $detailWork;?>
                        </div>
                        <div id="detail_ref">
                            <p class="ref_title ko ddobag">
                                참고 자료
                            </p>
                            <p class="ref_title en ddobag">
                                References
                            </p>
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