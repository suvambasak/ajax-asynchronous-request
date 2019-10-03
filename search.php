<?php
$con = mysqli_connect("localhost", "root", "", "test");
	
if (!$con) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


if(isset($_POST["query"])){
	$output = '';
	$sql = "SELECT * FROM `apps_countries` WHERE country_name LIKE '".$_POST["query"]."%'";
	$result = mysqli_query($con,$sql);
	$output = '<ul class="list-unstyled">';

	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			$output .='<li>'.$row["country_name"].'</li>';
		}
	}else{
		$output .= '<li>Not Found</li>';
	}

	$output .= '</ul>';
	echo $output;
}
else{
	
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		$output = '';
		$sql = "SELECT * FROM `apps_countries` WHERE country_name LIKE '%".$_GET["query"]."%'";
		$result = mysqli_query($con,$sql);
		$output = '<ul class="list-unstyled">';

		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				$output .='<li>'.$row["country_name"].'</li>';
			}
		}else{
			$output .= '<li>Not Found</li>';
		}

		$output .= '</ul>';
		echo $output;
	}
}
?>