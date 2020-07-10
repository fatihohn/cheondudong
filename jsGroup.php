<script>
    function frontLang() {
        let sessLang = "<?php echo $_SESSION['language'];?>";
        let koAll = document.querySelectorAll(".ko");
        let enAll = document.querySelectorAll(".en");
        let klang;
        let elang;
        for(klang=0; klang < koAll.length; klang++) {
            // let koStatus = koAll[klang].style.display;
            for(elang=0; elang < enAll.length; elang++) {
                if(sessLang == "ko") {
                // if(koStatus == "none") {
                    koAll[klang].style.display = "initial";
                    enAll[elang].style.display = "none";
                } else {
                    koAll[klang].style.display = "none";
                    enAll[elang].style.display = "initial";
                }
            }
        }
    }
    frontLang();





//****표시하기****//
    function showDetailPlaceMap(str) {
        let adminHeader = document.getElementById("header_ad_title");
        if(!adminHeader) {
            location.href = "detail.php?q=" + str;
        } else {
            location.href = "admin_detail.php?q=" + str;
        }
    }
    // function showInfoPlaceMap(str) {
    //     // let adminHeader = document.getElementById("header_ad_title");
    //     // if(!adminHeader) {
    //     //     location.href = "detail.php?q=" + str;
    //     // } else {
    //     //     location.href = "admin_detail.php?q=" + str;
    //     // }

    // }


    function showDetailPlaceMenu(str) {
        let adminHeader = document.getElementById("header_ad_title");
        let placeIdMenu = str.split("_")[1];
        if(!adminHeader) {
            location.href = "detail.php?q=" + placeIdMenu;
        } else {
            location.href = "admin_detail.php?q=" + placeIdMenu;
        }
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

    // function mapMarkerClick() {
    //     let markerAll = document.querySelectorAll(".marker");
    //     let mk;
    //     for(mk=0; mk < markerAll.length; mk++) {
    //         let markerId = markerAll[mk].id;
    //         markerAll[mk].addEventListener("click", function() {
    //             // showDetailPlaceMap(this.id)
    //             showInfoPlaceMap(this.id)
    //         });
    //     }
    // }
    // mapMarkerClick();

    function mapMarkerInfoClick() {
        let markerInfoAll = document.querySelectorAll(".marker_info");
        let mkInfo;
        for(mkInfo=0; mkInfo < markerInfoAll.length; mkInfo++) {
            let markerId = markerInfoAll[mkInfo].id;
            markerInfoAll[mkInfo].addEventListener("click", function() {
                showDetailPlaceMap(this.id)
            });
        }
    }
    mapMarkerInfoClick();

    function menuPlaceLiClick() {
        let menuPlaceLiAll = document.querySelectorAll(".place_li");
        let mpl;
        for(mpl=0; mpl < menuPlaceLiAll.length; mpl++) {
            let markerId = menuPlaceLiAll[mpl].id;
            menuPlaceLiAll[mpl].addEventListener("click", function() {
                showDetailPlaceMenu(this.id)
            });
        }
    }
    menuPlaceLiClick();

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
    // function frontTitleClick() {

    //     let frontTitle = document.getElementById("front_title");
    //     if(frontTitle) {
    //     function hideFront() {
    //         let headerWrap = document.getElementById("header_wrap");
    //         let frontWrap = document.getElementById("front_wrap");
    //         // let detailWrap = document.getElementById("detail_wrap");
    //         let mapWrap = document.getElementById("map_wrap");
    //         let menuWrap = document.getElementById("menu_wrap");
    //         let footerWrap = document.getElementById("footer_wrap");
    //         headerWrap.style.display = "initial";
    //         frontWrap.style.display = "none";
    //         // detailWrap.style.display = "none";
    //         mapWrap.style.visibility = "visible";
    //         menuWrap.style.display = "none";
    //         footerWrap.style.display = "initial";

    //     }
        
    //     frontTitle.addEventListener("click", hideFront);

    //     }
    // }
    // frontTitleClick();

//***헤더***//
    // function headerTitleClick() {

    //     let headerTitle = document.getElementById("header_title");
    //     if(headerTitle) {
    //         function showMap() {
    //             let headerWrap = document.getElementById("header_wrap");
    //             let frontWrap = document.getElementById("front_wrap");
    //             let detailWrap = document.getElementById("detail_wrap");
    //             let mapWrap = document.getElementById("map_wrap");
    //             let menuWrap = document.getElementById("menu_wrap");
    //             let footerWrap = document.getElementById("footer_wrap");
                
    //             let introWrap = document.getElementById("intro_cont_wrap");
    //             let placeWrap = document.getElementById("place_list_wrap");
                
    //             if(frontWrap) {

    //             headerWrap.style.display = "initial";
    //             frontWrap.style.display = "none";
    //                 if(detailWrap) {
    //                     detailWrap.style.display = "none";
    //                 }
    //             mapWrap.style.visibility = "visible";
    //             menuWrap.style.display = "none";
    //             footerWrap.style.display = "none";

    //             placeWrap.style.display = "none";
    //             introWrap.style.display = "none";
    //             } else {
    //             headerWrap.style.display = "initial";
    //                 if(detailWrap) {
    //                     detailWrap.style.display = "none";
    //                 }
    //             mapWrap.style.visibility = "visible";
    //             menuWrap.style.display = "none";
    //             footerWrap.style.display = "none";

    //             placeWrap.style.display = "none";
    //             introWrap.style.display = "none";

    //             }
    //         }
    //         headerTitle.addEventListener("click", showMap);
    //     }
    // }
    // headerTitleClick();
    
    function headerTitleClick() {

        let headerTitle = document.getElementById("header_title");
        function showHome() {
            location.href = "home.php"
        }
        if(headerTitle) {
            headerTitle.addEventListener("click", showHome);
        }
    }
    headerTitleClick();

    // function headerMenuClick() {

    //     let headerMenu = document.getElementById("header_btn");
    //     function showMenu() {
    //         let headerWrap = document.getElementById("header_wrap");
    //         // let frontWrap = document.getElementById("front_wrap");
    //         // let detailWrap = document.getElementById("detail_wrap");
    //         let mapWrap = document.getElementById("map_wrap");
    //         let menuWrap = document.getElementById("menu_wrap");
    //         let footerWrap = document.getElementById("footer_wrap");
            
    //         let introWrap = document.getElementById("intro_cont_wrap");
    //         let placeWrap = document.getElementById("place_list_wrap");
    //         if(frontWrap) {
    //             if(menuWrap.style.display == "none") {
    //                 headerWrap.style.display = "initial";
    //                 menuWrap.style.display = "initial";
    //                 frontWrap.style.display = "none";
                    
    //                 mapWrap.style.visibility = "hidden";
    //                 footerWrap.style.display = "initial";
    //                 introWrap.style.display = "none";
    //                 placeWrap.style.display = "none";
    //             } else {
    //                 headerWrap.style.display = "initial";
    //                 menuWrap.style.display = "none";
    //                 frontWrap.style.display = "none";
                
    //                 mapWrap.style.visibility = "visible";
    //                 footerWrap.style.display = "none";
    //                 introWrap.style.display = "none";
    //                 placeWrap.style.display = "none";
    //             }

    //         } else {
    //             if(menuWrap.style.display == "none") {
    //                 headerWrap.style.display = "initial";
    //                 menuWrap.style.display = "initial";
    //                 if(mapWrap) {
    //                     mapWrap.style.visibility = "hidden";
    //                     footerWrap.style.display = "initial";
    //                     introWrap.style.display = "none";
    //                     placeWrap.style.display = "none";
    //                 }                    
    //             } else {
    //                 headerWrap.style.display = "initial";
    //                 menuWrap.style.display = "none";
    //                 if(mapWrap) {
    //                     mapWrap.style.visibility = "visible";
    //                     footerWrap.style.display = "none";
    //                     introWrap.style.display = "none";
    //                     placeWrap.style.display = "none";
    //                 }
    //             }
    //         }
    //     }
    //     headerMenu.addEventListener("click", showMenu);
    // }
    // headerMenuClick();



    function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }

    function headerMenuClick() {

        let headerMenu = document.getElementById("header_btn");
        function showMenu() {
            let headerWrap = document.getElementById("header_wrap");
            let mapWrap = document.getElementById("map_wrap");
            let menuWrap = document.getElementById("menu_wrap");
            let detailWrap = document.getElementById("detail_wrap");
            let footerWrap = document.getElementById("footer_wrap");
            
            let introWrap = document.getElementById("intro_cont_wrap");
            let placeWrap = document.getElementById("place_list_wrap");
            
            let userListWrap = document.getElementById("userList_wrap");

            if(menuWrap.style.display == "none") {
                headerWrap.style.display = "initial";
                menuWrap.style.display = "block";
                if(mapWrap && placeWrap) {
                    mapWrap.style.visibility = "hidden";
                    footerWrap.style.display = "block";
                    introWrap.style.display = "none";
                    placeWrap.style.display = "none";
                } else if(mapWrap && !placeWrap) {
                    mapWrap.style.visibility = "hidden";
                    // placeWrap.style.display = "none";
                    footerWrap.style.display = "block";
                    introWrap.style.display = "none";
                } else if(!mapWrap && placeWrap) {
                    // mapWrap.style.visibility = "hidden";
                    placeWrap.style.display = "none";
                    footerWrap.style.display = "block";
                    introWrap.style.display = "none";
                } else {
                    // mapWrap.style.visibility = "hidden";
                    // placeWrap.style.display = "none";
                    footerWrap.style.display = "block";
                    introWrap.style.display = "none";
                }
                if(detailWrap) {
                    detailWrap.style.visibility = "hidden";
                }  
                if(userListWrap) {
                    userListWrap.style.display = "none";
                }
                topFunction();                
            } else {
                headerWrap.style.display = "initial";
                menuWrap.style.display = "none";
                if(mapWrap && placeWrap && detailWrap) {
                    mapWrap.style.visibility = "hidden";
                    footerWrap.style.display = "block";
                    introWrap.style.display = "none";
                    placeWrap.style.display = "none";
                    detailWrap.style.visibility = "visible";
                } else if(mapWrap && placeWrap && !detailWrap) {
                    mapWrap.style.visibility = "visible";
                    footerWrap.style.display = "none";
                    introWrap.style.display = "none";
                    placeWrap.style.display = "none";
                } else if(!mapWrap && placeWrap && detailWrap) {
                    // mapWrap.style.visibility = "hidden";
                    footerWrap.style.display = "block";
                    introWrap.style.display = "none";
                    placeWrap.style.display = "none";
                    detailWrap.style.visibility = "visible";
                } else if(mapWrap && !placeWrap && detailWrap) {
                    mapWrap.style.visibility = "hidden";
                    footerWrap.style.display = "block";
                    introWrap.style.display = "none";
                    // placeWrap.style.display = "none";
                    detailWrap.style.visibility = "visible";
                } else if(!mapWrap && !placeWrap && detailWrap) {
                    // mapWrap.style.visibility = "hidden";
                    footerWrap.style.display = "block";
                    introWrap.style.display = "none";
                    // placeWrap.style.display = "none";
                    detailWrap.style.visibility = "visible";
                } else if(!mapWrap && placeWrap && !detailWrap) {
                    // mapWrap.style.visibility = "hidden";
                    footerWrap.style.display = "block";
                    introWrap.style.display = "none";
                    placeWrap.style.display = "none";
                    // detailWrap.style.visibility = "visible";
                } else if(mapWrap && !placeWrap && !detailWrap) {
                    mapWrap.style.visibility = "hidden";
                    footerWrap.style.display = "block";
                    introWrap.style.display = "none";
                    // placeWrap.style.display = "none";
                    // detailWrap.style.visibility = "visible";
                } else {
                    // mapWrap.style.visibility = "hidden";
                    footerWrap.style.display = "block";
                    introWrap.style.display = "none";
                    // placeWrap.style.display = "none";
                    // detailWrap.style.visibility = "visible";

                }
                if(userListWrap) {
                    userListWrap.style.display = "block";
                }
            } 
        }
        if(headerMenu) {
            headerMenu.addEventListener("click", showMenu);
        }
    }
    headerMenuClick();




