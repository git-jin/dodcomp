<?
//4차까지를 기본으로 잡고 생성( 1차 카테,  2차 브랜드, 3차 라인1, 4차 라인2 )

require_once("../outline/header.php");
require_once("../outline/top_menu.php");
//require_once("../outline/search_box.php");

$q_category = "select * 
from category 
where 1
and cate_type!='deleted'
";
$r_category = dbquery($q_category);
while( $a_category = mysql_fetch_assoc($r_category) ){
		$cate_cd=strlen($a_category[cate_code]);
		unset($cate_cd_cut);
		for($i=0; $i<$cate_cd;){
			$cate_cd_cut[]=substr($a_category[cate_code],$i,3);
			$i=$i+3;
		}
		$cate_cnt = count($cate_cd_cut);
		if( $cate_cnt ==1){
			$data_lv1[$cate_cd_cut[0]]=$a_category[cate_name];
		}else if($cate_cnt ==2){
			$data_lv2[$cate_cd_cut[0]][$cate_cd_cut[1]] = $a_category[cate_name];
		}else if($cate_cnt ==3){
			$data_lv3[$cate_cd_cut[0]][$cate_cd_cut[1]][$cate_cd_cut[2]] = $a_category[cate_name];
		}else if($cate_cnt ==4){
			$data_lv4[$cate_cd_cut[0]][$cate_cd_cut[1]][$cate_cd_cut[2]][$cate_cd_cut[3]] = $a_category[cate_name];
		}else if($cate_cnt ==5){
			$data_lv5[$cate_cd_cut[0]][$cate_cd_cut[1]][$cate_cd_cut[2]][$cate_cd_cut[3]][$cate_cd_cut[4]] = $a_category[cate_name];
		}
		
}
?>


<style type="text/css">

.cate_lv {padding:1px;margin:3px;width:100px;cursor:pointer;display:inline-block;}
.div_plus{padding:1px;margin:3px;width:15px;cursor:pointer;display:inline-block; border:1px solid #ccc;text-align:center}

ul.level_1 {padding:0px;}
ul.level_1 {list-style-type:none;}
.lv_1 {border:1px solid #ccc;text-align:center;}
.level_2 ,.level_3 ,.level_4{display:none}

.on_now {color:red}
</style>

<h1>상품입고관리 > 카테고리 관리</h1>
<form action="iframe_category.php" target="iframe_bc" method="post" id="main_form">
	<input type="hidden" name="cate_info" value="<?=$_REQUEST['cate_info']?>">
	<input type="hidden" name="cate_select">
<form>


<table width=100% border=1>
	<tr>
		<td width=20%>
		<div style="float:left;margin:3px;border:1px solid #ccc;width:150px;text-align:center;cursor:pointer" id="add_cate">+ 1차 카테고리 추가하기 </div>
		<div style="clear:both"></div>

		<div style="height:850px;overflow:auto;">
			<ul class="level_1">
				<? foreach($data_lv1 as $k=>$v){ ?>
				<li><div class="cate_lv lv_1" id="<?=$k?>"><?=$v?></div><div class="div_plus" >+</div>
					<? if($data_lv2){?>					
					<ul class="level_2">						
						<? 
						foreach($data_lv2[$k] as $k2=>$v2){ ?>
						<li>
							<div class="cate_lv lv_2" id="<?=$k."-".$k2?>"><?=$v2?>
							<? if($data_lv3[$k][$k2]) echo "<span style='color:blue'>+</span>"; ?>
							</div><div class="div_plus" >+</div>
							<? if($data_lv3[$k][$k2]){?>
							<ul class="level_3">
								<? foreach($data_lv3[$k][$k2] as $k3=>$v3){ ?>
								<li>
									<div class="cate_lv lv_3" id="<?=$k."-".$k2."-".$k3?>">
						<?=$v3?><? if($data_lv4[$k][$k2][$k3]) echo "<span style='color:blue'>+</span>"; ?>
									</div>
									<div class="div_plus" >+</div>
									<? if($data_lv4){?>
									<ul class="level_4">
										<? foreach($data_lv4[$k][$k2][$k3] as $k4=>$v4){ ?>
										<li>
										<div class="cate_lv lv_4" id="<?=$k."-".$k2."-".$k3."-".$k4?>"><?=$v4?></div>
										</li>
										<? } ?>
									</ul><!-- lv4 -->
									<?}?>
								</li>
								<? } ?>
							</ul><!-- lv3 -->
							<?}?>
						</li>
						<? } ?>
					</ul><!-- lv2 -->
					<?} ?>
				</li>
				<? } ?>
			</ul>
		</div>
		</td>

		<td width=80% style="padding:10px;vertical-align:top;height:100%">
			<iframe name="iframe_bc" width=100% height=840 frameborder="0"></iframe>
		</td>
	</tr>
</table>


<script type="text/javascript">
document.title = '브랜드 카테고리 관리';

$(function(){

	$("#add_cate").click(function(){

		$("input[name='cate_info']").val("");
		$("input[name='cate_select']").val("");

		$("#main_form").attr("action","iframe_category_add.php");
		$("#main_form").submit();
	});

	if( $("input[name='cate_info']").val() ){

		var this_val = $("input[name='cate_info']").val();
		var cateinfo = this_val.split("-");

	    var cnt = cateinfo.length;

		var id_add = '';
		for(var i=0;i<cnt;i++){

			if(i==0){
				id_add = cateinfo[i];
			}else{
				id_add += "-"+cateinfo[i];
			}

			lv_next = i+2;

			$("#"+id_add).closest("li").find(".level_"+lv_next).toggle();

			if(i == ( cnt -1 )){
				$("#"+id_add).toggleClass("on_now");
				$("input[name='cate_select']").val( $("#"+id_add).html() );
			}
		}

		$("#main_form").submit();
	}

	$(".div_plus").click(function(){

		$("input[name='cate_info']").val( $(this).prev().attr("id") );
		$("input[name='cate_select']").val( $(this).prev().html() );

		$("#main_form").attr("action","iframe_category_add.php");
		$("#main_form").submit();
	});

	$(".cate_lv").click(function(){

		$(".on_now").toggleClass("on_now");
		$(this).toggleClass("on_now");

		$("input[name='cate_info']").val( $(this).attr("id") );
		$("input[name='cate_select']").val( $(this).html() );

		var class_name = $(this).closest("ul").attr("class");
		var lv = class_name.split("_");

		lv[1] = parseInt(lv[1]);

		lv_next = lv[1] + 1;

		$(this).closest("li").find(".level_"+lv_next).toggle();

		$("#main_form").attr("action","iframe_category.php");
		$("#main_form").submit();
	});
});



</script>

<?
require_once("../outline/footer.php");
?>

