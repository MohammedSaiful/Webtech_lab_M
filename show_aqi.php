<?php
session_start();

// Connect to DB
$conn = new mysqli("localhost", "root", "", "registration");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Countries - AQI Viewer</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .country-list { margin-bottom: 20px; }
        .country-item { margin: 5px 0; }
        .aqi-table { border-collapse: collapse; width: 50%; }
        .aqi-table th, .aqi-table td { border: 1px solid #ccc; padding: 8px; text-align: center; }
    </style>
</head>
<body>

<h2>Air Quality Index (AQI) Viewer</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_countries'])) {
    $selected = $_POST['selected_countries'];

    if (count($selected) > 10) {
        echo "<p style='color:red;'>Please select only 10 countries.</p>";
    } elseif (count($selected) === 0) {
        echo "<p style='color:red;'>No country selected.</p>";
    } else {
        // Show selected countries' AQI
        $placeholders = implode(',', array_fill(0, count($selected), '?'));
        $stmt = $conn->prepare("SELECT `Country/Area`, `AQI` FROM air_quality_index WHERE `Country/Area` IN ($placeholders)");
        $stmt->bind_param(str_repeat('s', count($selected)), ...$selected);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<h3>Selected Countries' AQI</h3>";
        echo "<table class='aqi-table'><tr><th>Country/Area</th><th>AQI</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['Country/Area']}</td><td>{$row['AQI']}</td></tr>";
        }
        echo "</table>";
        $stmt->close();
    }

    echo "<br><a href='show_aqi.php'>← Back to selection</a>";

} else {
    // Show first 20 countries
    $sql = "SELECT `Country/Area` FROM air_quality_index LIMIT 20";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<form method='post'>";
        echo "<div class='country-list'>";
        while ($row = $result->fetch_assoc()) {
            $country = htmlspecialchars($row['Country/Area']);
            echo "<div class='country-item'>
                    <input type='checkbox' name='selected_countries[]' value=\"$country\">
                    $country
                  </div>";
        }
        echo "</div>";
        echo "<input type='submit' value='OK'>";
        echo "</form>";
    } else {
        echo "<p>No countries found in the database.</p>";
    }
}

$conn->close();
?>

</body>
</html>
