<script>
//****표시하기****//
    function showDetailPlaceMap(str) {
        location.href = "detail.php?q=" + str;
    }
    function showDetailPlaceMenu(str) {
        let placeIdMenu = str.split("_");
        location.href = "detail.php?q=" + placeIdMenu;
    }

    // function mapMarkerNameClick() {
    //     let markerNameAll = document.querySelectorAll(".marker_name");
    //     let mkname;
    //     for(mkname=0; mkname < markerNameAll.length; mkname++) {
    //         let markerNameId = markerNameAll[mkname].id;
    //         showDetailPlaceMap(markerNameId);
    //     }
    // }
    // mapMarkerNameClick();

    function mapMarkerClick() {
        let markerAll = document.querySelectorAll(".marker");
        let mk;
        for(mk=0; mk < markerAll.length; mk++) {
            let markerId = markerAll[mk].id;
            markerAll[mk].addEventListener("click", function() {
                showDetailPlaceMap(this.id)
            });
        }
    }
    mapMarkerClick();

    // function mapMarkerNameClick() {
    //     let markerNameAll = document.querySelectorAll(".marker_name");
    //     let mkname;
    //     for(mkname=0; mkname < markerNameAll.length; mkname++) {
    //         let markerNameId = markerNameAll[mkname].id;
    //         markerNameAll[mkname].addEventListener("click", showDetailPlaceMap(markerNameId));
    //     }
    // }
    // mapMarkerNameClick();


