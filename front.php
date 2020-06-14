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
    function frTitleClick() {

        let frTitle = document.getElementById("front_title");
        function hideFront() {
            let frWrap = document.getElementById("front_wrap");
            frWrap.style.display = "none";
        }
        frTitle.addEventListener("click", hideFront);
    }
    frTitleClick();
</script>

