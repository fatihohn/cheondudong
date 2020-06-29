<!DOCTYPE html>
<html>

<head>
<?php include 'admin_head.php'; ?>

</head>

<body>
    <header>
        <?php include "admin_header.php"; ?>
    </header>


<section>
     <!-- menu: 메뉴 내비 바 -->
     <?php include "admin_menu.php"; ?>

    <div id="create_wrap">
        <div id="create_area">
            <div class="view_wrap">
                <div class="view_wrap_line">
                    <div class="contEditor">
                        <center>
                            <h3>장소 수정</h3>
                        </center>

<?php    
           include 'cdd_db_conn.php';   
           
           
           $URL = "./admin_index.php";

                // $authorSql = "SELECT * FROM user_data WHERE `cast` != 'normal'";
                // $resultAuthor = $conn->query($authorSql);

                $q = intval($_GET['id']);
                $query = "SELECT * FROM places WHERE id= $q";
                $result = $conn->query($query);
                $rows = mysqli_fetch_assoc($result);
                // $author = $rows['author'];
                $username = $rows['username'];
                $mkimg = $rows['mkimg'];
                $mkimg_dir = $rows['mkimg_dir'];
                $mkimg_size = $rows['mkimg_size'];
                $ko_title = $rows['ko_title'];
                $en_title = $rows['en_title'];
                $ko_address = $rows['ko_address'];
                $en_address = $rows['en_address'];
                $lat = $rows['lat'];
                $lng = $rows['lng'];
                $ko_cont = $rows['ko_cont'];
                $en_cont = $rows['en_cont'];

                $adminCast = "admin";


                session_start();
 
 
 
                if(!isset($_SESSION['username'])) {
        ?>              <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                        </script>
        <?php   }
                //cast: admin||editor인 경우 || 작가 본인
                else if($_SESSION['cast']==$adminCast) {
        ?>

        <form class="createForm" action="admin_create_place_action.php" method="POST" enctype="multipart/form-data">
                                <p>
                                    <div class="createInput">
                                        <input class="createGrid2"  type="hidden" name="username" value="<?=$username?>" required />       
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                        <label class="createGrid1">지도 표시 마커</label>
                                        <input class="createGrid2" type="file" name="img" required />
                                        <?=$mkimg?>
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                    <label class="createGrid1">마커 사이즈 구분</label>
                                    <select class="createGrid2" name="mkimg_size"  required>
                                        <option class="mkimg_size_slct" value="smallCube">1:1|60*60px </option>
                                        <option class="mkimg_size_slct" value="middleCube">1:1|80*80px</option>
                                        <option class="mkimg_size_slct" value="smallHori">1.6:1|80*50px</option>
                                        <option class="mkimg_size_slct" value="middleHori">1.6:1|108*60px</option>
                                        <option class="mkimg_size_slct" value="bigHori">1.6:1|160*100px</option>
                                        <option class="mkimg_size_slct" value="smallPano">2:1|80*40px</option>
                                        <option class="mkimg_size_slct" value="middlePano">2:1|120*60px</option>
                                        <option class="mkimg_size_slct" value="longPano">2.7:1|160*60px</option>
                                    </select>
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                    <label class="createGrid1">제목</label>
                                    <input class="createGrid2" name="ko_title" value="<?=$ko_title?>" required />
                                        <input class="createGrid2" name="en_title" value="<?=$en_title?>" required />
                                    </div>
                                </p>
                                
                                <p>
                                    <div class="createInput">
                                    <label class="createGrid1">주소</label>
                                    <input class="createGrid2" type="address" name="ko_address" value="<?=$ko_address?>" required />
                                    <input class="createGrid2" type="address" name="en_address" value="<?=$en_address?>" required />
                                    </div>
                                </p>
                               
                                <p>
                                    <div class="createInput">
                                    <label class="createGrid1">좌표</label>
                                    <input class="createGrid2" name="lat" value="<?=$lat?>" required />
                                    <input class="createGrid2" name="lng" value="<?=$lng?>" required />
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                        <label class="createGrid1">내용</label>
                                        <div class="admin_editor">
                                            <textarea name="ir1_ko" id="ir1_ko" ><?=$ko_cont?></textarea>
                                        </div>
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                        <label class="createGrid1">Content</label>
                                        <div class="admin_editor">
                                            <textarea name="ir1_en" id="ir1_en" ><?=$en_cont?></textarea>
                                        </div>
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                        <!-- <?php //include "admin_modify_image.php?q=".$q; ?> -->
                                        <div id="create_image_wrap">
                                            <div id="create_image">
                                                <iframe  class="attach_frame" src="admin_attach_modify_image.php?q=<?=$q?>" style="width:100%; max-width:596px; height:240px;"></iframe>
                                            </div>
                                            <!-- <div id="img_attach" class="<?=$q?>" onclick="showAttachedModiImg(this.class)"> -->
                                            <div class="img_attach" id="<?=$q?>" onclick="showAttachedModiImg(this.id)">
                                                이미지 새로고침
                                            </div>

                                            <div id="attached_modify_image_list"></div>
                                        </div>
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                        <?php //include "admin_modify_work.php"; ?>
                                        <div id="create_work_wrap">
                                            <div id="create_work">
                                                <iframe  class="attach_frame" src="admin_attach_modify_work.php" style="width:100%; max-width:596px; height:240px;"></iframe>
                                            </div>
                                            <div id="work_attach">
                                                관련작업 새로고침
                                            </div>

                                            <div id="attached_modify_work_list"></div>
                                        </div>
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                        <?php //include "admin_modify_ref.php"; ?>
                                    </div>
                                </p>
            <p>
                <input type="hidden" name="id" value="<?=$q?>">
                <input type="submit" onclick="submitContents(this);">
                <button name="cancel"><a href = "javascript:history.back()">취소</a></button>
            </p>
        </form>
        
        



        <?php   } else {
                ?>

                        <script>
                                alert("권한이 없습니다.");
                                // location.replace("<?php echo $URL?>");
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
    
    <?php include "admin_jsGroup.php";?>
    <script type="text/javascript">
    let oEditors = [];
    let oEditors2 = [];
    nhn.husky.EZCreator.createInIFrame({
     oAppRef: oEditors,
     elPlaceHolder: "ir1_ko",
     sSkinURI: "SmartEditor2Skin.html",
     fCreator: "createSEditor2"
    });
    nhn.husky.EZCreator.createInIFrame({
     oAppRef: oEditors2,
     elPlaceHolder: "ir1_en",
     sSkinURI: "SmartEditor2Skin.html",
     fCreator: "createSEditor2"
    });

    // ‘저장’ 버튼을 누르는 등 저장을 위한 액션을 했을 때 submitContents가 호출된다고 가정한다.
    function submitContents(elClickedObj) {
     // 에디터의 내용이 textarea에 적용된다.
     oEditors.getById["ir1_ko"].exec("UPDATE_CONTENTS_FIELD", []);
     oEditors2.getById["ir1_en"].exec("UPDATE_CONTENTS_FIELD", []);

     // 에디터의 내용에 대한 값 검증은 이곳에서
     // document.getElementById("ir1").value를 이용해서 처리한다.

     try {
         elClickedObj.form.submit();
     } catch(e) {}
    }

</script>
<script>
function mkSizeSet() {
    let mkSize = document.querySelectorAll(".mkimg_size_slct");
    let mkSizeVal = "<?=$mkimg_size?>";
    let ms;
    for(ms=0; ms < mkSize.length; ms++) {
        if(mkSize[ms].value == mkSizeVal) {
            mkSize[ms].selected = true;
        }
    }
}
mkSizeSet();
</script>


<script>
    //수정 중 장소에 추가된 이미지 목록
    if (document.getElementById("attached_modify_image_list")) {
        function showAttachedModiImg(str) {
            let createImg = document.getElementById("create_image");

            if (createImg == "") {
                document.getElementById("attached_modify_image_list").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("attached_modify_image_list").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("POST", "admin_modify_showAttachedImg.php?q="+str, true);
            xmlhttp.send();

        }
        showAttachedModiImg();
        // document.getElementById("img_attach").addEventListener("click", showAttachedModiImg(<?=$q?>));
    }
</script>

</div>

</body>

</html>