//****대문****//
    function frontTitleClick() {

        let frontTitle = document.getElementById("front_title");
        if(frontTitle) {
        function hideFront() {
            let headerWrap = document.getElementById("header_wrap");
            let frontWrap = document.getElementById("front_wrap");
            // let detailWrap = document.getElementById("detail_wrap");
            let mapWrap = document.getElementById("map_wrap");
            let menuWrap = document.getElementById("menu_wrap");
            let footerWrap = document.getElementById("footer_wrap");
            headerWrap.style.display = "initial";
            frontWrap.style.display = "none";
            // detailWrap.style.display = "none";
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
                let placeWrap = document.getElementById("place_list_wrap");
                
                if(frontWrap) {

                headerWrap.style.display = "initial";
                frontWrap.style.display = "none";
                    if(detailWrap) {
                        detailWrap.style.display = "none";
                    }
                mapWrap.style.visibility = "visible";
                menuWrap.style.display = "none";
                footerWrap.style.display = "none";

                placeWrap.style.display = "none";
                introWrap.style.display = "none";
                } else {
                headerWrap.style.display = "initial";
                    if(detailWrap) {
                        detailWrap.style.display = "none";
                    }
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
            // let detailWrap = document.getElementById("detail_wrap");
            let mapWrap = document.getElementById("map_wrap");
            let menuWrap = document.getElementById("menu_wrap");
            let footerWrap = document.getElementById("footer_wrap");
            
            let introWrap = document.getElementById("intro_cont_wrap");
            let placeWrap = document.getElementById("place_list_wrap");
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
            let placeWrap = document.getElementById("place_list_wrap");
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

    // function menuDetailClick() {

    //     let menuDetail = document.getElementById("menu_detail_btn");
    //         // let detailWrap = document.getElementById("detail_wrap");
    //     function showDetail() {
    //         let headerWrap = document.getElementById("header_wrap");
    //         let frontWrap = document.getElementById("front_wrap");
    //         // let detailWrap = document.getElementById("detail_wrap");
    //         let mapWrap = document.getElementById("map_wrap");
    //         let menuWrap = document.getElementById("menu_wrap");
    //         let footerWrap = document.getElementById("footer_wrap");

    //         if(frontWrap) {
    //             headerWrap.style.display = "initial";
    //             frontWrap.style.display = "none";
    //             // detailWrap.style.display = "initial";
    //             mapWrap.style.visibility = "hidden";
    //             menuWrap.style.display = "none";
    //             footerWrap.style.display = "initial";

    //         } else {
    //             headerWrap.style.display = "initial";
    //             // frontWrap.style.display = "none";
    //             // detailWrap.style.display = "initial";
    //             mapWrap.style.visibility = "hidden";
    //             menuWrap.style.display = "none";
    //             footerWrap.style.display = "initial";

    //         }
            
    //     }
    //             // detailWrap.style.display = "none";
    //     menuDetail.addEventListener("click", showDetail);
    // }
    // menuDetailClick();


//****original lang func****//
    // function langClick() {
    //     function langChange() {
    //         let koAll = document.querySelectorAll(".ko");
    //         let enAll = document.querySelectorAll(".en");
    //         let klang;
    //         for(klang=0; klang < koAll.length; klang++) {
    //             let koStatus = koAll[klang].style.display;
    //             let elang;
    //             for(elang=0; elang < enAll.length; elang++) {
    //                 if(koStatus == "none") {
    //                     koAll[klang].style.display = "initial";
    //                     enAll[elang].style.display = "none";
    //                 } else {
    //                     koAll[klang].style.display = "none";
    //                     enAll[elang].style.display = "initial";
    //                 }
    //             }
    //         }
    //     }
    //     document.getElementById("language_en").style.display = "none";
    //     document.getElementById("lang_select").addEventListener("click", langChange);
    // }
    // langClick();
//****original lang func end****//


    function langClick() {
        function langChange(str) {
            function sessLangChange(str) {
                location.href = "language_session.php?q=" + str;
            }
            sessLangChange(str);
            let sessLang = "<?php echo $_SESSION['language'];?>";
            let koAll = document.querySelectorAll(".ko");
            let enAll = document.querySelectorAll(".en");
            let klang;
            for(klang=0; klang < koAll.length; klang++) {
                let koStatus = koAll[klang].style.display;
                let elang;
                for(elang=0; elang < enAll.length; elang++) {
                    if(koStatus == "none") {
                        if (sessLang == "language_ko") {
                            koAll[klang].style.display = "initial";
                            enAll[elang].style.display = "none";
                        } else {
                            koAll[klang].style.display = "none";
                            enAll[elang].style.display = "initial";
                        }
                    } else {
                        if(sessLang == "language_ko") {
                            koAll[klang].style.display = "initial";
                            enAll[elang].style.display = "none";
                        } else {
                            koAll[klang].style.display = "none";
                            enAll[elang].style.display = "initial";
                        }
                    }
                }
            }
        }
        document.getElementById("language_ko").style.display = "none";
        // document.getElementById("lang_select").addEventListener("click", langChange);
        let langSelectorAll = document.querySelectorAll(".lang_selector");
        let langs;
        for(langs=0; langs < langSelectorAll.length; langs++) {
            langSelectorAll[langs].addEventListener("click", function() {langChange(this.id)});
        }
    
    
    
    }
    langClick();

    // function frontLang() {
    //     let sessLang = "<?php echo $_SESSION['language'];?>";
    //     let koAll = document.querySelectorAll(".ko");
    //     let klang;
    //     for(klang=0; klang < koAll.length; klang++) {
    //         let enAll = document.querySelectorAll(".en");
    //         let elang;
    //         for(elang=0; elang < enAll.length; elang++) {
    //                 koAll[klang].style.display = "initial";
    //                 enAll[elang].style.display = "none";
    //                 document.getElementById("language_en").style.display = "initial";
    //                 document.getElementById("language_ko").style.display = "none";


    //             if(sessLang == "language_en") {
    //                 koAll[klang].style.display = "none";
    //                 enAll[elang].style.display = "initial";
    //                 document.getElementById("language_en").style.display = "none";
    //                 document.getElementById("language_ko").style.display = "initial";
    //             } else if(sessLang == "language_ko") {
    //                 koAll[klang].style.display = "initial";
    //                 enAll[elang].style.display = "none";
    //                 document.getElementById("language_en").style.display = "initial";
    //                 document.getElementById("language_ko").style.display = "none";
    //             } else {
    //                 koAll[klang].style.display = "initial";
    //                 enAll[elang].style.display = "none";
    //                 document.getElementById("language_en").style.display = "initial";
    //                 document.getElementById("language_ko").style.display = "none";
    //             }

    //         }
    //     }
    // }
    // frontLang();


    // function langClick() {
    //     function langChange(str) {
    //         location.href = "language_session.php?q=" + str;
    //     }
    //     // document.getElementById("language_ko").style.display = "none";
    //     // document.getElementById("lang_select").addEventListener("click", function() {langChange(this.id)});
    //     let langSelectorAll = document.querySelectorAll(".lang_selector");
    //     let langs;
    //     for(langs=0; langs < langSelectorAll.length; langs++) {
    //         langSelectorAll[langs].addEventListener("click", function() {langChange(this.id)});
    //     }
        
        
    //     // document.getElementById("lang_select").addEventListener("click", function() {langChange(this.id)});
    // }
    // langClick();


    // let sessInit = "<?php 
    //echo $_SESSION['language'];
    //?>";
    //         if(!sessInit) {
    //             <?php 
    //             session_start();
    //             $_SESSION['language'] = "language_ko";
    //             ?>
    //         }
    

    // function menuPlaceLiClick() {
    //     let placeLiAll = document.querySelectorAll(".place_li");
    //     if(placeLiAll) {
    //         let pl;
    //         for(pl=0; pl < placeLiAll.length; pl++) {
    //             placeLiAll[pl].showDetailPlace(this.id);
    //         }
    //     }
    // }
    // menuPlaceLiClick();
    
    // function mapPlaceLiClick() {
    //     let placeLiAll = document.querySelectorAll(".marker_name");
    //     if(placeLiAll) {
    //         let pl;
    //         for(pl=0; pl < placeLiAll.length; pl++) {
    //             placeLiAll[pl].showDetailPlace(this.id);
    //         }
    //     }
    // }
    // mapPlaceLiClick();
</script>