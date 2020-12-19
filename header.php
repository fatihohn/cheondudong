<?php
include 'cdd_db_conn.php';
session_start();
// echo $_SESSION['language'];
?>

<div id="header_wrap">
    <div id="header_box">
        <div id="header_box_area">
            <div id="lang_select" class="header_lang gg-batang">
                <div id="language_ko" class="ko tooling lang_selector">
                    <a href="index.php">
                        English
                    </a>
                </div>
                <div id="language_en" class="en tooling lang_selector">
                    <a href="index.php">
                        한국어
                    </a>
                </div>
            </div>
            <div id="header_title">
                <a href="./home.php">
                    <!-- <img class="header_logo ko" src="static/img/cdd.png" alt="천두동·동두천">
                    <img class="header_logo en" src="static/img/cdd_en.png" alt="천두동·동두천"> -->
                    <div class="header_logo">
                        <div class="header_logo_letter cheon left"></div>
                        <div class="header_logo_letter du center"></div>
                        <div class="header_logo_letter dong right"></div>
                    </div>
                </a>
            </div>
            <div id="header_btn">
                <a>
                    <div id="menu_btn">
                        <!-- <img src="static/img/menu_btn.png" alt="메뉴"> -->
                        <img src="static/img/menu_btn.svg" alt="메뉴">
                    </div>
                </a>
            </div>


        </div>
    </div>
</div>

<script>
    var headerCheon = document.querySelector(".header_logo_letter.cheon");
    var letterDu = document.querySelector(".header_logo_letter.du");
    var headerDong = document.querySelector(".header_logo_letter.dong");

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
        if(headerCheon.classList.contains("left")) {
            headerCheon.classList.remove("left");
            headerCheon.classList.add("right");
        } else {
            headerCheon.classList.remove("right");
            headerCheon.classList.add("left");

        }
        if(headerDong.classList.contains("right")) {
            headerDong.classList.remove("right");
            headerDong.classList.add("left");
        } else {
            headerDong.classList.remove("left");
            headerDong.classList.add("right");
        }
        setTimeout(() => {
            if(headerCheon.classList.contains("left")) {
                headerCheon.classList.remove("left");
                headerCheon.classList.add("right");
            } else {
                headerCheon.classList.remove("right");
                headerCheon.classList.add("left");
    
            }
            if(headerDong.classList.contains("right")) {
                headerDong.classList.remove("right");
                headerDong.classList.add("left");
            } else {
                headerDong.classList.remove("left");
                headerDong.classList.add("right");
            }
            
        }, 3000);
    }
</script>
<!-- 
<script>
    function headerTitleClick() {

        let headerTitle = document.getElementById("header_title");
        function showMap() {
            let headerWrap = document.getElementById("header_wrap");
            let frontWrap = document.getElementById("front_wrap");
            let detailWrap = document.getElementById("detail_wrap");
            let mapWrap = document.getElementById("map_wrap");
            let menuWrap = document.getElementById("menu_wrap");
            let footerWrap = document.getElementById("footer_wrap");
            headerWrap.style.display = "initial";
            frontWrap.style.display = "none";
            detailWrap.style.display = "none";
            mapWrap.style.display = "initial";
            menuWrap.style.display = "none";
            footerWrap.style.display = "none";
        }
        headerTitle.addEventListener("click", showMap);
    }
    headerTitleClick();

    function headerMenuClick() {

        let headerMenu = document.getElementById("header_btn");
        function showMenu() {
            let headerWrap = document.getElementById("header_wrap");
            let frontWrap = document.getElementById("front_wrap");
            let detailWrap = document.getElementById("detail_wrap");
            let mapWrap = document.getElementById("map_wrap");
            let menuWrap = document.getElementById("menu_wrap");
            let footerWrap = document.getElementById("footer_wrap");
            headerWrap.style.display = "initial";
            frontWrap.style.display = "none";
            detailWrap.style.display = "none";
            mapWrap.style.display = "none";
            menuWrap.style.display = "initial";
            footerWrap.style.display = "initial";
        }
        headerMenu.addEventListener("click", showMenu);
    }
    headerMenuClick();
</script> -->