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
        <!-- menu: 메뉴 내비 바 -->
    <?php include "admin_menu.php"; ?>
    <div id="create_user_wrap">
        <div id="create_user_area">
            <div class="view_wrap">
                <div class="view_wrap_line">
                    <div class="contEditor">
                        <center>
                            <h3>사용자 수정</h3>
                        </center>
<?php    
           include 'cdd_db_conn.php';   
                
                $q = intval($_GET['id']);
                $query = "SELECT * FROM user_data WHERE id= $q";
                $result = $conn->query($query);
                $rows = mysqli_fetch_assoc($result);
                $realname = $rows['realname'];
                $username = $rows['username'];
                $created = $rows['created'];
                $email = $rows['email'];
                $cast = $rows['cast'];

                $adminCast = "admin";

                session_start();
 
 
                $URL = "./admin_userList.php";
 
                if(!isset($_SESSION['username'])) {
        ?>              <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                        </script>
        <?php   }
                //cast: admin이거나 본인인 경우
                else if($_SESSION['cast']==$adminCast) {
        ?>
        
                        <form class="createForm" action="admin_modify_user_action.php" method="POST" enctype="multipart/form-data">
                            <p>
                                <div class="createInput">
                                    <label class="createGrid1">
                                        이름
                                    </label>
                                    <input class="createGrid2" id="realname" type="text" name="realname" value="<?=$realname?>"  />
                                </div>
                            </p>
                            <p>
                                <div class="createInput">
                                    <label class="createGrid1">
                                        아이디
                                    </label>
                                    <input class="createGrid2" id="username" type="text" name="username" value="<?=$username?>"  />
                                    <div class="createGrid3" id="userConf"></div>
                                </div>
                            </p>
                            <p>
                                <div class="createInput">
                                    <label class="createGrid1">
                                        비밀번호 수정
                                    </label>
                                    <input class="createGrid2" type="password" id="pwOne" name="password" placeholder="비밀번호 수정"  />
                                </div>    
                            </p>
                            <p>
                                <div class="createInput">
                                    <label class="createGrid1">
                                        비밀번호 수정 확인
                                    </label>
                                    <input class="createGrid2" type="password" id="pwTwo" name="password_conf" placeholder="비밀번호 수정 확인"  />
                                    <div class="createGrid3" id="pwConf"></div>
                                    <div>
                                        <p style="font-size:0.8rem; margin-top:10px; margin-left:30px">
                                            * 8자~12자리의 영문(대소문자)+숫자+특수문자 중 2종류 이상을 조합하여 사용할 수 있습니다.
                                            <br>
                                            * 아이디와 중복되는 패스워드는 사용이 불가능 합니다.
                                            <br>
                                            * 동일한 숫자 또는 문자를 3번이상 연속으로 사용할 수 없습니다.
                                        </p>
                                    </div> 
                                </div>    
                            </p>
                            <p>
                                <div class="createInput">
                                <label class="createGrid1">이메일</label>
                                <textarea class="createGrid2" type="email" name="email" placeholder="이메일" value="<?=$email?>" ><?=$email?></textarea>
                                </div>
                            </p>
                            <p>
                                <div class="createInput">
                                    <label class="createGrid1">등급</label>
                                    <div class="createGrid2">
                                        <input class="cast_btn" type="radio" id="admin_btn"name="cast" value="admin">
                                        <label for="admin_btn">
                                            Admin
                                        </label>
                                        <br>
                                        <input class="cast_btn" type="radio" id="normal_btn"name="cast" value="normal">
                                        <label for="normal_btn">
                                            Normal
                                        </label>
                                        <br>
                                    </div>
                                </div>    
                            </p>
                            <p>
                                <input type="hidden" name="id" value="<?=$q?>">    
                                <input type="submit">
                                <button name="cancel">
                                    <a href = "javascript:history.back()">
                                        취소
                                    </a>
                                </button>
                            </p>
                        </form>
        
        <?php   }
                //cast: normal인 경우 본인 정보 수정만 가능
                else if($_SESSION['username'] == $username && $_SESSION['cast'] !== $adminCast) {
        ?>
        
                        <form class="createForm" action="admin_modify_user_action.php" method="POST" enctype="multipart/form-data">
                            <p>
                                <div class="createInput">
                                    <label class="createGrid1">
                                        이름
                                    </label>
                                    <input class="createGrid2" id="realname" type="hidden" name="realname" value="<?=$realname?>"  />
                                    <?=$realname?>
                                </div>
                            </p>
                            <p>
                                <div class="createInput">
                                    <label class="createGrid1">
                                        아이디
                                    </label>
                                    <input class="createGrid2" id="username" type="hidden" name="username" value="<?=$username?>"  />
                                    <?=$username?>
                                    <div class="createGrid3" id="userConf"></div>
                                </div>
                            </p>
                            <p>
                                <div class="createInput">
                                    <label class="createGrid1">
                                        비밀번호 수정
                                    </label>
                                    <input class="createGrid2" type="password" id="pwOne" name="password" placeholder="비밀번호 수정"  />
                                </div>    
                            </p>
                            <p>
                                <div class="createInput">
                                    <label class="createGrid1">
                                        비밀번호 수정 확인
                                    </label>
                                    <input class="createGrid2" type="password" id="pwTwo" name="password_conf" placeholder="비밀번호 수정 확인"  />
                                    <div class="createGrid3" id="pwConf"></div>
                                    <div>
                                        <p style="font-size:0.8rem; margin-top:10px; margin-left:30px">
                        
                                            * 8자~12자리의 영문(대소문자)+숫자+특수문자 중 2종류 이상을 조합하여 사용할 수 있습니다.
                                            <br>
                                            * 아이디와 중복되는 패스워드는 사용이 불가능 합니다.
                                            <br>
                                            * 동일한 숫자 또는 문자를 3번이상 연속으로 사용할 수 없습니다.
                                        </p>
                                    </div> 
                                </div>    
                            </p>
                            <p>
                                <div class="createInput">
                                    <label class="createGrid1">
                                        이메일
                                    </label>
                                    <textarea class="createGrid2" name="email" placeholder="이메일" value="<?=$email?>" ><?=$email?></textarea>
                                </div>
                            </p>
                            <p>
                                <div class="createInput">
                                    <label class="createGrid1">
                                        등급
                                    </label>
                                    <div class="createGrid2">
                                        <input class="cast_btn" type="radio" id="normal_btn"name="cast" value="normal">
                                        <label for="normal_btn">
                                            Normal
                                        </label>
                                        <br>
                                    </div>
                                </div>    
                            </p>
                            <p>
                                <input type="hidden" name="id" value="<?=$q?>">    
                                <input type="submit">
                                <button name="cancel">
                                    <a href = "javascript:history.back()">
                                        취소
                                    </a>
                                </button>
                            </p>
                        </form>
        
        <?php   } else {
                ?>
                    <script>
                            alert("권한이 없습니다.");
                            history.back();
                    </script>   
                <?php
                }
                
        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer>
    <?php include 'admin_footer.php'; ?>
</footer>

    <script>
                        function castSet() {
                        let cast = document.querySelectorAll(".cast_btn");
                        let castVal = "<?=$cast?>";
                        let i;
                        for(i=0; i < cast.length; i++) {
                            if(cast[i].value == castVal) {
                                cast[i].checked = true;
                            }
                        }
                    }
                    castSet();
                    </script>

        </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>
<?php include "jsGroup.php";?>
<?php include "admin_jsGroup.php";?>
</body>

</html>