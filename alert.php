<?php
function error ($msg)
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
<?
	exit;
}
?>
