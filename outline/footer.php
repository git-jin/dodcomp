
<script type="text/javascript">
function common_pop(link,name,width,height){

	if(!width) width = '600';
	if(!height) height = '500';

	var pop = window.open(link,name,'resizable=yes,fullscreen=no,menubar=no,status=no,toolbar=no,titlebar=no,location=no,scrollbars=yes,top=300,left=500,width='+width+',height='+height);
	if(pop)pop.focus();
	
}
function comma(x)
{
	var temp = "";
	var x = String(uncomma(x));

	num_len = x.length;
	co = 3;
	while (num_len>0){
		num_len = num_len - co;
		if (num_len<0){
			co = num_len + co;
			num_len = 0;
		}
		temp = ","+x.substr(num_len,co)+temp;
	}
	return temp.substr(1);
}

function uncomma(x)
{
	var reg = /(,)*/g;
	x = parseInt(String(x).replace(reg,""));
	return (isNaN(x)) ? 0 : x;
}

$(document).ready( function () {

	$('#table_id').DataTable();
} );

$(document).ready(function() {

	$(document).on("dblclick",".clz_dblclk",function(e){
		$(this).css("display","none");
	});

	//이미지 확대보기
	$(document).on("mouseover",".goods_img_view",function(e){

		var img_src = $(this).find("img").attr("src");
		var img_top = $(window).scrollTop() + 100;
		var img_left = e.pageX + 100;

		$("#hidden_img_layer").html("<img src='"+img_src+"' />");
		$("#hidden_img_layer").css({"display":"block","top":img_top+"px","left":img_left+"px"});
	}).on("mouseout",".goods_img_view",function(){

		$("#hidden_img_layer").css("display","none");
	});




	//넘버만
	$(document).on("keyup", ".number_only", function() {
		$(this).val( $(this).val().replace(/[^0-9]/gi,"") );
	}); 

	//상세 이미지 팝업
	$(document).on("click",".goods_img_view",function(e){

		var img_src = $(this).find("img").attr("src");
		var img_top = $(window).scrollTop() + 100;
		var img_left = e.pageX + 100;

		img_src =  img_src.split('/');

		var len = img_src.length;

		window.open("../goods/img_detail_pop.php?brand="+img_src[len-3]+"&cate="+img_src[len-2]+"&img_name="+img_src[len-1],'','resizable=yes,fullscreen=no,menubar=no,status=no,toolbar=no,titlebar=no,location=no,scrollbars=yes,top=300,left=500,width=800,height=1000');
	});
	//상세 이미지 팝업 (확대이미지 안나옴)




	//달력
    $( ".datepicker_common" ).datepicker({
		changeMonth: true,
	    changeYear: true,
		dateFormat: "yy-mm-dd",
		numberOfMonths: 1,
		showButtonPanel: true
		,onSelect:function(){
			var date = $(this).val();
			var arr_date = date.split("-");
			var lastDate = (new Date(arr_date[0], arr_date[1], "")).getDate();

			var now_date = new Date();
			var now_year = now_date.getFullYear();
			var now_month = now_date.getMonth();
			var now_day = now_date.getDate();

			if(arr_date[0] == now_year && eval(arr_date[1]) == (now_month+1) ){
				lastDate = now_day;
			}

			$(this).next("input[name='s_date[]']").val(arr_date[0]+"-"+arr_date[1]+"-"+lastDate);
		}
	});
});

function chk_all_box(obj,class_name){

	var chk_val = obj.checked;

	$("."+class_name+":not(:disabled)").prop("checked",chk_val);
}


function common_cal(str){

	var sDay = new Date();
	var Year = sDay.getFullYear();
	var Month = sDay.getMonth()+1;
	var Day = sDay.getDate();

	var Hour = sDay.getHours();
	var mm = sDay.getMinutes();

	var ToDay = Year +"-"+ Month +"-"+ Day;
	var makeDay = new Date(new Date().getYear(), new Date().getMonth(), new Date().getDate() - str+1);

	Year = makeDay.getFullYear();
	Year = ( parseInt( Year ) > 1900 )? Year : parseInt( Year ) + 1900 ; // for chrome

	Month = makeDay.getMonth() + 1;
	Day = makeDay.getDate();

	var makeDay = Year +"-"+ Month +"-"+ Day;

	$("input[name='s_date']").val(makeDay);
	$("input[name='e_date']").val(ToDay);
}



$( document ).ajaxStart(function() {
    //마우스 커서를 로딩 중 커서로 변경
    $('html').css("cursor", "wait"); 
});
$( document ).ajaxStop(function() {
    //마우스 커서를 원래대로 돌린다
    $('html').css("cursor", "auto"); 
});

</script>
</body>
</html>
