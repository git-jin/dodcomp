<?
require_once("../config/db_connect.php");
require_once("../config/function.php");
$code_count= strlen($_POST[code])+3;
$q_cate_list = "
select cate_name,cate_code from category
where 1
and cate_code like '".$_POST[code]."%'
and length(cate_code)= '".$code_count."'
";
$r_cate_list = dbquery($q_cate_list);
while($a_cate_list = mysql_fetch_assoc($r_cate_list)){
	$cate_list[] =$a_cate_list; 
}
$sub_cate = "<select id='search_cate".$code_count."'><option value=''>선택</option>";
foreach($cate_list as $cate_k => $cate_v){
	$sub_cate.="<option value='".$cate_v[cate_code]."'>".$cate_v[cate_name]."</option>";
}
$sub_cate .= "</select>";
echo $sub_cate;
?>
