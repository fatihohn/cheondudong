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
    


//****detail img slide****//

// let contImgs = document.querySelectorAll(".view_cont_content img");
let contImgs = document.querySelectorAll("#detail_img ul li img");
// if(contImgs) {
    let cia;
    for (cia = 0; cia < contImgs.length; cia++) {
        contImgs[cia].parentElement.style.textIndent = "0";
        contImgs[cia].style.maxWidth = "100%";
        contImgs[cia].style.height = "auto";
    
        function showNextImg(imgClassNext) {
            let imgClassNextInt = parseInt(imgClassNext);
            let nextImgSrc;
            if (imgClassNext == contImgs.length) {
                nextImgSrc = null;
            } else {
                nextImgSrc = contImgs[imgClassNextInt + 1].src;
            }
            if (nextImgSrc !== null) {
                document.getElementById("img_slide").style.backgroundImage =
                    'url(' +
                    nextImgSrc +
                    ')';
                document.getElementById("img_slide").className = imgClassNextInt + 1;
                document.getElementById("img_slide_next").className = imgClassNextInt + 1;
                document.getElementById("img_slide_prev").className = imgClassNextInt + 1;
            }
        }
    
        function showPrevImg(imgClassPrev) {
            let prevImgSrc;
            if (imgClassPrev == 0) {
                prevImgSrc = null;
            } else {
                prevImgSrc = contImgs[imgClassPrev - 1].src;
            }
            if (prevImgSrc !== null) {
                document.getElementById("img_slide").style.backgroundImage =
                    'url(' +
                    prevImgSrc +
                    ')';
                document.getElementById("img_slide").className = imgClassPrev - 1;
                document.getElementById("img_slide_next").className = imgClassPrev - 1;
                document.getElementById("img_slide_prev").className = imgClassPrev - 1;
            }
        }
    
    
        function viewImgClick() {
            // let introTitle = document.getElementById("intro_title");
    
            function showImgWindow(imgUrl, imgClassName) {
                let imgSrc = imgUrl;
                let imgSlide = document.createElement("div");
                imgSlide.className = imgClassName;
                imgSlide.id = "img_slide";
                imgSlide.style.width = "100%";
                imgSlide.style.height = "100%";
                imgSlide.style.maxHeight = "100vh";
                imgSlide.style.backgroundImage =
                    'url(' +
                    imgSrc +
                    ')';
                if (window.innerWidth > 801) {
                    imgSlide.style.backgroundPosition = 'center center';
                } else {
                    imgSlide.style.backgroundPosition = 'center center';
                }
                imgSlide.style.backgroundColor = 'black';
                imgSlide.style.backgroundSize = 'contain';
                imgSlide.style.backgroundRepeat = 'no-repeat';
                imgSlide.style.zIndex = '9990';
                imgSlide.style.position = 'fixed';
                imgSlide.style.top = '0';
                imgSlide.style.bottom = '0';
                imgSlide.style.left = '0';
                imgSlide.style.right = '0';
                imgSlide.style.transition = '0.5s';
                imgSlide.style.animation = 'expand 0.5s ease-in-out';
    
                document.body.style.overflowY = 'hidden';
                setTimeout(
                    document.body.appendChild(imgSlide), 500
                );
    
    
    
    
    
                var imgSlideBtnNext = document.createElement("div");
                imgSlideBtnNext.className = imgClassName;
                imgSlideBtnNext.id = "img_slide_next";
    
                imgSlideBtnNext.innerHTML = "▶";
                imgSlideBtnNext.style.width = "60px";
                imgSlideBtnNext.style.height = "60px";
                imgSlideBtnNext.style.fontSize = "3rem";
                imgSlideBtnNext.style.fontWeight = "900";
                imgSlideBtnNext.style.color = "white";
                imgSlideBtnNext.style.opacity = "0.3";
                imgSlideBtnNext.style.position = "fixed";
                imgSlideBtnNext.style.top = "calc(50% - 30px)";
                imgSlideBtnNext.style.right = "0";
                imgSlideBtnNext.style.margin = "10px";
                imgSlideBtnNext.style.zIndex = "9999";
                imgSlideBtnNext.style.cursor = "pointer";
                imgSlideBtnNext.style.textAlign = "center";
                imgSlideBtnNext.style.fontFamily = "sans-serif";
    
    
    
    
                imgSlideBtnNext.onmouseover = function() {
                    imgSlideBtnNext.style.opacity = "0.9";
                }
                imgSlideBtnNext.onmouseleave = function() {
                        imgSlideBtnNext.style.opacity = "0.3";
                    }
                var imgSlideBtnPrev = document.createElement("div");
                imgSlideBtnPrev.className = imgClassName;
                imgSlideBtnPrev.id = "img_slide_prev";
    
                imgSlideBtnPrev.innerHTML = "◀";
                imgSlideBtnPrev.style.width = "60px";
                imgSlideBtnPrev.style.height = "60px";
                imgSlideBtnPrev.style.fontSize = "3rem";
                imgSlideBtnPrev.style.fontWeight = "900";
                imgSlideBtnPrev.style.color = "white";
                imgSlideBtnPrev.style.opacity = "0.3";
                imgSlideBtnPrev.style.position = "fixed";
                imgSlideBtnPrev.style.top = "calc(50% - 30px)";
                imgSlideBtnPrev.style.left = "0";
                imgSlideBtnPrev.style.margin = "10px";
                imgSlideBtnPrev.style.zIndex = "9999";
                imgSlideBtnPrev.style.cursor = "pointer";
                imgSlideBtnPrev.style.textAlign = "center";
                imgSlideBtnPrev.style.fontFamily = "sans-serif";
    
    
    
                imgSlideBtnPrev.onmouseover = function() {
                    imgSlideBtnPrev.style.opacity = "0.9";
                }
                imgSlideBtnPrev.onmouseleave = function() {
                        imgSlideBtnPrev.style.opacity = "0.3";
                    }
    
                var imgSlideBtnEsc = document.createElement("div");
    
                imgSlideBtnEsc.id = "img_slide_esc";
                imgSlideBtnEsc.style.width = "calc(100% - 200px)";
                imgSlideBtnEsc.style.height = "80%";
                imgSlideBtnEsc.style.margin = "auto";
                imgSlideBtnEsc.style.position = "relative";
                imgSlideBtnEsc.style.cursor = "pointer";
                imgSlideBtnEsc.title = "닫기";
    
    
    
                imgSlide.appendChild(imgSlideBtnEsc);
                imgSlide.appendChild(imgSlideBtnNext);
                imgSlide.appendChild(imgSlideBtnPrev);
    
    
                let imgSlideNext = document.getElementById("img_slide_next");
                let imgSlidePrev = document.getElementById("img_slide_prev");
                document.getElementById("img_slide_next").onclick = function() {
                    showNextImg(this.className);
                }
                document.getElementById("img_slide_prev").onclick = function() {
                    showPrevImg(this.className);
                }
                document.onkeydown = function(keyDown) {
                        switch (keyDown.keyCode) {
                            case 37:
                                // str = 'Left Key pressed!'; 
                                if (imgSlideNext && imgSlidePrev) {
                                    showPrevImg(imgSlidePrev.className);
    
                                }
                                // console.log("Left Key Pressed!")
                                break;
                            case 39:
                                // str = 'Right Key pressed!'; 
                                if (imgSlideNext && imgSlidePrev) {
                                    showNextImg(imgSlideNext.className);
    
                                }
                                // console.log("Right Key Pressed!")
                                break;
                            case 27:
                                // str = 'Esc Key pressed!'; 
                                if (imgSlideNext && imgSlidePrev) {
                                    if (typeof imgSlide.remove === 'function') {
                                        imgSlide.remove();
                                    } else {
                                        imgSlide.parentNode.removeChild(imgSlide);
                                    }
                                    document.body.style.overflowY = 'auto';
    
                                }
    
    
                                // console.log("Esc Key Pressed!")
                                break;
                        }
                    }
                imgSlideBtnEsc.onclick = function() {
                    if (typeof imgSlide.remove === 'function') {
                        imgSlide.remove();
                    } else {
                        imgSlide.parentNode.removeChild(imgSlide);
                    }
                    document.body.style.overflowY = 'auto';
                };
    
    
            }
    
            if (contImgs[cia].src) {
                // if (introTitle) {
    
                // } else {
                // }
                    // if(window.innerWidth > 801) {
                    if (window.innerWidth > 1) {
                        contImgs[cia].addEventListener("click", function() {
                            showImgWindow(this.src, this.className);
                        });
                        contImgs[cia].style.cursor = "pointer";
                        contImgs[cia].className = cia;
    
                    }
            }
    
    
        }
        viewImgClick();
    
    
    }
