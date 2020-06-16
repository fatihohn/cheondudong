<?php

$detailTitle = "임시 제목";
$detailMarker = "임시 마커 이미지 링크";
$detailAddress = "임시 주소";
$detailCoord = "임시 위치 == 입력 시 위도 경도 좌표 정보 획득";
$detailCont = "임시 설명 및 이미지 == 스마트에디터";
$detailWork = "임시 관련작품 == 리스트 == 입력 시 리스트로 변환";
$detailRef = "임시 참고자료 == 리스트 == 입력 시 리스트로 변환";

?>



<div id="detail_wrap">
    <div id="detail_box">
        <div id="detail_box_area">
            <div id="detail_marker">
                <img src="<?php echo $detailMarker;?>" alt="<?php echo $detailTitle;?>">
            </div>
            <div id="detail_title">
                <h3 class="tooling">
                    <?php echo $detailTitle;?>
                </h3>
            </div>
            <div id="detail_point">
                <p class="detail_address">
                    <?php echo $detailAddress;?>
                </p>
                <p class="detail_coord">
                    <?php echo $detailCoord;?>
                </p>
            </div>
            <div id="detail_cont">
                <?php echo $detailCont;?>
            </div>
            <div id="detail_work">
                <?php echo $detailWork;?>
            </div>
            <div id="detail_ref">
                <?php echo $detailRef;?>
            </div>
        </div>
    </div>
</div>