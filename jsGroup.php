
<script>
//****대문****//
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
            // mapWrap.style.display = "initial";
            mapWrap.style.visibility = "visible";
            menuWrap.style.display = "none";
            footerWrap.style.display = "initial";
        }
        frontTitle.addEventListener("click", hideFront);
    }
    frontTitleClick();

//***헤더***//
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
            // mapWrap.style.display = "initial";
            mapWrap.style.visibility = "visible";
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

            if(menuWrap.style.display == "none") {
                headerWrap.style.display = "initial";
                frontWrap.style.display = "none";
                detailWrap.style.display = "none";
                // mapWrap.style.display = "none";
                mapWrap.style.visibility = "hidden";
                menuWrap.style.display = "initial";
                footerWrap.style.display = "initial";
            } else {
                headerWrap.style.display = "initial";
                frontWrap.style.display = "none";
                detailWrap.style.display = "none";
                // mapWrap.style.display = "initial";
                mapWrap.style.visibility = "visible";
                menuWrap.style.display = "none";
                footerWrap.style.display = "none";
            }
        }
        headerMenu.addEventListener("click", showMenu);
    }
    headerMenuClick();




//***메뉴***//
    function menuIntroClick() {

        let menuIntro = document.getElementById("menu_intro_btn");
            let introWrap = document.getElementById("intro_cont_wrap");
        function showIntro() {

            if(introWrap.style.display == "none") {
                introWrap.style.display = "initial";
            } else {
                introWrap.style.display = "none";
            }
        }
                introWrap.style.display = "none";
        menuIntro.addEventListener("click", showIntro);
    }
    menuIntroClick();

    function menuPlaceClick() {

        let menuPlace = document.getElementById("menu_place_btn");
            let placeWrap = document.getElementById("place_cont_wrap");
        function showPlace() {

            if(placeWrap.style.display == "none") {
                placeWrap.style.display = "initial";
            } else {
                placeWrap.style.display = "none";
            }
        }
                placeWrap.style.display = "none";
        menuPlace.addEventListener("click", showPlace);
    }
    menuPlaceClick();

    function menuDetailClick() {

        let menuDetail = document.getElementById("menu_detail_btn");
            let detailWrap = document.getElementById("detail_wrap");
        function showDetail() {
            let headerWrap = document.getElementById("header_wrap");
            let frontWrap = document.getElementById("front_wrap");
            let detailWrap = document.getElementById("detail_wrap");
            let mapWrap = document.getElementById("map_wrap");
            let menuWrap = document.getElementById("menu_wrap");
            let footerWrap = document.getElementById("footer_wrap");

            headerWrap.style.display = "initial";
            frontWrap.style.display = "none";
            detailWrap.style.display = "initial";
            // mapWrap.style.display = "none";
            mapWrap.style.visibility = "hidden";
            menuWrap.style.display = "none";
            footerWrap.style.display = "initial";
            
        }
                detailWrap.style.display = "none";
        menuDetail.addEventListener("click", showDetail);
    }
    menuDetailClick();


</script>