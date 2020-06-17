<!DOCTYPE html>
<html>

<head>
<?php include 'admin_head.php'; ?>

</head>

<body>
    <header>
        <?php include 'admin_header.php'; ?>
    </header>
        
   
    <section>
    <div id="login_wrap">
        <div id="login_area">
            <div class="login_contain">
                <div class="login_list_area">

        <div class="adLogInProcess">
    
            
            
            <div align='center'>
        <span>로그인</span>
 
        <form method='post' action='admin_login_action.php'>
        <!-- <form method='get' action='login_action.php'> -->
                <p>ID: <input name="username" type="text" required></p>
                <p>PW: <input name="password" type="password" required></p>
                <input type="submit" value="로그인">
        </form>
        <br />
        <button id="join" onclick="location.href='./admin_create_user.php'">회원가입</button>
 
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>


    </section>
    <footer>
        <?php include 'footer.php'; ?>

    </footer>

    <?php include "admin_jsGroup.php";?>
    <?php include "jsGroup.php";?>

<script src="static/js/showHeader.js"></script>
</body>

</html>


