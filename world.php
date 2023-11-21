<?php
$host = 'localhost';
$username = 'lab5_user';
$password = '';
$dbname = 'world';

// Check if the 'country' parameter is provided in the URL
if (isset($_GET['country'])) {
    $country = $_GET['country'];

    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name = :country");
    $stmt->bindParam(':country', $country, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Display country details
        echo "<h1>{$result['name']}</h1>";
        echo "<p>Population: {$result['population']}</p>";
        echo "<p>Head of State: {$result['head_of_state']}</p>";
        // Add more information as needed
    } else {
        // Country not found
        echo "<p>Country not found</p>";
    }
} else {
    // Handle if 'country' parameter is not provided
    echo "<p>Please provide a 'country' parameter in the URL.</p>";
}
?>