//***메뉴***//
    function menuIntroClick() {

        let menuIntro = document.getElementById("menu_intro_btn");
        let introWrap = document.getElementById("intro_cont_wrap");
        if(menuIntro && introWrap) {
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
        function showIndex() {
            location.href = "index.php";
        }
        // document.getElementById("language_en").style.display = "none";
        document.getElementById("lang_select").addEventListener("click", showIndex);
    }
    langClick();






    

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








    //****detail****//
    function detailBackBtnClick() {
        // let backBtn = document.getElementById("back_btn");
        let backBtn = document.querySelectorAll(".back_btn");
        function detailBack() {
            let adminHeader = document.getElementById("header_ad_title");
        if(!adminHeader) {
            location.replace("home.php");
        } else {
            location.replace("admin_index.php");
        }
            // location.replace("home.php");
        }
        let bb;
        for(bb=0; bb < backBtn.length; bb++) {
            if(backBtn) {
                backBtn[bb].addEventListener("click", detailBack);
            }
        }
    }
    detailBackBtnClick();

    function detailShareBtnClick() {
        // let shareBtn = document.getElementById("share_btn");
        let shareBtn = document.querySelectorAll(".share_btn");
        function detailShare() {
            let urlBox = document.createElement('input');
            let currentUrl = window.location.href;

            document.body.appendChild(urlBox);
            urlBox.value = currentUrl;
            urlBox.select();
            document.execCommand('copy');
            document.body.removeChild(urlBox);
            alert("링크가 복사되었습니다.")
        }
        let sb;
        for(sb=0; sb < shareBtn.length; sb++) {
            if(shareBtn) {
                shareBtn[sb].addEventListener("click", detailShare);
            }
        }
    }
    detailShareBtnClick();

    // function showExMap(address, coordLat, coordLng) {
    function showExMap(address) {
        // var addressArr = address.split("_");
        // var province = addressArr[0];
        // var city = addressArr[1];
        // var dongOrRoad = addressArr[2];
        // var addressNumber = addressArr[3];

        // var placeCoordArr = coord.split(",");
        // var placeLat = placeCoordArr[0];
        // var placeLng = placeCoordArr[1];


        // var placeLat = coordLat;
        // var placeLng = coordLng;

        // var naverMapURL = "https://map.naver.com/v5/search/" + province + "%20" + city + "%20" + dongOrRoad + "%20" + addressNumber + "/";
        var naverMapURL = "https://map.naver.com/v5/search/" + address;
        // var googleMapURL = "https://www.google.com/maps/place/" + placeLat + "," + placeLng;
        
        window.open(naverMapURL, "exNaverMap", "width=1200, height=800");
        // window.open(googleMapURL, "exGoogleMap", "width=600, height=800");



    }

</script>