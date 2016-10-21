<?php
function errorFunc($msg)
{
?>
<html>
<head>
	<script language="javascript">
	<!--
		alert("<?=$msg?>");
	history.back();
	//-->
		</script>
</head>
<body>
</body>
</html>
<?php
	exit;
}
?>