// }



//****detail img slide end****//


































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


// function mapMarkerHover() {
//     let markerAll = document.querySelectorAll(".marker");
//     let mka;
//     for(mka=0; mka < markerAll.length; mka++) {
//         markerAll[mka].style.transition = '0.1s';
//         markerAll[mka].onmouseover = function() {
//             markerAll[mka].style.transform = "scale(1.2)";
//             markerAll[mka].style.msTransform = "scale(1.2)";
//             markerAll[mka].style.webkitTransform = "scale(1.2)";
//         };
//         markerAll[mka].onmouseleave = function() {
//             markerAll[mka].style.transform = "scale(1.0)";
//             markerAll[mka].style.msTransform = "scale(1.0)";
//             markerAll[mka].style.webkitTransform = "scale(1.0)";
//         };

//     }
// }
// mapMarkerHover();




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

            if(menuWrap.style.visibility == "hidden") {
                headerWrap.style.display = "initial";
                menuWrap.style.visibility = "visible";
                menuWrap.style.position = "static";
                menuWrap.style.height = "100%";
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
                menuWrap.style.visibility = "hidden";
                menuWrap.style.position = "absolute";
                menuWrap.style.height = "0px";
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
        // if(headerMenu) {
        //     setTimeout(
        //         headerMenu.addEventListener("click", showMenu), 500
        //     );
        // }



        // if(headerMenu) {
        //     setTimeout(() => {
        //         headerMenu.addEventListener("click", showMenu);
        //     }, 300);
        // }
        
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

    // function menuPlaceClick() {

    //     let menuPlace = document.getElementById("menu_place_btn");
    //     let placeWrap = document.getElementById("place_list_wrap");
    //     function showPlace() {
    //         if(placeWrap) {
    //             if(placeWrap.style.display == "none") {
    //                 placeWrap.style.display = "initial";
    //             } else {
    //                 placeWrap.style.display = "none";
    //             }
    //         }
    //         placeWrap.style.display = "none";
    //     }
    //     if(menuPlace) {
    //         menuPlace.addEventListener("click", showPlace);
    //     }
    // }
    // menuPlaceClick();
    function menuPlaceClick() {

        let menuPlace = document.getElementById("menu_place_btn");
        let placeWrap = document.getElementById("place_list_wrap");
        function showPlace() {
                if(placeWrap.style.display == "none") {
                    placeWrap.style.display = "initial";
                } else {
                    placeWrap.style.display = "none";
                }
            // placeWrap.style.display = "none";
        }
        if(menuPlace) {
            placeWrap.style.display = "none";
            menuPlace.addEventListener("click", showPlace);
        }
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
        // document.getElementById("lang_select").onclick = showIndex();
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
        var addressArr = address.split("_");
        var addressKoArr = addressArr[0].split("(");
        var addressKo = addressKoArr[0];
        var addressLat = addressArr[1];
        var addressLng = addressArr[2];
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
        var naverMapURL = "https://map.naver.com/v5/search/" + addressKo;

        var kakaoMapURL = "https://map.kakao.com/link/to/" + addressKo + "," + addressLat + "," + addressLng;
        // var kakaoMapURL = "https://map.kakao.com/link/search/" + addressLat + "," + addressLng;
        // var kakaoMapURL = "https://map.kakao.com/link/search/" + addressKo;

        // var googleMapURL = "https://www.google.com/maps/place/" + placeLat + "," + placeLng;
        
        // window.open(naverMapURL, "exNaverMap", "width=1200, height=800");
        window.open(kakaoMapURL, "exNaverMap", "width=1200, height=800");
        // window.open(googleMapURL, "exGoogleMap", "width=600, height=800");



    }

</script>