
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
            footerWrap.style.display = "initial";
        }
        frontTitle.addEventListener("click", hideFront);
    }
    frontTitleClick();

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
            mapWrap.style.display = "initial";
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
                mapWrap.style.display = "none";
                menuWrap.style.display = "initial";
                footerWrap.style.display = "initial";
            } else {
                headerWrap.style.display = "initial";
                frontWrap.style.display = "none";
                detailWrap.style.display = "none";
                mapWrap.style.display = "initial";
                menuWrap.style.display = "none";
                footerWrap.style.display = "none";
            }
        }
        headerMenu.addEventListener("click", showMenu);
    }
    headerMenuClick();


 function menuIntroClick() {

let menuIntro = document.getElementById("menu_intro_btn");
function showIntro() {
    let introWrap = document.getElementById("intro_cont_wrap");
    if(introWrap.style.display !== "none") {
        introWrap.style.display = "none";
    } else {
        introWrap.style.display = "initial";
    }
}
menuIntro.addEventListener("click", showIntro);
}
menuIntroClick();

 function menuPlaceClick() {

let menuPlace = document.getElementById("menu_place_btn");
function showPlace() {
    let placeWrap = document.getElementById("place_cont_wrap");
    
    if(placeWrap.style.display !== "none") {
        placeWrap.style.display = "none";
    } else {
        placeWrap.style.display = "initial";
    }
    
}
menuPlace.addEventListener("click", showPlace);
}
menuPlaceClick();

//  function menuPeopleClick() {

// let menuPeople = document.getElementById("menu_people_btn");
// function showPeople() {
//     let peopleWrap = document.getElementById("people_cont_wrap");
    
//     if(peopleWrap.style.display = "none") {
//         peopleWrap.style.display = "initial";
//     } else {
//         peopleWrap.style.display = "none";
//     }
    
// }
// menuPeople.addEventListener("click", showPeople);
// }
// menuPeopleClick();

</script>