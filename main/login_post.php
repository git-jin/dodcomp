<?
header('Content-type: text/html; charset=utf-8');

require_once '../config/db_connect.php';
session_start();

$queryChk = "
SELECT *
FROM `admin_list`
where admin_type > 0
and admin_id = '$_POST[admin_id]'
";
$result_chk = dbquery($queryChk);
$RSs = mysql_num_rows($result_chk);
$RS = mysql_fetch_array($result_chk);

if($RSs <= 0){
	?>
	<script>
	alert("아이디가 존재하지않습니다.");
	history.go(-1);
	</script>
	<?
	exit;
}else{



	if($RS['admin_pwd'] == $_POST['admin_passwd'] ){		

		$_SESSION	= $RS ;
//	print_r( $_SESSION	);		die;

//$_SESSION['']

		debug( 'login' ,$RS['admin_name'] );


		
		$q_login	= "
		select login_sn
		from login
		where d_login	= curdate()
		and remote_addr	= '$_SERVER[REMOTE_ADDR]'
		and member_sn	= $RS[sn]
		";

		$r_login	= dbquery( $q_login );
		if( !mysql_num_rows($r_login ) ){
			$q_login	= "
			insert into login(
			member_sn	,d_login		,t_login		,remote_addr				,http_user_agent
			) values(
			$RS[sn]		,curdate()		,curtime()		,'$_SERVER[REMOTE_ADDR]'	,'$_SERVER[HTTP_USER_AGENT]'
			)
			";
			$r_login	= dbquery( $q_login );
		}
		$default_url	= '../main/main.php' ;

		?>
		
		<script>
		alert( "<? echo $_SESSION['admin_name']; ?>님 환영합니다." );
		location.href= "<? echo $default_url; ?>";
		</script>
		<?
		exit;
	}else{
		?>
		<script>
		alert("비밀번호를 잘못 입력했습니다.다시확인해주세요");
		history.go(-1);
		</script>
		<?
		exit;
	}

}

?>