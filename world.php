<?php
$host = getenv('IP');
$username = 'lab7_user';
$password = 'RHacked@2017';
$dbname = 'world';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
	if((isset($_GET['country']) or !empty($_GET['country'])) and (empty($_GET['context']) or !isset($_GET['context']))){
		$countries = filter_var($GET['country'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);;
		$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
		$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		echo "<table>";
		echo "<tr>";
		echo "<th>Country Name </th>";
		echo "<th>Continent</th>";
		echo "<th> Independence Year </th>";
		echo "<th>Head of State </th>";
		echo "</tr>";
		foreach($results as $row){
			$c_name = $row['name'];
			$continent = $row['continent'];
			$i_year = $row['independence_year'];
			$head_state = $row['head_of_state'];
			echo "<tr>";
			echo "<td>$c_name</td>";
			echo "<td>$continent</td>";
			echo "<td>$i_year</td>";
			echo "<td>$head_state</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else if ((isset($_GET['country']) or !empty($_GET['country'])) and (!empty($_GET['context']) or isset($_GET['context']))) {
	    $countries = filter_var($_GET['country'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
	    #explain the line below
	    $stmt = $conn->query("SELECT c.name as city, c.district, c.population, cs.name as country FROM cities c join countries cs on c.country_code = cs.code WHERE cs.name = '$country'");
	    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	    if(!empty($results)) {
	      echo "<table>";
	      echo "<tr>";
	      echo "<th>City Name</th>";
	      echo "<th>District</th>";
	      echo "<th>Population</th>";
	      echo "</tr>";
	      foreach($results as $row) {
	        $cName = $row['city'];
	        $dis = $row['district'];
	        $pop = $row['population'];
	        echo "<tr>";
	        echo "<td>$cName</td>";
	        echo "<td>$dis</td>";
	        echo "<td>$pop</td>";
	        echo "</tr>";
	      }
	      echo "</table>";
		}else {
			echo "<h3> No cities found</h3>"
		}
	}
}