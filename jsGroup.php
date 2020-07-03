<script>
    function frontLang() {
        var sessLang = "<?php echo $_SESSION['language'];?>";
        var koAll = document.querySelectorAll(".ko");
        var enAll = document.querySelectorAll(".en");
        var klang;
        var elang;
        for(klang=0; klang < koAll.length; klang++) {
            // var koStatus = koAll[klang].style.display;
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
        var adminHeader = document.getElementById("header_ad_title");
        if(!adminHeader) {
            location.href = "detail.php?q=" + str;
        } else {
            location.href = "admin_detail.php?q=" + str;
        }
    }
    function showDetailPlaceMenu(str) {
        var adminHeader = document.getElementById("header_ad_title");
        var placeIdMenu = str.split("_")[1];
        if(!adminHeader) {
            location.href = "detail.php?q=" + placeIdMenu;
        } else {
            location.href = "admin_detail.php?q=" + placeIdMenu;
        }
    }
    

    // function mapMarkerNameClick() {
    //     var markerNameAll = document.querySelectorAll(".marker_name");
    //     var mkname;
    //     for(mkname=0; mkname < markerNameAll.length; mkname++) {
    //         var markerNameId = markerNameAll[mkname].id;
    //         showDetailPlaceMap(markerNameId);
    //     }
    // }
    // mapMarkerNameClick();

    function mapMarkerClick() {
        var markerAll = document.querySelectorAll(".marker");
        var mk;
        for(mk=0; mk < markerAll.length; mk++) {
            var markerId = markerAll[mk].id;
            markerAll[mk].addEventListener("click", function() {
                showDetailPlaceMap(this.id)
            });
        }
    }
    mapMarkerClick();

    function menuPlaceLiClick() {
        var menuPlaceLiAll = document.querySelectorAll(".place_li");
        var mpl;
        for(mpl=0; mpl < menuPlaceLiAll.length; mpl++) {
            var markerId = menuPlaceLiAll[mpl].id;
            menuPlaceLiAll[mpl].addEventListener("click", function() {
                showDetailPlaceMenu(this.id)
            });
        }
    }
    menuPlaceLiClick();

    // function mapMarkerNameClick() {
    //     var markerNameAll = document.querySelectorAll(".marker_name");
    //     var mkname;
    //     for(mkname=0; mkname < markerNameAll.length; mkname++) {
    //         var markerNameId = markerNameAll[mkname].id;
    //         markerNameAll[mkname].addEventListener("click", showDetailPlaceMap(markerNameId));
    //     }
    // }
    // mapMarkerNameClick();


//****대문****//
    // function frontTitleClick() {

    //     var frontTitle = document.getElementById("front_title");
    //     if(frontTitle) {
    //     function hideFront() {
    //         var headerWrap = document.getElementById("header_wrap");
    //         var frontWrap = document.getElementById("front_wrap");
    //         // var detailWrap = document.getElementById("detail_wrap");
    //         var mapWrap = document.getElementById("map_wrap");
    //         var menuWrap = document.getElementById("menu_wrap");
    //         var footerWrap = document.getElementById("footer_wrap");
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

    //     var headerTitle = document.getElementById("header_title");
    //     if(headerTitle) {
    //         function showMap() {
    //             var headerWrap = document.getElementById("header_wrap");
    //             var frontWrap = document.getElementById("front_wrap");
    //             var detailWrap = document.getElementById("detail_wrap");
    //             var mapWrap = document.getElementById("map_wrap");
    //             var menuWrap = document.getElementById("menu_wrap");
    //             var footerWrap = document.getElementById("footer_wrap");
                
    //             var introWrap = document.getElementById("intro_cont_wrap");
    //             var placeWrap = document.getElementById("place_list_wrap");
                
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

        var headerTitle = document.getElementById("header_title");
        function showHome() {
            location.href = "home.php"
        }
        if(headerTitle) {
            headerTitle.addEventListener("click", showHome);
        }
    }
    headerTitleClick();

    // function headerMenuClick() {

    //     var headerMenu = document.getElementById("header_btn");
    //     function showMenu() {
    //         var headerWrap = document.getElementById("header_wrap");
    //         // var frontWrap = document.getElementById("front_wrap");
    //         // var detailWrap = document.getElementById("detail_wrap");
    //         var mapWrap = document.getElementById("map_wrap");
    //         var menuWrap = document.getElementById("menu_wrap");
    //         var footerWrap = document.getElementById("footer_wrap");
            
    //         var introWrap = document.getElementById("intro_cont_wrap");
    //         var placeWrap = document.getElementById("place_list_wrap");
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

        var headerMenu = document.getElementById("header_btn");
        function showMenu() {
            var headerWrap = document.getElementById("header_wrap");
            var mapWrap = document.getElementById("map_wrap");
            var menuWrap = document.getElementById("menu_wrap");
            var detailWrap = document.getElementById("detail_wrap");
            var footerWrap = document.getElementById("footer_wrap");
            
            var introWrap = document.getElementById("intro_cont_wrap");
            var placeWrap = document.getElementById("place_list_wrap");
            
            var userListWrap = document.getElementById("userList_wrap");

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

        var menuIntro = document.getElementById("menu_intro_btn");
        var introWrap = document.getElementById("intro_cont_wrap");
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

        var menuPlace = document.getElementById("menu_place_btn");
            var placeWrap = document.getElementById("place_list_wrap");
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

    //     var menuDetail = document.getElementById("menu_detail_btn");
    //         // var detailWrap = document.getElementById("detail_wrap");
    //     function showDetail() {
    //         var headerWrap = document.getElementById("header_wrap");
    //         var frontWrap = document.getElementById("front_wrap");
    //         // var detailWrap = document.getElementById("detail_wrap");
    //         var mapWrap = document.getElementById("map_wrap");
    //         var menuWrap = document.getElementById("menu_wrap");
    //         var footerWrap = document.getElementById("footer_wrap");

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
    //         var koAll = document.querySelectorAll(".ko");
    //         var enAll = document.querySelectorAll(".en");
    //         var klang;
    //         for(klang=0; klang < koAll.length; klang++) {
    //             var koStatus = koAll[klang].style.display;
    //             var elang;
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
    //     var placeLiAll = document.querySelectorAll(".place_li");
    //     if(placeLiAll) {
    //         var pl;
    //         for(pl=0; pl < placeLiAll.length; pl++) {
    //             placeLiAll[pl].showDetailPlace(this.id);
    //         }
    //     }
    // }
    // menuPlaceLiClick();
    
    // function mapPlaceLiClick() {
    //     var placeLiAll = document.querySelectorAll(".marker_name");
    //     if(placeLiAll) {
    //         var pl;
    //         for(pl=0; pl < placeLiAll.length; pl++) {
    //             placeLiAll[pl].showDetailPlace(this.id);
    //         }
    //     }
    // }
    // mapPlaceLiClick();








    //****detail****//
    function detailBackBtnClick() {
        // var backBtn = document.getElementById("back_btn");
        var backBtn = document.querySelectorAll(".back_btn");
        function detailBack() {
            var adminHeader = document.getElementById("header_ad_title");
        if(!adminHeader) {
            location.replace("home.php");
        } else {
            location.replace("admin_index.php");
        }
            // location.replace("home.php");
        }
        var bb;
        for(bb=0; bb < backBtn.length; bb++) {
            if(backBtn) {
                backBtn[bb].addEventListener("click", detailBack);
            }
        }
    }
    detailBackBtnClick();

    function detailShareBtnClick() {
        // var shareBtn = document.getElementById("share_btn");
        var shareBtn = document.querySelectorAll(".share_btn");
        function detailShare() {
            var urlBox = document.createElement('input');
            var currentUrl = window.location.href;

            document.body.appendChild(urlBox);
            urlBox.value = currentUrl;
            urlBox.select();
            document.execCommand('copy');
            document.body.removeChild(urlBox);
            alert("링크가 복사되었습니다.")
        }
        var sb;
        for(sb=0; sb < shareBtn.length; sb++) {
            if(shareBtn) {
                shareBtn[sb].addEventListener("click", detailShare);
            }
        }
    }
    detailShareBtnClick();

</script>