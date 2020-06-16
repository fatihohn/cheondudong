<?php

$placeTitle = "임시 제목";
$placeMarker = "임시 마커 이미지 링크";
$placeAddress = "임시 주소";
$placeCoord = "임시 위치 == 입력 시 위도 경도 좌표 정보 획득";
$placeCont = "임시 설명 및 이미지 == 스마트에디터";
$placeWork = "임시 관련작품 == 리스트 == 입력 시 리스트로 변환";
$placeRef = "임시 참고자료 == 리스트 == 입력 시 리스트로 변환";

?>



<div id="detail_wrap">
    <div id="detail_box">
        <div id="detail_box_area">
            <div id="detail_marker">
                <img src="<?php $placeMarker;?>" alt="<?php $placeTitle;?>">
            </div>
            <div id="detail_title">
                <h3>
                    <?php $placeTitle;?>
                </h3>
            </div>
            <div id="detail_point">
                <p class="detail_address">
                    <?php $placeAddress;?>
                </p>
                <p class="detail_coord">
                    <?php $placeCoord;?>
                </p>
            </div>
            <div id="detail_cont">
                <?php $placeCont;?>
            </div>
            <div id="detail_work">
                <?php $placeWork;?>
            </div>
            <div id="detail_ref">
                <?php $placeRef;?>
            </div>
        </div>
    </div>
</div>