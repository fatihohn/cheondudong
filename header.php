<div id="header_wrap">
    <div id="header_box">
        <div id="header_box_area">

            <div id="header_title">
                <a>
                    <h1 class="gg-batang">
                        천두동두천
                    </h1>
                </a>
            </div>
            <div id="header_btn">
                <a>
                    
                    <div class="menu_btn">
                        <img src="/static/img/menu_btn.png" alt="메뉴">
                        <!-- <h2 class="menu_o">
                            ○
                        </h2>
                        <h2 class="menu_m">
                            ≡
                        </h2> -->
                    </div>
                </a>
            </div>


        </div>
    </div>
</div>

<script>
function headerTitleClick() {

let headerTitle = document.getElementById("header_title");
function initMap() {
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
headerTitle.addEventListener("click", initMap);
}
headerTitleClick();

function headerMenuClick() {

let headerMenu = document.getElementById("menu_btn");
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
</script>