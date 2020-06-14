<div id="front_wrap">
    <div id="front_box">
        <div id="front_title">
            <div id="title_cdd" class="gg-batang">
     
                <!-- <h1 class="gg-batang"> -->
                <h1 >
                    천<br>
                    두<br>
                    동
                </h1>
            </div>
            <div id="title_ddc" class="gg-batang">
           
                <!-- <h1 class="gg-batang"> -->
                <h1>
                    동<br>
                    두<br>
                    천
                </h1>

            </div>
        </div>
    </div>
</div>

<script>
    function frontTitleClick() {

        let frontTitle = document.getElementById("front_title");
        function hideFront() {
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
        frontTitle.addEventListener("click", hideFront);
    }
    frontTitleClick();
</script>

