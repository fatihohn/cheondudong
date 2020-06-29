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

    <div id="create_wrap">
        <div id="create_area">
            <div class="view_wrap">
                <div class="view_wrap_line">
                    <div class="contEditor">
                        <center>
                            <h3>장소 생성</h3>
                        </center>
        
                        <?php    
                        include 'cdd_db_conn.php';   
                        $URL = "./admin_index.php";

                        $uname = $_SESSION['username'];
                        $query = "SELECT * FROM user_data WHERE username= '$uname'";
                        $result = $conn->query($query);
                        $rows = mysqli_fetch_assoc($result);

                        $username = $rows['username'];           

                        $adminCast = "admin";

                        if($_SESSION['cast']!==$adminCast){
                            ?> 
                            <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                            </script>
                            <?php   
                        }

                        session_start();



                        if(!isset($_SESSION['username'])) {
                            ?>              
                            <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                            </script>
                            <?php   
                        } else if($_SESSION['cast']==$adminCast) {
                            //cast: admin인 경우
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
                                        <input class="createGrid2" type="file" name="img"  required />
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                    <label class="createGrid1">마커 사이즈 구분</label>
                                    <select class="createGrid2" name="mkimg_size"  required>
                                        <option value="smallCube">1:1|60*60px </option>
                                        <option value="middleCube">1:1|80*80px</option>
                                        <option value="smallHori">1.6:1|80*50px</option>
                                        <option value="middleHori">1.6:1|108*60px</option>
                                        <option value="bigHori">1.6:1|160*100px</option>
                                        <option value="smallPano">2:1|80*40px</option>
                                        <option value="middlePano">2:1|120*60px</option>
                                        <option value="longPano">2.7:1|160*60px</option>
                                    </select>
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                    <label class="createGrid1">제목</label>
                                    <input class="createGrid2" name="ko_title" placeholder="제목" required />
                                        <input class="createGrid2" name="en_title" placeholder="Title" required />
                                    </div>
                                </p>
                                
                                <p>
                                    <div class="createInput">
                                    <label class="createGrid1">주소</label>
                                    <input class="createGrid2" type="address" name="ko_address" placeholder="주소" required />
                                    <input class="createGrid2" type="address" name="en_address" placeholder="Address" required />
                                    </div>
                                </p>
                               
                                <p>
                                    <div class="createInput">
                                    <label class="createGrid1">좌표</label>
                                    <input class="createGrid2" id="place_lat" name="lat" placeholder="위도" required />
                                    <input class="createGrid2" id="place_lng" name="lng" placeholder="경도" required />
                                    </div>

                                    <div id="create_map_wrap">
                                        <div id='create_map' style='width: 596px; height: 450px;'></div>
                                        <!-- <pre id="coordinates" class="coordinates"></pre> -->
                                    </div>

                                </p>
                                <!-- <p>
                                    <div class="createInput">
                                    <label class="createGrid1">경도</label>
                                    </div>
                                </p> -->
                                <p>
                                    <div class="createInput">
                                        <label class="createGrid1">내용</label>
                                        <div class="admin_editor">
                                            <textarea name="ir1_ko" id="ir1_ko" ></textarea>
                                        </div>
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                        <label class="createGrid1">Content</label>
                                        <div class="admin_editor">
                                            <textarea name="ir1_en" id="ir1_en" ></textarea>
                                        </div>
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                        <?php include "admin_create_image.php"; ?>
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                        <?php include "admin_create_work.php"; ?>
                                    </div>
                                </p>
                                <p>
                                    <div class="createInput">
                                        <?php include "admin_create_ref.php"; ?>
                                    </div>
                                </p>
                                <p>
                                    <div class="submit_box">
                                        <input type="submit" onclick="submitContents(this);">
                                        <button name="cancel"><a href = "javascript:history.back()">취소</a></button>
                                    </div>
                                </p>
                            </form>
                            <?php
                        } else {
                            ?>
                            <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
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
    <?php include 'footer.php'; ?>
</footer>
 

<?php include "admin_jsGroup.php";?>
<?php include "jsGroup.php";?>
<!-- <script type="text/javascript">
    let oEditors = [];
    nhn.husky.EZCreator.createInIFrame({
     oAppRef: oEditors,
     elPlaceHolder: "ir1",
     sSkinURI: "SmartEditor2Skin.html",
     fCreator: "createSEditor2"
    });

    // ‘저장’ 버튼을 누르는 등 저장을 위한 액션을 했을 때 submitContents가 호출된다고 가정한다.
    function submitContents(elClickedObj) {
     // 에디터의 내용이 textarea에 적용된다.
     oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);

     // 에디터의 내용에 대한 값 검증은 이곳에서
     // document.getElementById("ir1").value를 이용해서 처리한다.

     try {
         elClickedObj.form.submit();
     } catch(e) {}
    }

</script> -->

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
        zoom: 12.9, // starting zoom
        // minZoom: 12.5,
        maxZoom: 18
        });


        var marker = new mapboxgl.Marker({
            draggable: true
        })
            // .setLngLat([0, 0])
            .setLngLat([127.060444, 37.91162])
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
</body>

</html>
