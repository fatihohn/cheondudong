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
            <div id="front_wrap">
                <div id="front_box">
                    <div id="front_title">
                        <form method="post" action="language_session.php">
                            <!-- <img src="static/img/front.png" alt="천두동"> -->
                            <input class="front_img" type="image" src="static/img/front.png" alt="Submit" />
                            <div class="gg-batang">
                                 
                                <!-- <select name="language" required>
                                    <option value="ko">한국어</option>
                                    <option value="en">English</option>
                                </select> -->
                                <input class='lang_btn' type='radio' id='ko_btn'name='language' value='ko' checked>
                                <label for='ko_btn'>한국어</label>
                                <input class='lang_btn' type='radio' id='en_btn'name='language' value='en'>
                                <label for='en_btn'>English</label>
                            </div>
                            <!-- <input type="submit" value="언어선택"> -->
                        </form>


                    </div>
                    <!-- <div id="lang_select" class="front_lang">
                        <div id="ko" class="tooling lang_selector">
                            한국어
                        </div>
                        <div id="en" class="tooling lang_selector">
                            English
                        </div>
                    </div> -->
                </div>
            </div>
        </section>

        <footer>
        <!-- footer: detail, menu 화면 아래에서 저작권 정보 보여줌. -->
            <?php include "footer.php"; ?>
        </footer>
        
        
    
        <?php include "jsGroup.php"; ?>

        <script>
            function indexInit() {
                // let headerWrap = document.getElementById("header_wrap");
                // let menuWrap = document.getElementById("menu_wrap");
                // let mapWrap = document.getElementById("map_wrap");
                // let footerWrap = document.getElementById("footer_wrap");
                var headerWrap = document.getElementById("header_wrap");
                // var menuWrap = document.getElementById("menu_wrap");
                // var mapWrap = document.getElementById("map_wrap");
                var footerWrap = document.getElementById("footer_wrap");

                headerWrap.style.display = "none";
                // menuWrap.style.display = "none";
                // mapWrap.style.visibility = "hidden";
                footerWrap.style.display = "initial";
            }
            indexInit();
        </script>
    </body>
</html>