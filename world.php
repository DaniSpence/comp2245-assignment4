<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = $_GET['country'] ?? '';
$lookup = $_GET['lookup'] ?? '';

if ($lookup === 'cities'){
  $stmt = $conn->prepare("
    SELECT cities.name, cities.district, cities.population
    FROM cities
    JOIN countries ON cities.country_code = countries.code
    WHERE countries.name LIKE :country
  ");
  $stmt->execute(['country' => "%$country%"]);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <table>
    <tr>
      <th>City</th>
      <th>District</th>
      <th>Population</th>
    </tr>

    <?php foreach ($result as $row): ?>
      <tr>
        <td><?= $row['name']; ?></td>
        <td><?= $row['district']; ?></td>
        <td><?= $row['population']; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <?php
  exit;
}

if ($country === '') {
  $stmt = $conn->query("SELECT * FROM countries");
} else {
  $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
  $stmt->execute([':country' => "%$country%"]);
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<table>
  <tr>
    <th>Country</th>
    <th>Continent</th>
    <th>Independence Year</th>
    <th>Head of State</th>
  </tr>

  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= $row['name']; ?></td>
      <td><?= $row['continent']; ?></td>
      <td><?= $row['independence_year']; ?></td>
      <td><?= $row['head_of_state']; ?></td>
    </tr>
  <?php endforeach; ?>
</table>

