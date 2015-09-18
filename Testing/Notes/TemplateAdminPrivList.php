<?php

include("functions.php");
connectSQL();


$updated = FALSE;
if(count($_POST) > 0){
    $admin = $_POST['admin'];
    array_map('intval',$admin);
    $admin = implode(',',$admin);
    mysql_query("UPDATE tutorial_users SET admin=0") or trigger_error(mysql_error(),E_USER_ERROR);
    mysql_query("UPDATE tutorial_users SET admin=1 WHERE id IN ($admin)") or trigger_error(mysql_error(),E_USER_ERROR);
    $updated=TRUE;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>dirtydeedscleaners.com</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php
if($updated===TRUE){
    echo '<div>Privileges Updated!</div>';
}
?>
<table>
<tr>
<th>Username</th>
<th>Admin Privileges</th>
</tr>
<?php
$sql = "SELECT id,username,admin FROM tutorial_users ORDER by id ASC";
$result = mysql_query($sql) or trigger_error(mysql_error(),E_USER_ERROR);
while(list($id,$username,$admin)=mysql_fetch_row($result)){
    $checked = ($admin==1) ? 'checked="checked"' : '';
    echo '<tr><td>'.$username.'</td><td><input type="checkbox" name="admin[]" value="'.$id.'" '.$checked.'/></td></tr>'."\n";
}
?>
<tr><td colspan="2"><input type="submit" name="submit" value="Update Privileges" /></td></tr>
</table>
</form>
</body>
</html>