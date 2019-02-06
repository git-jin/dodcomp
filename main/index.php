<html>
<head>
<title>로그인 페이지</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
.login_main{
text-align:center; 
width:100%; 
height:100%; 
margin-top:10%;
}

input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #B2CCFF;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

</style>
<SCRIPT LANGUAGE="JavaScript">
<!--
fieldlist = [ ["admin_id","아이디"],["admin_passwd","비밀번호"] ];

function chk_login() {
	for (i = 0; i < fieldlist.length; i++)
	{
		if(eval("login_form." + fieldlist[i][0] + ".value.split(' ').join('')") == '') {
			alert(fieldlist[i][1] + "를 입력해 주세요.");
			eval("login_form." + fieldlist[i][0]).focus();
			return false;
		}
	}
	return true;
}
//-->
</SCRIPT>
</head>
<body marginheight="0" marginwidth="0" onLoad="login_form.admin_id.focus();">
	<form name="login_form" action="login_post.php" method='post' onSubmit="return chk_login();" style="margin:0px">
		<div class="login_main">
			<div style="width:30%; height:50%; margin:auto; border:solid 1px #eeee;" >
				<div style=" font-weight: bold;font-size:50px; color:#A6A6A6;">
				DodCompany
				</div>
				<div style="margin-top:100px">
					<label for="fname">ID</label>
					<input type="text" id="fname" name="admin_id" placeholder="Your id..">
					<label for="lname">PASSWORD</label>
					<input type="password" id="lname" name="admin_passwd" placeholder="Your password..">  
					<input type="submit" value="로그인">
				</div>
			</div>
		</div>
	</form>
</body>
</html>
