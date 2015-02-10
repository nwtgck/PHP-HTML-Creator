

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<?php

	require_once "element.php";
				
	$div = e("div")->add(
		text("hello world")
	);

	echo $div;


	$table = e("table")->attr("border", 1)->
		add(e("tr")->add(
			e("td")
		))->
		add(e("tr")->add(
			e("td")
		));

	echo $table->indented();


	// Output:
	// <div >
	// 	hello world
	// </div>

	// 	<table border="1" >
	// 		<tr >
	// 			<td >
	// 			</td>
	// 		</tr>
	// 		<tr >
	// 			<td >
	// 			</td>
	// 		</tr>
	// 	</table>
	
?>
</body>
</html>