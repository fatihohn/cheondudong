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
        // function tableImgSize() {
        //         let tableImgAll = document.querySelectorAll(".table_img");
        //         if(tableImgAll) {
        //             let ti;
        //             for(ti=0; ti < tableImgAll.length; ti++) {
        //                     tableImgAll[ti].style.width = "100%";
        //                     tableImgAll[ti].style.maxWidth = "140px";
        //             }
        //         }
        // }
        // tableImgSize();
    }
                // setInterval(function() {showAttachedImg();}, 3000);
    showAttachedImg();
    document.getElementById("img_attach").addEventListener("click", showAttachedImg);
}


//장소에 추가된 관련작업 목록
if (document.getElementById("attached_work_list")) {
    function showAttachedWork() {
        let createWork = document.getElementById("create_work");

        if (createWork == "") {
            document.getElementById("attached_work_list").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("attached_work_list").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("POST", "admin_showAttachedWork.php", true);
        xmlhttp.send();
    }
    showAttachedWork();
    document.getElementById("work_attach").addEventListener("click", showAttachedWork);
}

//장소에 추가된 참고자료 목록
if (document.getElementById("attached_ref_list")) {
    function showAttachedRef() {
        let createRef = document.getElementById("create_ref");

        if (createRef == "") {
            document.getElementById("attached_ref_list").innerHTML = "";
            return;
        }
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("attached_ref_list").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("POST", "admin_showAttachedRef.php", true);
        xmlhttp.send();
    }
    showAttachedRef();
    document.getElementById("ref_attach").addEventListener("click", showAttachedRef);
}