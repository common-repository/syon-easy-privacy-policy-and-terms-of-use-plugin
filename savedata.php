<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$content=$_POST['content'];
$content=ltrim(rtrim($content));
$ctype=$_POST['ctype'];
$fname="policy.txt";
if($ctype=="terms")
{
	$fname="terms.txt";
}
	
$f=fopen($fname,"w+");
$f1=fwrite($f,$content);
if($f1)
{
	?>
	<script type="text/javascript">
	this.parent.window.location="<?=$_SERVER['HTTP_REFERER'];?>";
	</script>
	<?
}
?>
</body>
</html>