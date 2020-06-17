
<script>
//****대문****//


//***헤더***//

    function loginClick() {
        let loginBtn = document.getElementById("login_btn");
        function showLogin() {
            location.href="admin_login.php";
        }
        loginBtn.addEventListener("click", showLogin);
    }
    loginClick();
    
    function signinClick() {
        let signinBtn = document.getElementById("signin_btn");
        function showsignin() {
            location.href="admin_create_user.php";
        }
        signinBtn.addEventListener("click", showsignin);
    }
    signinClick();




//***메뉴***//



</script>

<script src="static/js/admin_check.js"></script>