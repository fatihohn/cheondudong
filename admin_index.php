<!DOCTYPE html>
<html lang="ko">
    <head>

<?php include "admin_head.php"; ?>


    </head>
    <body>

        <header>
        <!-- header: 헤더, 메뉴바 역할. 메뉴 버튼 클릭하면 menu화면 보여줌. 제목 클릭하면 map으로 넘어감-->
            <?php include "admin_header.php"; ?>
        </header>
        
        
            
        <section>
                
            <!-- front page: 전체화면, <천두동 동두천> 제목, 클릭하면 map으로 넘어감 -->
            <?php include "admin_front.php"; ?>

            <!-- menu: 메뉴 내비 바 -->
            <?php include "admin_menu.php"; ?>

        <!-- userList: 사용자 리스트 -->
            <?php include "admin_userList.php"; ?>

        <!-- detail: 랜드마크 세부 정보 보여줌 (이름, 위치, 설명, 사진, 참고자료, 관련 작업 등 -- 관리자페이지에서 스마트에디터로 편집 가능) -->
            <?php include "admin_detail.php"; ?>

        <!-- map: 지도와 랜드마크 보여줌. 클릭/터치/드래그 화면 이동, 사용자 위치 표시 버튼, 확대/축소 버튼, 랜드마크 아이콘 표시, 랜드마크 아이콘 클릭하면 detail로 넘어감 -->
            <?php include "map.php"; ?>

        </section>

        <footer>
        <!-- footer: detail, menu 화면 아래에서 저작권 정보 보여줌. -->
            <?php include "footer.php"; ?>
        </footer>
        
        
        <?php include "jsGroup.php"; ?>
        <?php include "admin_jsGroup.php"; ?>
    </body>
</html>