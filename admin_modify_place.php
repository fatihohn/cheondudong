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
                $place_id = $rows['place_id'];
                $username = $rows['username'];
                $mkimg = $rows['mkimg'];
                $mkimg_dir = $rows['mkimg_dir'];
                $mkimg_size = $rows['mkimg_size'];
                $ko_title = $rows['ko_title'];
                $en_title = $rows['en_title'];
                $ko_sub_title = $rows['ko_sub_title'];
                $en_sub_title = $rows['en_sub_title'];
                $ko_memo = $rows['ko_memo'];
                $en_memo = $rows['en_memo'];
                $ko_address = $rows['ko_address'];
                $en_address = $rows['en_address'];
                $lat = $rows['lat'];
                $lng = $rows['lng'];
                $ko_cont = $rows['ko_cont'];
                $en_cont = $rows['en_cont'];

                $adminCast = "admin";
                $editorCast = "editor";


                session_start();
 
 
 
                if(!isset($_SESSION['username'])) {
        ?>              <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                        </script>
        <?php   }
                //cast: admin||editor인 경우 || 작가 본인
                else if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast) {
        ?>

        <form class="createForm" action="admin_modify_place_action.php" method="POST" enctype="multipart/form-data">
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
                                        <option class="mkimg_size_slct" value="miniCube">1:1|30*30px </option>
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
                                        <label class="createGrid1">부제</label>
                                        <input class="createGrid2" name="ko_sub_title" value="<?=$ko_sub_title?>" />
                                        <input class="createGrid2" name="en_sub_title" value="<?=$en_sub_title?>" />
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                        <label class="createGrid1">메모</label>
                                        <div class="admin_editor">
                                            <textarea name="ko_memo" placeholder="메모"><?=$ko_memo?></textarea>
                                        </div>
                                        <div class="admin_editor">
                                            <textarea name="en_memo" placeholder="Memo"><?=$en_memo?></textarea>
                                        </div>
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
                                    <input class="createGrid2" id="place_lat" name="lat" value="<?=$lat?>" required />
                                    <input class="createGrid2" id="place_lng" name="lng" value="<?=$lng?>" required />
                                    </div>
                                    <div id="create_map_wrap">
                                        <div id='create_map' style='width: 596px; height: 450px;'></div>
                                        <!-- <pre id="coordinates" class="coordinates"></pre> -->
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
                                                <iframe  class="attach_frame" src="admin_attach_modify_image.php?q=<?=$place_id?>" style="width:100%; max-width:596px; height:240px;"></iframe>
                                            </div>
                                            <div id="img_attach">
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
                                                <iframe  class="attach_frame" src="admin_attach_modify_work.php?q=<?=$place_id?>" style="width:100%; max-width:596px; height:900px;"></iframe>
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
                                        <div id="create_ref_wrap">
                                            <div id="create_ref">
                                                <iframe  class="attach_frame" src="admin_attach_modify_ref.php?q=<?=$place_id?>" style="width:100%; max-width:596px; height:150px;"></iframe>
                                            </div>
                                            <div id="ref_attach">
                                                참고자료 새로고침
                                            </div>

                                            <div id="attached_modify_ref_list"></div>
                                        </div>
                                    </div>
                                </p>
            <p>
                <input type="hidden" name="id" value="<?=$q?>">
                <div class="submit_box">
                    <input type="submit" onclick="submitContents(this);">
                    <button name="cancel"><a href = "javascript:history.back()">취소</a></button>
                </div>
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

    <script>
mapboxgl.accessToken = 'pk.eyJ1Ijoic3VyaWNpdHkiLCJhIjoiY2tiZnpzaGtzMTB5NTJwcWVtOHF5anRmMCJ9.CI4QuMCsvVak3vrNtnJWcw';
    


    var map = new mapboxgl.Map({
        container: 'create_map',
        style: 'mapbox://styles/suricity/ckbhx3huo0xb11ip5hywb59rx', // stylesheet location
        center: [127.060444, 37.911627], // starting position [lng, lat]
        maxBounds: [
                //limit dongducheon 
                [126.954480, 37.846739], // Southwest limit coordinates 
                [127.196154, 38.014146] // Northeast limit coordinates
                ],
        zoom: 11, // starting zoom
        // minZoom: 12.5,
        maxZoom: 18
        });


        var marker = new mapboxgl.Marker({
            draggable: true
        })
            // .setLngLat([0, 0])
            // .setLngLat([127.060444, 37.91162])
            .setLngLat([<?php echo $lng;?>, <?php echo $lat;?>])
            .addTo(map);
            
        // function onDragEnd() {
        // var lngLat = marker.getLngLat();
        // coordinates.style.display = 'block';
        // coordinates.innerHTML =
        // 'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;
        // }
        function onDragEnd() {
        var lngLat = marker.getLngLat();
        var placeLng = document.getElementById("place_lng");
        var placeLat = document.getElementById("place_lat");
        placeLng.value = lngLat.lng;
        placeLat.value = lngLat.lat;
        }
        
        marker.on('dragend', onDragEnd);
</script>


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
        showAttachedModiImg(<?php echo $place_id; ?>);
        document.getElementById("img_attach").addEventListener("click", function() {showAttachedModiImg(<?php echo $place_id; ?>);});
    }


    //수정 중 장소에 추가된 관련작품 목록
    if (document.getElementById("attached_modify_work_list")) {
        function showAttachedModiWork(str) {
            let createWork = document.getElementById("create_work");

            if (createWork == "") {
                document.getElementById("attached_modify_work_list").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("attached_modify_work_list").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("POST", "admin_modify_showAttachedWork.php?q="+str, true);
            xmlhttp.send();

        }
        showAttachedModiWork(<?php echo $place_id; ?>);
        document.getElementById("work_attach").addEventListener("click", function() {showAttachedModiWork(<?php echo $place_id; ?>);});
    }
    



    //수정 중 장소에 추가된 참고자료 목록
    if (document.getElementById("attached_modify_ref_list")) {
        function showAttachedModiRef(str) {
            let createRef = document.getElementById("create_ref");

            if (createRef == "") {
                document.getElementById("attached_modify_ref_list").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("attached_modify_ref_list").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("POST", "admin_modify_showAttachedRef.php?q="+str, true);
            xmlhttp.send();

        }
        showAttachedModiRef(<?php echo $place_id; ?>);
        document.getElementById("ref_attach").addEventListener("click", function() {showAttachedModiRef(<?php echo $place_id; ?>);});
    }
</script>

</div>

</body>

</html>