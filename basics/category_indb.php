<?
require_once("../config/db_connect.php");
require_once("../config/function.php");

if($_POST[mode]){
if( $_POST[mode] =='upd'){
	$ins_type=" update ";
	$add_where=" where sn='".$_POST[cate_sn]."'";
}else{
	$ins_type=" insert into ";
}
	
	$q_cate_ins="
	$ins_type category
	set cate_name='".$_POST[add_cate]."',
	cate_name_en='".$_POST[engName]."',
	cate_code='".$_POST[code_comf]."'
	$add_where
	";
	
	dbquery($q_cate_ins);
}
echo"<script language='javascript'>
alert('등록완료');
parent.location.href='category_list.php?cate_info=".$_POST['cate_info']."';
</script>";
?>