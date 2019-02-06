<?
require_once("../outline/header.php");
require_once("../outline/top_menu.php");

$q_brand_list="
select * from brand
where 1
";
$r_brand_list = dbquery($q_brand_list);
while($a_brand_list = mysql_fetch_assoc($r_brand_list)){
	$a_brand_list['brand_t']=($a_brand_list[brand_type]=='default') ? '사용':'미사용';
	$a_brand[] = $a_brand_list;
}
?>
<div class="search_dv_box">
	<form method="post" action="">
		<div style="text-align:right; padding:10px 0px;">
		<button class="btn_02" type="button" onclick="common_pop('brand_pop.php')">브랜드 등록</button>
		</div>
		<table width="100%" cellpadding="0" cellspacing="1" class="table_grid01">
		<tr>
			<th style="width:10%">브랜드(한글)</th>
			<td><input type='text' name="search_kr"></td>
		</tr>
		<tr>
			<th>브랜드(영어)</th>
			<td><input type='text' name="search_en"></td>
		</tr>
		</table>
		<div class="btn_dv">
			<button class="btn_02">검 색</button>
		</div>
	</form>
</div>

<table id="table_id" class="display" style="text-align:center;">
    <thead>
        <tr>
            <th>고유번호</th>
            <th>브랜드명(한글)</th>
            <th>브랜드명(영어)</th>
            <th>이미지폴더명</th>
            <th>사용여부</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
       <? 
		if($a_brand){
		   foreach($a_brand as $brand_k=>$brand_v){ 
			?>
		   <tr>
				<td><?=$brand_v[b_sn];?></td>
				<td><?=$brand_v[brand_name];?></td>
				<td><?=$brand_v[brand_name_en]?></td>
				<td><?=$brand_v[brand_fd]?></td>
				<td><?=$brand_v[brand_t]?></td>
				<td><button type="button" onclick="common_pop('brand_pop.php?no=<?=$brand_v[b_sn];?>')">수정</button></td>
			</tr>
			<?
			}
		}
		?>
    </tbody>
</table>

<script>
document.title='브랜드 관리';
</script>
<?


require_once("../outline/footer.php");

?>
