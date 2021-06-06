<?php
if (!isset($_SESSION)) {
  session_start();
}

require "config.php";
require "common.php";

if (isset($_POST['submit'])) {
  try {
      $connection = new PDO($dsn, $username, $password, $options);  
      $user = array(
        "id" => $_POST['id'],
      "name" => $_POST['name'],
      "email" => $_POST['email'],
      "password" => $_POST['password'],
      "phone" => $_POST['phone'],
      "address"=> $_POST['address'] 
      );
      $sql = "UPDATE users 
              SET id = :id, 
                name = :name,  
                email = :email, 
                password = :password, 
                phone = :phone, 
                address = :address 
              WHERE id = :id";
    
    $statement = $connection->prepare($sql);
    $statement->execute($user);
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['id'])) {
  try {
      $connection = new pdo($dsn, $username, $password, $options);
      $id = $_GET['id'];

      $sql = "SELECT * FROM users WHERE id = :id";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':id', $id);
      $statement->execute();

      $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $error) {
      echo $sql . "<br>" . $error->getMessage;
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "include/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote><?php echo escape($_POST['name']); ?> successfully updated.</blockquote>
<?php endif; ?>

<h2>Edit a user</h2>

<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
  <?php foreach ($user as $key => $value) : ?>
  <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	<input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
  <?php endforeach; ?> 
  <input type="submit" name="submit" value="Submit">
</form>
  
<a href="index.php">Back to home</a>

<?php require "include/footer.php"; ?>
