<?
require_once("../outline/header.php");

if($_GET[no]){
	$btn_name="수정";
	$q_brand="
	select * from brand
	where 1
	and b_sn ='".$_GET[no]."'
	";
	$r_brand =dbquery($q_brand);
	$a_brand =mysql_fetch_assoc($r_brand);
	$selected[$a_brand[brand_type]] ='selected'; 
}else{
	$btn_name="등록";
}

?>
<div class="search_dv_box">
	<form method="post" onsubmit="return brand_ins_chk('<?=$btn_name;?>');"action="brand_ins.php">
		<input type="hidden" value="<?=$_GET[no]?>" name="b_sn">
		<table width="100%" cellpadding="0" cellspacing="1" class="table_grid01">
		<tr>
			<th style="width:20%">브랜드(한글)</th>
			<td><input type='text' name="kr_name" value="<?=$a_brand[brand_name]?>" required></td>
		</tr>
		<tr>
			<th>브랜드(영문)</th>
			<td><input type='text' name="en_name" value="<?=$a_brand[brand_name_en]?>" required></td>
		</tr>
		<tr>
			<th>폴더명</th>
			<td><input type='text' name="fd_name" value="<?=$a_brand[brand_fd]?>" required></td>
		</tr>
		<tr>
			<th>사용</th>
			<td>
			<select name="b_type">
			<option value="default" <?=$selected['default'];?>>사용</option>
			<option value="delete" <?=$selected['delete'];?>>미사용</option>
			</select>
			</td>
		</tr>
		</table>
		<div class="btn_dv">
			<button class="btn_02"><?=$btn_name;?></button>
		</div>
	</form>
</div>

<script>
	function brand_ins_chk(type){
		if(confirm(type+'하시겠습니까?')==true){
			return true;
		}else{
			return false;
		}
	}
</script>
<?
require_once("../outline/footer.php");
?>