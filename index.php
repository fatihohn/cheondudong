<!DOCTYPE html>
<html lang="ko">
    <head>

<?php include "head.php"; ?>


    </head>
    <body>

        <header>
        <!-- header: 헤더, 메뉴바 역할. 메뉴 버튼 클릭하면 menu화면 보여줌. 제목 클릭하면 map으로 넘어감-->
            <?php include "header.php"; ?>
        </header>
        
        
            
        <section>
            <div id="front_wrap">
                <div id="front_box">
                    <div id="front_title">
                        <form method="post" action="language_session.php">
                            <!-- <img src="static/img/front.png" alt="천두동"> -->
                            <p>
                                Language 
                                <select name="language" required>
                                    <option value="ko">한국어</option>
                                    <option value="en">English</option>
                                </select>
                            </p>
                            <input type="image" src="static/img/front.png" alt="Submit" />
                        </form>


                    </div>
                    <!-- <div id="lang_select" class="front_lang">
                        <div id="ko" class="tooling lang_selector">
                            한국어
                        </div>
                        <div id="en" class="tooling lang_selector">
                            English
                        </div>
                    </div> -->
                </div>
            </div>
        </section>

        <footer>
        <!-- footer: detail, menu 화면 아래에서 저작권 정보 보여줌. -->
            <?php include "footer.php"; ?>
        </footer>
        
        
        <?php include "jsGroup.php"; ?>
    </body>
</html>