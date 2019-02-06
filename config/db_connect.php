<?php
require_once("db_info.php");
if(!$dbconn){
	$dbconn = mysql_connect($db_location,$db_id,$db_passwd);
	mysql_query(" set names utf8 "); //euckr
	$status = mysql_select_db($db_name,$dbconn);
	if (!$status) {
	   error("DB_ERROR");
	   exit;
	}

	function err_chk($states){
		if(!$states){
			$errno = mysql_errno();
			$errmsg = mysql_error();

			echo $errno . " : " . $errmsg . "<br>";
			exit;
		}
	}

	// mysql_query function
	function DBquery($query)
	{
		global $dbconn;
		$arr_chk = explode(" ",trim( $query ) );

		if( strtolower($arr_chk[0]) != "select"){
//			debug( '$arr_chk[0]' , $arr_chk[0] );
			debug( 'no_select', $query );
		}

		$qry = mysql_query($query,$dbconn) or die( debug( mysql_error() , $query ) );
		return $qry;
	}

	// mysql_fetch_array function
	function DBarray($qry)
	{
		$result = DBquery($qry);
		return mysql_fetch_array($result);
	}

	// mysql_affected_rows function
	function DBaffected($qry)
	{
		$result = DBquery($qry);
		return mysql_affected_rows();
	}

	//디비 데이터 삭제
	function delete_table($table_name, $field_name, $value){
		$query = "delete from $table_name where $field_name = '$value' ";
		$result = mysql_query($query);
		err_chk($result);
	}

	// ??
	function IsTable($table_name)
	{
		global $dataname;
		$result = mysql_list_tables ($dataname);
		$ReturnValue=0;
		while( $tables = mysql_fetch_array($result) )
		{
			if($table_name==$tables[0]) $ReturnValue=1;
		}
		return $ReturnValue;
	}
}

?>
