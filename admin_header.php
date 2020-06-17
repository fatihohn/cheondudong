<div id="header_wrap">
    <div id="header_box">
        <div id="header_box_area">
            <div id="header_login">
            <a>
                               
                                <?php
        include 'cdd_db_conn.php';
        $query = "select * from user_data order by id desc";
        $result = $conn->query($query);
        $total = mysqli_num_rows($result);
        
        session_start();
        
        if (isset($_SESSION['username'])) {
            ?> <div onclick="location.href='./admin_logout.php'"><h4 class="tooling">
            <?php
            echo $_SESSION['username'];
                        
            ?>님 [LogOut]</h4></div>
            
            <?php
        } else {
            ?> 
            
                <!-- <div onclick="location.href='./admin_login.php'"><h4 class="tooling">[LogIn]</h4></div>
                <div onclick="location.href='./admin_create_user.php'"><h4 class="tooling">[SignIn]</h4></div> -->
                <div id="login_btn"><h4 class="tooling">[LogIn]</h4></div>
                <!-- <div id="signin_btn"><h4 class="tooling">[SignIn]</h4></div> -->
            
<!-- <script>
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
</script> -->
    <?php   }
    ?>  
                            </a>
            </div>
            <div id="header_title">
                <a>
                    <h1 class="gg-batang">
                        천두동·에디터
                    </h1>
                </a>
            </div>
            <div id="header_btn">
                <a>
                    
                    <div id="menu_btn">
                        <img src="/static/img/menu_btn.png" alt="메뉴">
                        <!-- <h2 class="menu_o">
                            ○
                        </h2>
                        <h2 class="menu_m">
                            ≡
                        </h2> -->
                    </div>
                </a>
            </div>


        </div>
    </div>
</div>
<!-- 
<script>
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
            headerWrap.style.display = "initial";
            frontWrap.style.display = "none";
            detailWrap.style.display = "none";
            mapWrap.style.display = "none";
            menuWrap.style.display = "initial";
            footerWrap.style.display = "initial";
        }
        headerMenu.addEventListener("click", showMenu);
    }
    headerMenuClick();
</script> -->