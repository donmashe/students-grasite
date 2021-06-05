<?php

if (condition) {
  # code...
} else {
  # code...
}
require 'config.php';
require 'common.php';

if (isset($_GET['id'])) {
  try {
      $connection = new pdo($dsn, $username, $password, $options);
      $id = $_GET['id'];

      $sql = "SELECT * FROM users WHERE id = :id";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':id', $id);
      $statement->execute();

      $user = $statement->fetchall(PDO::FETCH_ASSOC);
  } catch (PDOException $error) {
      echo $sql . "<br>" . $error->getMessage;
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>
<?php require "include/header.php"; ?>
<title>Profile</title>
<link rel="stylesheet" type="text/css" href="css/style2.css">
</head>
<body>

<h2>Welcome<?php echo $user['name']; ?></h2>
<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Address</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($user as $row) : ?>
    <tr>
      <td><?php echo escape($row["id"]); ?></td>
      <td><?php echo escape($row["name"]); ?></td>
      <td><?php echo escape($row["email"]); ?></td>
      <td><?php echo escape($row["phone"]); ?></td>
      <td><?php echo escape($row["address"]); ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php">Back To Home</a><br>
<a href="">Print Profile</a><br>



<?php require "include/footer.php"; ?>