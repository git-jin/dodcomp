<?
if( !$_SESSION['admin_id'] ){	MsgViewHref('로그인하셔야 합니다..','../index.php');	exit;	}

?>
<style>
body { margin: 0; 
font-family: "돋움",Dotum,AppleGothic,sans-serif;
}
.zeta-menu-bar {
  background: #434343;
  display: inline-block;
  width: 100%;
  font-size:12px;

}
.zeta-menu { margin: 0; padding: 0; }
.zeta-menu li {
  list-style:none;
  position: relative;
}

.zeta-left li {
  float: left;
}
.zeta-right li {
  float: right;
}

.zeta-menu li{
	line-height:40px;
	padding:0px 14px;
}
.zeta-menu li:hover {}
.zeta-menu li.expand { background: white; }
.zeta-menu li.expand>a { color: black; }
.zeta-menu a {
  color: white;
  display: block;
  
  text-decoration: none;
}



.zeta-menu ul {
  background: #FFFFFF;
  border: 1px solid silver;
  display: none;
  padding: 0;
  position: absolute;
  left: 0;
  top: 100%;
  width: 160px;
}
.zeta-menu ul li { 
float: none; 
border-bottom: 1px solid silver;
}
.zeta-menu ul li.expand { background: #ddd; }
.zeta-menu ul li.expand a { color: black; }
.zeta-menu ul a { color: black; }
.zeta-menu ul ul { left: 100%; top: 0; }

.zeta-menu li:hover .zeta-submenu{
	display: block;
}

.zeta-submenu li{
	font-weight:normal;
	line-height:25px;
}

.zeta-submenu li:hover { background: #e5e5e5; color:#fff; font-weight:normal;}


</style>

<?
$q_member_menu = "
select admin_type
from admin_list
where 1
and sn  = '$_SESSION[sn]'
";

$r_member_menu = dbquery( $q_member_menu );
$a_member_menu = mysql_fetch_assoc( $r_member_menu );


$main_explode =  explode( '/',$a_member_menu[admin_type] );
foreach(  $main_explode as $m_explode_val ){
 $a_submenu_sn = explode( ':',$m_explode_val );
foreach( $a_submenu_sn as $submenu_sn_key => $submenu_sn_val ){
	if( $submenu_sn_key == 0 ){

	}else{
		$a_sub_menu_sn[] = $submenu_sn_val;
	}
}

}
if($a_sub_menu_sn){
$sub_menu_implode = implode(  ',',$a_sub_menu_sn );
}
//echo $sub_menu_implode;


$q_main_menu = "
select a.no as menu_sn	,a.menu_title as main_menu	,a.state	,a.menu_sq
,ms.sub_menu_title , sub_filelink
from admin_menu a
join admin_menu_setting ms on ms.sub_menu_type = a.no
where 1
and state = 'using'
order by a.menu_sq,ms.menuLv
";
//echo $q_main_menu;
$r_main_menu = dbquery( $q_main_menu );
while( $a_main_menu = mysql_fetch_assoc( $r_main_menu ) ){
	//$a_menu[ $a_main_menu[menu_sn]][$a_main_menu[setting_sn]] = $a_main_menu;
	$a_menu_name[ $a_main_menu[menu_sn]] = $a_main_menu[main_menu];
	$a_menu[ $a_main_menu[menu_sn]][$a_main_menu[sub_menu_title]] = $a_main_menu;
}
?>
<div class='zeta-menu-bar'>
  <ul class="zeta-menu zeta-left">
    <li style="padding:0px 10px;"><a href="../main/main.php">DODcompany</a></li>
    <?
	foreach( $a_menu_name as $a_menu_key => $a_menu_val ){
	?>

	<li><a href="#<? echo $a_menu_key;?>"><? echo $a_menu_val; ?></a>
		<ul class="zeta-submenu" style="z-index:10">
		<?
		$loop_zeta = 0;
		$loop_menu_zeta = 0;
		foreach($a_menu[$a_menu_key] as $a_menu_sub_key => $a_menu_sub_val ){
			$loop_zeta++;
		?>
		<li style="z-index:9999"><a href="<? echo '../'.$a_menu_sub_val['sub_filelink'] ?>"><? echo $a_menu_sub_val['sub_menu_title'] ?></a></li>
		<?
			if($loop_zeta>15){
				$loop_zeta = 0;
				$loop_menu_zeta++;
				$loop_menu_zeta_left=$loop_menu_zeta*161;;
				echo "</ul><ul class='zeta-submenu' style='z-index:10;left:".$loop_menu_zeta_left."px'>";
			}
		}
		?>
		</ul>
	</li>
	<?
	}


	?>
  </ul>
  <ul class="zeta-menu zeta-right">
<li>
<a href="../main/logout_post.php"><div style="border:1px solid #fff;padding:3px;height:15px;display:inline;background-color:#441316">LOGOUT</div></a>
</li>

  <li >  <a  href="../personal_control/personal_admin_log.php?"><font ><? echo $_SESSION['admin_name']?>님 </a>
</li>
  </ul>
</div>