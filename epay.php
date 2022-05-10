<!DOCTYPE html>
<html>
<head>
	<title>epay</title>
</head>
<body>

<?php

$key="683aff8da855dbae0301173f4f1fdb0cb1734c78";
$token="953fc21e70461902b27d49b31b195c482f88fbf8";
$sign=md5($token.$key);
$datetrans=date('Y-m-d H:i:s');

?>


	<form method="POST" action="https://epaycongo.com/payment">
		
		
		<input type="text" name="signature" value="<?php echo $sign ?>">
		<input type="text" name="amount" value="100">
		<input type="text" name="acid" value="171">
		<input type="text" name="emailId" value="dv.balenvokolo@gmail.com">
		<input type="text" name="successurl" value="http://localhost/mydoctorhome/epay.php">
		<input type="text" name="cancelurl" value="http://localhost/mydoctorhome/epay.php">
		<input type="text" name="currency" value="CFA">
		<input type="text" name="Reference" value="1">
		<input type="submit" value="submit">



	</form>

</body>
</html>