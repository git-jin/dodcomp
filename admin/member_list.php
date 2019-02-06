<?
require_once("../outline/header.php");
require_once("../outline/top_menu.php");


$q_admin_list ="
select * from admin_list
where 1
";
$r_admin_list = dbquery($q_admin_list);
while($a_admin_list = mysql_fetch_assoc($r_admin_list)){
	$a_admin[] = $a_admin_list;
}
?>
<form action="">
    <tabal>
        <tr>
            <td>121211221</td>

        </tr>
    </tabal>

</form>

<table id="table_id" class="display" style="text-align:center;">
    <thead>
        <tr>
            <th>번호</th>
            <th>이름</th>
            <th>아이디</th>
            <th>비밀번호</th>
            <th>직급</th>
            <th>부서</th>
            <th>등급</th>
            <th>날짜</th>
        </tr>
    </thead>
    <tbody>
	<? foreach($a_admin as $admin_k => $admin_v){?>
        <tr>
            <td><?=$admin_v[sn];?></td>
            <td><?=$admin_v[admin_name];?></td>
            <td><?=$admin_v[admin_id];?></td>
            <td><?=$admin_v[admin_pwd];?></td>
            <td><?=$admin_v[admin_rank];?></td>
            <td><?=$admin_v[admin_position];?></td>
            <td><?=$admin_v[admin_type];?></td>
            <td><?=$admin_v[reg_date];?></td>
        </tr>
	<?}?>
    </tbody>
</table>

<script>

</script>
<?


require_once("../outline/footer.php");

?>
