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


    }
    showAttachedImg();
    // document.getElementById("attach_img").addEventListener("click", showAttachedImg);
}