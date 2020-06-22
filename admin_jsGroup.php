
<script>
//****대문****//
function frontInit() {
    function initShow() {
        let headerWrap = document.getElementById("header_wrap");
        let detailWrap = document.getElementById("detail_wrap");
        let mapWrap = document.getElementById("map_wrap");
        let menuWrap = document.getElementById("menu_wrap");
        let footerWrap = document.getElementById("footer_wrap");

        headerWrap.style.display = "initial";
        menuWrap.style.display = "none";
        footerWrap.style.display = "none";
        if(mapWrap && detailWrap) {
            mapWrap.style.visibility = "visible";
            detailWrap.style.display = "none";
        }
    }
    initShow();
}
frontInit();

//***헤더***//

    function loginClick() {
        let loginBtn = document.getElementById("login_btn");
        if(loginBtn) {
            function showLogin() {
                location.href="admin_login.php";
            }
            loginBtn.addEventListener("click", showLogin);
        }
    }
    loginClick();
    
    function admin_headerTitleClick() {

        let adHeaderTitle = document.getElementById("header_ad_title");
        function showIndex() {
            location.href = "admin_index.php"
        }
        adHeaderTitle.addEventListener("click", showIndex);
    }
    admin_headerTitleClick();


    // function signinClick() {
    //     let signinBtn = document.getElementById("signin_btn");
    //     function showsignin() {
    //         location.href="admin_create_user.php";
    //     }
    //     signinBtn.addEventListener("click", showsignin);
    // }
    // signinClick();



//***메뉴***//

// function menuUserClick() {

// let menuUser = document.getElementById("menu_user_btn");
// let UserWrap = document.getElementById("user_wrap");
// function showUser() {
//     let headerWrap = document.getElementById("header_wrap");
//     let frontWrap = document.getElementById("front_wrap");
//     let detailWrap = document.getElementById("detail_wrap");
//     let mapWrap = document.getElementById("map_wrap");
//     let menuWrap = document.getElementById("menu_wrap");
//     let footerWrap = document.getElementById("footer_wrap");

//     userWrap.style.display = "initial";
//     menuWrap.style.display = "none";

//     headerWrap.style.display = "initial";
//     frontWrap.style.display = "none";
//     detailWrap.style.display = "initial";
//     mapWrap.style.visibility = "hidden";
//     footerWrap.style.display = "initial";
    
// }
// detailWrap.style.display = "none";
// menuUser.addEventListener("click", showUser);
// }
// menuUserClick();

function menuUserClick() {
    let menuUser = document.getElementById("menu_user_btn");
    function showUserList() {
        location.href = "admin_userList.php";
    }
    menuUser.addEventListener("click", showUserList);
}
menuUserClick();

function menuIntroAddClick() {
    let menuIntroAdd = document.getElementById("add_intro");
    function addIntro() {
        location.href = "admin_create_intro.php";
    }
    menuIntroAdd.addEventListener("click", addIntro);
}
menuIntroAddClick();

</script>

<script src="static/js/admin_check.js"></script>
<script src="static/js/admin_delete.js"></script>
<script src="static/js/admin_modify.js"></script>