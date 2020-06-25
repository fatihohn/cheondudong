//장소에 추가된 이미지 목록
if (document.getElementById("attached_image_list")) {
    function showAttachedImg() {
        let createImg = document.getElementById("create_image");

        if (createImg == "") {
            document.getElementById("attached_image_list").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("attached_image_list").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("POST", "admin_showAttachedImg.php", true);
        xmlhttp.send();
        function tableImgSize() {
            let tableImgAll = document.querySelectorAll(".table_img");
            if(tableImgAll) {
                let ti;
                for(ti=0; ti < tableImgAll.length; ti++) {
                    tableImgAll[ti].style.width = "100%";
                    tableImgAll[ti].style.maxWidth = "140px";
                }
            }
        }
    }
    // setInterval(function() {showAttachedImg();}, 3000);
    tableImgSize();
    showAttachedImg();
    document.getElementById("img_attach").addEventListener("click", showAttachedImg);
}