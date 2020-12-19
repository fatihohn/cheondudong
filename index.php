<!DOCTYPE html>
<html lang="ko">
    <head>

<?php include "head.php"; ?>


    </head>
    <body >
        <div id="index_body">
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
                                        <label class='lang_btn_label selected' for='ko_btn'>
                                            한국어
                                            <input class='lang_btn' type='radio' id='ko_btn' name='language' value='ko' checked>
                                        </label>
                                        <label class='lang_btn_label' for='en_btn'>
                                            English
                                            <input class='lang_btn' type='radio' id='en_btn' name='language' value='en'>
                                        </label>
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

        </div>
        
        
    
        <?php include "jsGroup.php"; ?>


        <script>
            var langBtn;
            var langSelectDiv = document.querySelector(".lang_select");
            var langLabel = document.querySelectorAll(".lang_btn_label");
            langSelectDiv.onclick = function(e) {
                e.preventDefault();
            }
            langLabel.forEach(function(label) {
                label.onclick = function(e) {
                    e.preventDefault();
                    langBtn = label.querySelector(".lang_btn");
                    if(!label.classList.contains("selected")) {
                        langLabel.forEach(function(labelAll) {
                            if(labelAll.classList.contains("selected")) {
                                labelAll.classList.remove("selected");
                                labelAll.querySelector(".lang_btn").removeAttribute("checked");
                            }
                        });
                        label.classList.add("selected");
                        langBtn.setAttribute("checked", true)
                    }
                }
            });
        </script>
        <script>
            var indexBody = document.querySelector("#index_body");
            var langSelectForm = document.querySelector("#lang_select_form");
            var frontMsg = document.querySelector(".front_msg");
            var letterCheon = document.querySelector(".front_msg_letter.cheon");
            var letterDu = document.querySelector(".front_msg_letter.du");
            var letterDong = document.querySelector(".front_msg_letter.dong");

            indexBody.onclick = function() {
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
                    // letterMix();
                    setInterval(() => {
                        letterMix();
                    }, 12300);
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
                setTimeout(() => {
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
                    
                }, 3000);
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