<?
require_once("../outline/header.php");
//tydebug($_POST[cate_info]);
if($_POST[cate_info]){
	$cate_info = explode("-",$_POST[cate_info]);
	$cate_info_search = implode('',$cate_info);
	$cate_info_cnt = count($cate_info);
}else{
	$cate_info_cnt = 0;

}

$q_cate="select * from category
where 1
and cate_code='".$cate_info_search."'
";
$r_cate =dbquery($q_cate);
$a_cate =mysql_fetch_assoc($r_cate);

//카테고리 가져오기

$arr_type = array(
"1"=>"1차 카테고리"
,"2"=>"2차 카테고리"
,"3"=>"3차 카테고리"
,"4"=>"4차 카테고리"
,"4"=>"4차 카테고리"
);

//카테고리 재고
?>

<style type="text/css">
.search_cate {margin-right:5px;}
.title_list{ font-weight:bold;font-size:15px; }
.table_width150{width:150px;}
</style>

<div class="title_list"><?=$arr_type[$cate_info_cnt]?> 정보 수정 </div>
<form id="main_form" method="post" action="category_indb.php" onsubmit="return chk_from()">
	<input type="hidden" name="mode" value="upd">
	<input type="hidden" name="cate_sn" value="<?=$a_cate[sn]?>">
	<input type="hidden" name="cate_info" value="<?=$_POST[cate_info]?>">
	<input type="hidden" name="depth" value="<?=$cate_info_cnt?>">
	<input type="hidden" id="chk_name">
	<input type="hidden" id="cate_low_lv_cnt" value="<?=$cate_low_lv_cnt?>">
	<table width="100%" cellpadding="0" cellspacing="1" class="table_grid01">
		<tr>
			<th class="table_width150" >카테고리 코드</th>
			<td><input type="text" name="code_comf" value="<?=$a_cate['cate_code']?>" readonly> </td>
		</tr>
		<tr>
			<th><?=$arr_type[$cate_info_cnt]?>명</th>
			<td>
				<input type="text" name="add_cate" required value="<?=$a_cate['cate_name']?>">
				<span id="dupli_msg"></span>
			</td>
		</tr>
		<tr>
			<th><?=$arr_type[$cate_info_cnt]?> 영문명</th>
			<td><input type="text" name="engName" <? if($cate_info_cnt!=1){?>required<?}?> value="<?=$a_cate['cate_name_en']?>"></td>
		</tr>		
	</table>

	<div class="btn_dv">	
		<button type="submit" class="btn_02">수 정</button>
	</div>
</form>

<fieldset class="info_div">
	<legend style="color:red">사용 주의사항</legend>
	<ul>
		<li> 1차 - 카테고리(선글,안경등) <br/> 2차 - 브랜드  <br/>3,4차 - 기존의 그릴아미드 ,헤리티지, 뿔테등 </li>
		<li>브랜드는 모두 통합 브랜드입니다. ( 안경의 브이선을 브이선1로 변경하면  모든 카테고리의 브이선이 브이선1로 변경됩니다.)</li>
		<li>브랜드 추가시  "적용 카테고리 추가" 기능으로 해당 브랜드를 원하는 1차 카테고리에 동시에 적용할 수 있습니다.  </li>
	</ul>
	<legend style="color:red">카테고리 이동기능 (현재 카테고리를 이동할 카테고리의 하위로 이동)</legend>
	<ul>
		<li>현재 선택한 카테고리가 3차 이상일때만 가능합니다( 1,2차 이동불가)</li>
		<li>이동할 카테고리가 2차 이상이어야 합니다. (1차 아래로 이동불가)</li>
		<li>카테고리는 4차까지만 생성가능. (  3차아래로   3-4차가 있는 카테고리를 옮기거나, 4차 아래로 옮기면 5차 이상이 생기기때문에 이동불가)</li>
		<li>이동시 해당 카테고리의 하위카테고리가 함께 이동됩니다.</li>
		<li>이동할 위치에 동일명의 카테고리가 존재하면 대체 카테고리명을 입력하거나, 입력하지않고 합쳐지게 할수있습니다.</li>
	</ul>

	<legend style="color:red">카테고리 삭제</legend>
	<ul>
		<li>해당 카테고리에 모델이 존재하거나 , 하위카테고리가 있으면 삭제 불가.</li>
	</ul>
</fieldset>




<script type="text/javascript">

function chk_from(){
	if(confirm("등록하시겠습니까?")){
		return true;
	}else{
		return false;
	}
}

</script>



<?
require_once("../outline/footer.php");
?>
