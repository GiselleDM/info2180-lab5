<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'Password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
if(isset($_GET['country'])) {
    $country = $_GET['country'];
    if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
        $stmt = $conn->prepare("SELECT Name, District, Population FROM city WHERE CountryCode = (SELECT Code FROM country WHERE Name = :country)");
        $stmt->bindParam(':country', $country);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results && count($results) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Name</th><th>District</th><th>Population</th></tr>";
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "<td>" . $row['District'] . "</td>";
                echo "<td>" . $row['Population'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No cities found for the specified country.";
        }
    } else {
        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
        $stmt->bindValue(':country', '%' . $country . '%');
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($results && count($results) > 0) {
            echo "<ul>";
            foreach ($results as $row) {
                echo "<li>" . $row['name'] . ' is ruled by ' . $row['head_of_state'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "No countries found matching the search criteria.";
        }
    }
} else {
    echo "Please provide a country name.";
}
?>
