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
        <!-- detail: 랜드마크 세부 정보 보여줌 (이름, 위치, 설명, 사진, 참고자료, 관련 작업 등 -- 관리자페이지에서 스마트에디터로 편집 가능) -->
            <!-- <?php //include "detail.php"; ?> -->
        <!-- map: 지도와 랜드마크 보여줌. 클릭/터치/드래그 화면 이동, 사용자 위치 표시 버튼, 확대/축소 버튼, 랜드마크 아이콘 표시, 랜드마크 아이콘 클릭하면 detail로 넘어감 -->
            <?php include "map.php"; ?>

        </section>

        <footer>
        <!-- footer: detail, menu 화면 아래에서 저작권 정보 보여줌. -->
            <?php include "footer.php"; ?>
        </footer>
        
        
        <?php include "jsGroup.php"; ?>

        <script>
            function homeInit() {
                // let headerWrap = document.getElementById("header_wrap");
                // let menuWrap = document.getElementById("menu_wrap");
                // let mapWrap = document.getElementById("map_wrap");
                // let footerWrap = document.getElementById("footer_wrap");
                var headerWrap = document.getElementById("header_wrap");
                var menuWrap = document.getElementById("menu_wrap");
                var mapWrap = document.getElementById("map_wrap");
                var footerWrap = document.getElementById("footer_wrap");

                headerWrap.style.display = "initial";
                // menuWrap.style.display = "none";
                // menuWrap.style.visibility = "hidden";
                menuWrap.style.visibility = "hidden";
                // menuWrap.style.height = "0px";
                menuWrap.style.position = "absolute";
                mapWrap.style.visibility = "visible";
                footerWrap.style.display = "none";
            }
            homeInit();
        </script>
    </body>
</html>