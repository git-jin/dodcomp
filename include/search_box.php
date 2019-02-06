<?
$q_category ="
select * from category where 1
and cate_type !='delete'
";
$r_category = dbquery($q_category);
while( $a_category = mysql_fetch_assoc( $r_category )){
		$code_num = strlen($a_category[cate_code] );
		$a_cate_list[$code_num][$a_category[cate_code]] =$a_category; 


}
?>
<div class="search_dv_box">
<form name="search_form" action="">
<table class="table_grid01">
    <tr>
        <th style='width:10%'>카테고리</th>
        <td>
            <div id="dv_cate">
            <select name="cate_search" id="cate_search">                
                <option value="">선택</option>   
                <?foreach($a_cate_list[3] as $cate_k=>$cate_v){
                    ?>
                    <option value="<?=$cate_k;?>"><?=$cate_v[cate_name];?></option>   
                    <?
                }
                ?>
            </select>
            </div>
        </td>
    </tr>
    <tr>
        <th>브랜드</th>
        <td></td>
    </tr>
    <tr>
        <th>상세검색</th>
        <td></td>
    </tr>
    <tr>
        <th></th>
        <td></td>
    </tr>
</table>
</form>

</div>

<script>
$( document ).ready(function() {
    $( "#cate_search" ).change(function() {
        var code = $( "#cate_search" ).val();
        $.ajax({
            type : "POST",
            url : "../include/search_cate_ajax.php",
            data : {code: code} ,
            success: function(data){
                $('#dv_cate').append(data);
            },
            error : function (data) {
                alert('죄송합니다. 잠시 후 다시 시도해주세요.');
                return false;
            }  
                
		});
    });
});
</script>