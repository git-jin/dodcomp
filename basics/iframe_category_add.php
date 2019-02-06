<?
require_once("../outline/header.php");

if($_POST[cate_info]){
	$cate_info = explode("-",$_POST[cate_info]);
	$cate_info_search = implode('',$cate_info);
	$cate_info_cnt = count($cate_info);
}else{
	$cate_info_cnt = 0;

}
//선택한 값의 한글명 체크
/*

*/
if($_POST[cate_info]){
	$and_ob ="and cate_code like '".$cate_info_search."%'";
}
	$cate_ln= strlen($cate_info_search)+3;

$arr_type = array(
"0"=>"1차 카테고리"
,"1"=>"2차 카테고리"
,"2"=>"3차 카테고리"
,"3"=>"4차 카테고리"
,"4"=>"5차 카테고리"
);
$q_cate_chk="
select *,LENGTH(cate_code) as cate_len from category
where 1
and LENGTH(cate_code) ='".$cate_ln."'
$and_ob
order by cate_code desc limit 1
";
$r_cate_chk = dbquery($q_cate_chk);
$a_cate_chk = mysql_fetch_array($r_cate_chk);
$code_ins = substr( $a_cate_chk[cate_code], -3);
$code_ins2 = str_pad(number_format($code_ins)+1,3,"0",STR_PAD_LEFT);
$code_ins3=$cate_info_search.$code_ins2;




//$arr_cate = fn_cateData();
?>


<style type="text/css">
input[type=checkbox]:disabled + label {color:#ccc}
</style>

<div style="font-weight:bold;font-size:15px;"><?=$arr_type[$cate_info_cnt]?> 추가</div>
<form id="main_form" method="post" action="category_indb.php" onsubmit="return chk_from()">
	<input type="hidden" name="mode" value="add_cate">
	<input type="hidden" name="cate_info" value="<?=$_POST[cate_info]?>">
	<input type="hidden" name="depth" value="<?=$cate_info_cnt?>">
	<input type="hidden" name="code_comf" value="<?=$code_ins3;?>">
	<input type="hidden" id="chk_name">
	<table width="100%" cellpadding="0" cellspacing="1" class="table_grid01">
		<tr>
			<th style="width:150px">카테고리 코드</th>
			<td><?=$code_ins3;?></td>
		</tr>
		<tr>
			<th style="width:150px"><?=$arr_type[$cate_info_cnt]?>명</th>
			<td>
				<input type="text" name="add_cate" required>
				<span id="dupli_msg"></span>
			</td>
		</tr>
		<tr>
			<th style="width:150px"><?=$arr_type[$cate_info_cnt]?> 영문명</th>
			<td><input type="text" name="engName" required></td>
		</tr>
	</table>

	<div style="text-align:center; padding:10px 0px;">
		<button type="submit" class="btn_02">등 록</button>
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
	/*
	if( $("#chk_name").val() == 1 ){


	}else{
		alert('[사용할수없는 입력값]');
		return false;
	}
	*/
}

/*
$(function(){

	$("input[name='add_cate']").keyup(function(){

		var cate_info = $("input[name='cate_info']").val();

		$.post("../ajax/ajax_cate_brand_duplication_chk.php",{mode:'add',cate_info:cate_info,val:$(this).val()},function(data){

			if(data == 0 ){
				$("#dupli_msg").css("color","blue");
				$("#dupli_msg").html("사용가능");
				$("#chk_name").val("1");

			}else{
				$("#dupli_msg").css("color","red");
				$("#dupli_msg").html("사용불가");
				$("#chk_name").val("0");
			}


		});


		$.post("../ajax/ajax_brand_info.php",{brand:$(this).val()},function(brand_data){

			var arr_data = brand_data.split("^");

			var brand_info = arr_data[0].split("|");
			var cate_info = arr_data[1].split("|");

			$("input[name='img_folder']").val(brand_info[0]);
			$("input[name='engName']").val(brand_info[1]);
			$("input[name='korName']").val(brand_info[2]);

			if(brand_info[3] == 'official'){
				$("input[name='import_type']").prop("checked","true");
			}

			$("input[name='add_cate_sn[]']").attr("disabled",true);
			$("input[name='add_cate_sn[]']").attr("checked",false);

			for(var i = 0; i< cate_info.length;i++){

				$("#acs_"+cate_info[i]).attr("disabled",false);
			}
		});


	});
});
*/

</script>



<?
require_once("../outline/footer.php");
?>
