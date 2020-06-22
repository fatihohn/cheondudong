<?php

$detailTitle = "임시 제목";
$detailTitle_en = "Title";
$detailMarker = "임시 마커 이미지 링크";
$detailAddress = "임시 주소";
$detailAddress_en = "Address";
$detailCoord = "임시 위치 == 입력 시 위도 경도 좌표 정보 획득";
$detailCont = "임시 설명 및 이미지 == 스마트에디터";
$detailCont_en = "detail contents.";
$detailImg = "이미지";
$detailImg_dir = "이미지 경로";
$detailWork = "임시 관련작품 == 리스트 == 입력 시 리스트로 변환";
$detailWork_en = "works list";
$detailRef = "임시 참고자료 == 리스트 == 입력 시 리스트로 변환";
$detailRef_en = "reference list";

?>



<div id="detail_wrap">
    <div id="detail_box">
        <div id="detail_box_area">
            <div id="detail_marker">
                <img src="<?php echo $detailMarker;?>" alt="<?php echo $detailTitle;?>">
            </div>
            <div id="detail_title">
                <h3 class="tooling ko">
                    <?php echo $detailTitle;?>
                </h3>
                <h3 class="tooling en">
                    <?php echo $detailTitle_en;?>
                </h3>
            </div>
            <div id="detail_point">
                
                <p class="detail_address ko">
                    <?php echo $detailAddress;?>
                </p>
                <p class="detail_address en">
                    <?php echo $detailAddress_en;?>
                </p>
                <p class="detail_coord ko">
                    <?php echo $detailCoord;?>
                </p>
                <p class="detail_coord en">
                    <?php echo $detailCoord;?>
                </p>
            </div>
            <div id="detail_cont" class="ko">
                <?php echo $detailCont;?>
            </div>
            <div id="detail_cont" class="en">
                <?php echo $detailCont_en;?>
            </div>
            <div id="detail_img">
                <?php echo $detailImg;?>
            </div>
            <div id="detail_work">
                <p class="work_title ko tooling">
                    관련 작품
                </p>
                <p class="work_title en tooling">
                    Works
                </p>
                <?php echo $detailWork;?>
            </div>
            <div id="detail_ref">
                <p class="ref_title ko tooling">
                    참고 자료
                </p>
                <p class="ref_title en tooling">
                    References
                </p>
                <?php echo $detailRef;?>
            </div>
        </div>
    </div>
</div>