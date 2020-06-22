<script>
//****대문****//
    function frontTitleClick() {

        let frontTitle = document.getElementById("front_title");
        if(frontTitle) {
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
            mapWrap.style.visibility = "visible";
            menuWrap.style.display = "none";
            footerWrap.style.display = "initial";
        }
        frontTitle.addEventListener("click", hideFront);

        }
    }
    frontTitleClick();

//***헤더***//
    function headerTitleClick() {

        let headerTitle = document.getElementById("header_title");
        if(headerTitle) {
            function showMap() {
                let headerWrap = document.getElementById("header_wrap");
                let frontWrap = document.getElementById("front_wrap");
                let detailWrap = document.getElementById("detail_wrap");
                let mapWrap = document.getElementById("map_wrap");
                let menuWrap = document.getElementById("menu_wrap");
                let footerWrap = document.getElementById("footer_wrap");
                
                let introWrap = document.getElementById("intro_cont_wrap");
                let placeWrap = document.getElementById("place_cont_wrap");
                
                if(frontWrap) {

                headerWrap.style.display = "initial";
                frontWrap.style.display = "none";
                detailWrap.style.display = "none";
                mapWrap.style.visibility = "visible";
                menuWrap.style.display = "none";
                footerWrap.style.display = "none";

                placeWrap.style.display = "none";
                introWrap.style.display = "none";
                } else {
                headerWrap.style.display = "initial";
                detailWrap.style.display = "none";
                mapWrap.style.visibility = "visible";
                menuWrap.style.display = "none";
                footerWrap.style.display = "none";

                placeWrap.style.display = "none";
                introWrap.style.display = "none";

                }
            }
            headerTitle.addEventListener("click", showMap);
        }
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
            
            let introWrap = document.getElementById("intro_cont_wrap");
            let placeWrap = document.getElementById("place_cont_wrap");
            if(frontWrap) {
                if(menuWrap.style.display == "none") {
                    headerWrap.style.display = "initial";
                    menuWrap.style.display = "initial";
                    frontWrap.style.display = "none";
                    
                    mapWrap.style.visibility = "hidden";
                    footerWrap.style.display = "initial";
                    introWrap.style.display = "none";
                    placeWrap.style.display = "none";
                } else {
                    headerWrap.style.display = "initial";
                    menuWrap.style.display = "none";
                    frontWrap.style.display = "none";
                
                    mapWrap.style.visibility = "visible";
                    footerWrap.style.display = "none";
                    introWrap.style.display = "none";
                    placeWrap.style.display = "none";
                }

            } else {
                if(menuWrap.style.display == "none") {
                    headerWrap.style.display = "initial";
                    menuWrap.style.display = "initial";
                    if(mapWrap) {
                        mapWrap.style.visibility = "hidden";
                        footerWrap.style.display = "initial";
                        introWrap.style.display = "none";
                        placeWrap.style.display = "none";
                    }                    
                } else {
                    headerWrap.style.display = "initial";
                    menuWrap.style.display = "none";
                    if(mapWrap) {
                        mapWrap.style.visibility = "visible";
                        footerWrap.style.display = "none";
                        introWrap.style.display = "none";
                        placeWrap.style.display = "none";
                    }
                }
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

            if(frontWrap) {
                headerWrap.style.display = "initial";
                frontWrap.style.display = "none";
                detailWrap.style.display = "initial";
                mapWrap.style.visibility = "hidden";
                menuWrap.style.display = "none";
                footerWrap.style.display = "initial";

            } else {
                headerWrap.style.display = "initial";
                // frontWrap.style.display = "none";
                detailWrap.style.display = "initial";
                mapWrap.style.visibility = "hidden";
                menuWrap.style.display = "none";
                footerWrap.style.display = "initial";

            }
            
        }
                detailWrap.style.display = "none";
        menuDetail.addEventListener("click", showDetail);
    }
    menuDetailClick();

    function langClick() {
        function langChange() {
            let koAll = document.querySelectorAll(".ko");
            let enAll = document.querySelectorAll(".en");
            let klang;
            for(klang=0; klang < koAll.length; klang++) {
                let koStatus = koAll[klang].style.display;
                let elang;
                for(elang=0; elang < enAll.length; elang++) {
                    if(koStatus == "none") {
                        koAll[klang].style.display = "initial";
                        enAll[elang].style.display = "none";
                    } else {
                        koAll[klang].style.display = "none";
                        enAll[elang].style.display = "initial";
                    }
                }
            }
        }
        document.getElementById("language_en")style.display = "none";
        document.getElementById("lang_select").addEventListener("click", langChange);
    }
    langClick();

</script>