<?php

$introCont = "임시 사이트 소개";
$placeTitle = "임시 장소 제목"
?>



<div id="menu_wrap">
    <div id="menu_box">
        <div id="menu_box_area">
            <ul id="menu_list">
                <li id="menu_intro" class="menu_list_item">
                    <div class="menu_btn_wrap">
                        <div id="menu_intro_btn">
                            <a>
                                <h2 class="ddobag">
                                    천두동·동두천 소개
                                </h2>
                            </a>
                        </div>
                        <div id="add_intro" class="menu_add">
                            <a>
                                ＋
                            </a>
                        </div>
                        
                    </div>
                    <div id="intro_cont_wrap">
                        <div id="intro_cont">
                            
                            <?php echo $introCont;?>
                            
                        </div>
                    </div>
                </li>
                <li id="menu_place" class="menu_list_item">
                    <div class="menu_btn_wrap">
                        <div id="menu_place_btn">
                            <a>
                                <h2 class="ddobag">
                                    천두동 장소들
                                </h2>
                            </a>

                        </div>
                        <div id="add_place" class="menu_add">
                            <a>
                                ＋
                            </a>
                        </div>
                    </div>
                    <div id="place_cont_wrap">
                        <div id="place_cont">
                            
                            <ul id="place_ul">
                                <?php echo $placeTitle;?>
                                <?php
                                // if(isset($result blahblah)) {
                                //     while(num_rows blahblah) {
                                //         echo "<li class='place_li'>";
                                //         echo $placeTitle;
                                //         echo "</li>";    
                                //     }
                                // }
                                ?>
                            </ul>
                        </div>
                    </div>
                </li>
                <li id="menu_user" class="menu_list_item">
                    <a id="menu_user_btn">
                        <h2 class="ddobag">
                            사용자 관리
                        </h2>
                    </a>
                    
                </li>
                <li id="menu_detail" class="menu_list_item">
                    <a id="menu_detail_btn">
                        <h2 class="ddobag">
                            장소 세부 임시버튼
                        </h2>
                    </a>
                    
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- <script>
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
</script> -->