<div id="menu_wrap">
    <div id="menu_box">
        <div id="menu_box_area">
            <ul id="menu_list">
                <li id="menu_intro" class="menu_list_item">
                    <a id="menu_intro_btn">
                        <h2 class="gg-batang">
                            천두동·동두천 소개
                        </h2>
                    </a>
                    <div id="intro_cont_wrap">
                        <div id="intro_cont">
                            hello intro

                        </div>
                    </div>
                </li>
                <li id="menu_place" class="menu_list_item">
                    <a id="menu_place_btn">
                        <h2 class="gg-batang">
                            천두동 장소들
                        </h2>
                    </a>
                    <div id="place_cont_wrap">
                        <div id="place_cont">
                            <ul id="place_ul">
                                <li>
                                    hello place
                                </li>    
                                
                            </ul>

                        </div>
                    </div>
                </li>
                <!-- <li id="menu_people" class="menu_list_item">
                    <a id="menu_people_btn">
                        <h2 class="gg-batang">
                            천두동 사람들
                        </h2>
                    </a>
                    <div id="people_cont_wrap">
                        hello people
                    </div>
                </li> -->
            </ul>
        </div>
    </div>
</div>

<script>
 function menuIntroClick() {

let menuIntro = document.getElementById("menu_intro_btn");
function showIntro() {
    let introWrap = document.getElementById("intro_cont_wrap");
    if(introWrap.style.display == "none") {
        introWrap.style.display = "initial";
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
    
    if(placeWrap.style.display == "none") {
        placeWrap.style.display = "initial";
    } else {
        placeWrap.style.display = "none";
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