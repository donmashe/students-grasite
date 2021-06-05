
   <?php include 'include/header.php'; ?> 
<title>Register</title>
   <link rel="stylesheet" type="text/css" href="css/style1.css">
<head>
</head>
<?php
if (isset($_POST['submit'])) {
    require "config.php";
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $new_user = array(
            "name" => $_POST['name'],
            "email"    => $_POST['email'],
            "password" => $_POST['password'],
            "phone"    => $_POST['phone'],
            "address"  => $_POST['address']  
          );
          
        $sql ="INSERT INTO users (name, email, password, phone, address) values ( :name, :email, :password, :phone, :address)";
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);

           } 
           catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
          }
        }
?>

<?php include "common.php"; ?>
 <div id="success">
<?php if (isset($_POST['submit']) && $statement) { 
   echo escape($_POST['name']); ?> successfully added. 
 <?php } ?>
</div>
 <br>
 <body>
  <h2><p style="text-align:center">Register New User</p></h2><br/>
 <div id="container">
  <form method="post">
      <label for="name">Name</label>
      <input type="text" name="name" id="name" size="40">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" size="40">
    	<label for="password">Password</label>
    	<input type="password" name="password" id="password" size="40">
    	<label for="phone">Phone</label>
      <input type="text" name="phone" id="phone" size="40">
      <label for="address">Address</label>
    	<input type="text" name="address" id="address" size="40">
       </div>
       <p style="text-align:center"><input type="submit" name="submit" value="Submit" id="submit"></p>
       <p style="text-align:center"><a href="index.php">Back to Home</a>
    </form>
    </body>
    <?php include 'include/footer.php'; ?>