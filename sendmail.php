<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
print_r($_POST);
$uname=ltrim(rtrim(strip_tags($_POST['uname'])));
$umail=trim(strip_tags($_POST['umail']));
$message=ltrim(rtrim(strip_tags($_POST['syonmessage'])));
if($umail)
{
	$to="";
	$from="";
	$subject="Feedback regarding to syon privacy policy plugin";
	$message='<table cellpadding="0" cellspacing="0"><tr><td align="left"><strong>Hello Admin</strong></td></tr>
	<tr><td align="left">You have recieved a feedback/suggestion regarding to syon policy. Here are details about it.</td></tr><tr><td><table cellpadding="0" cellspacing="0"><tr><td width="100"><strong>From </strong></td><td>'.$uname.'</td></tr><tr><td width="100"><strong>Sender mail </strong></td><td>'.$umail.'</td></tr><tr><td width="100" valign="top"><strong>Message </strong></td><td>'.$message.'</td></tr></table></td></tr><tr><td><strong>Regards</strong></td></tr><tr><td></td></tr></table>';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				$headers .= "From:Syon Policy Feedback<$from>" . "\r\n";
				$mail=mail($to,$subject,$message,$headers);
				if($mail)
				{
					?>
					<script type="text/javascript">
					this.parent.location="<?=$_SERVER['HTTP_REFERER'];?>";
					</script>
					<?
				}
}
?>
</body>
</html>