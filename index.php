<!DOCTYPE html>
<html lang="ko">
    <head>

<?php include "head.php"; ?>


    </head>
    <body id="index_body">
        <div id="index_bg_line">
            <header>
            <!-- header: 헤더, 메뉴바 역할. 메뉴 버튼 클릭하면 menu화면 보여줌. 제목 클릭하면 map으로 넘어감-->
                <?php include "header.php"; ?>
            </header>    
            <section>
                <div id="front_wrap">
                    <div id="front_box">
                        <div id="front_title">
                            <form id="lang_select_form" method="post" action="language_session.php">
                                <!-- <input class="front_img" type="image" src="static/img/front.png" alt="Submit" /> -->
                                <div class="lang_select">
                                    <input class='lang_btn' type='radio' id='ko_btn'name='language' value='ko' checked>
                                    <label for='ko_btn'>한국어</label>
                                    <input class='lang_btn' type='radio' id='en_btn'name='language' value='en'>
                                    <label for='en_btn'>English</label>
                                </div>
                                <div class="front_msg">
                                    <div class="front_msg_letter cheon left"></div>
                                    <div class="front_msg_letter du center"></div>
                                    <div class="front_msg_letter dong right"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
    
            <footer>
            <!-- footer: detail, menu 화면 아래에서 저작권 정보 보여줌. -->
                <?php include "footer.php"; ?>
            </footer>

        </div>
        
        
    
        <?php include "jsGroup.php"; ?>

        <script>
            var langSelectForm = document.querySelector("#lang_select_form");
            var frontMsg = document.querySelector(".front_msg");
            var letterCheon = document.querySelector(".front_msg_letter.cheon");
            var letterDu = document.querySelector(".front_msg_letter.du");
            var letterDong = document.querySelector(".front_msg_letter.dong");

            frontMsg.onclick = function() {
                letterMix();
                setTimeout(() => {
                    langSelectForm.submit();
                }, 3000);
            }
            
            // frontMsg.onmouseover = function() {
            //     letterMix();
            // }

            window.onload = function() {
                setTimeout(() => {
                    letterMix();
                }, 300);
                setTimeout(() => {
                    letterMix();
                    setInterval(() => {
                        letterMix();
                    }, 6300);
                }, 3300);
            }




            function letterMix() {
                if(letterCheon.classList.contains("left")) {
                    letterCheon.classList.remove("left");
                    letterCheon.classList.add("right");
                } else {
                    letterCheon.classList.remove("right");
                    letterCheon.classList.add("left");

                }
                if(letterDong.classList.contains("right")) {
                    letterDong.classList.remove("right");
                    letterDong.classList.add("left");
                } else {
                    letterDong.classList.remove("left");
                    letterDong.classList.add("right");

                }
            }
        </script>
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