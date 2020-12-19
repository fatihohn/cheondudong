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
                        
            ?>님<br> [LogOut]</h4> 
            
        </div>
            
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
            <div id="header_ad_title">
                <a href="./admin_index.php">
                    <!-- <h1 class="ddobag">
                        천두동·에디터
                    </h1> -->
                    <!-- <img class="header_logo ko" src="static/img/cdd_admin.png" alt="천두동·동두천">
                    <img class="header_logo en" src="static/img/cdd_en.png" alt="천두동·동두천"> -->

                    <div class="header_logo">
                        <div class="header_logo_letter cheon_ko left">
                            <div class="cheon ko"></div>
                            <span class="en">cheon</span>
                        </div>
                        <div class="header_logo_letter du_ko center">
                            <div class="du ko"></div>
                            <span class="en">du</span>
                        </div>
                        <div class="header_logo_letter dong_ko right">
                            <div class="dong ko"></div>
                            <span class="en">dong</span>
                        </div>
                    </div>
                </a>
            </div>
            <div id="header_btn">
                <a>
                    <div id="menu_btn">
                        <img src="/static/img/menu_btn.png" alt="메뉴">
                        
                    </div>
                    
                </a>
            </div>


        </div>
    </div>
</div>

<script>
    var headerCheon = document.querySelector(".header_logo_letter.cheon_ko");
    var headerDu = document.querySelector(".header_logo_letter.du_ko");
    var headerDong = document.querySelector(".header_logo_letter.dong_ko");
    var rightClass;



    window.onload = function() {
        if(window.innerWidth < 601 && document.querySelector(".en").style.display !== "none") {
            rightClass = "right_mobile";
            leftClass = "left_mobile";
            centerClass = "center_mobile";
            headerDong.classList.remove("right");
            headerDong.classList.add(rightClass);
            headerCheon.classList.remove("left");
            headerCheon.classList.add(leftClass);
            headerDu.classList.remove("center");
            headerDu.classList.add(centerClass);
        } else {
            leftClass = "left";
            rightClass = "right";
        }
        setTimeout(() => {
            letterMix();
        }, 300);
        setTimeout(() => {
            // letterMix();
            setInterval(() => {
                letterMix();
            }, 12300);
        }, 3300);
    }

    function letterMix() {
        if(headerCheon.classList.contains(leftClass)) {
            headerCheon.classList.remove(leftClass);
            headerCheon.classList.add(rightClass);
        } else {
            headerCheon.classList.remove(rightClass);
            headerCheon.classList.add(leftClass);

        }
        if(headerDong.classList.contains(rightClass)) {
            headerDong.classList.remove(rightClass);
            headerDong.classList.add(leftClass);
        } else {
            headerDong.classList.remove(leftClass);
            headerDong.classList.add(rightClass);
        }
        setTimeout(() => {
            if(headerCheon.classList.contains(leftClass)) {
                headerCheon.classList.remove(leftClass);
                headerCheon.classList.add(rightClass);
            } else {
                headerCheon.classList.remove(rightClass);
                headerCheon.classList.add(leftClass);
    
            }
            if(headerDong.classList.contains(rightClass)) {
                headerDong.classList.remove(rightClass);
                headerDong.classList.add(leftClass);
            } else {
                headerDong.classList.remove(leftClass);
                headerDong.classList.add(rightClass);
            }
            
        }, 3000);
    }
</script>
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