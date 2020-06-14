<div id="front_wrap">
    <div id="front_box">
        <div id="front_title">
            <div id="title_cdd">
     
                <h1 class="gg-batang">
                    천<br>
                    두<br>
                    동
                </h1>
            </div>
            <div id="title_ddc">
           
                <h1 class="gg-batang">
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
            let frontWrap = document.getElementById("front_wrap");
            let headerWrap = document.getElementById("header_wrap");
            let mapWrap = document.getElementById("map_wrap");
            let detailWrap = document.getElementById("detail_wrap");
            let menuWrap = document.getElementById("menu_wrap");
            frontWrap.style.display = "none";
            headerWrap.style.display = "initial";
            mapWrap.style.display = "initial";
            detailWrap.style.display = "none";
            menuWrap.style.display = "none";
        }
        frontTitle.addEventListener("click", hideFront);
    }
    frontTitleClick();
</script>

