<?php 
session_start();
$hst = "sql213.infinityfree.com";
$name = "if0_35559466";
$psw = "zUyaFaAZhcFe";
$dbname = "if0_35559466_guvi";
$str = "mysql:host=" . $hst . ";dbname=" . $dbname;
$con = new PDO($str, $name, $psw);

$username = $_POST["username"];
$dob = $_POST["dob"];
$age = $_POST["age"];
$contact = $_POST["contact"];
$email = $_POST["email"];
//$rawPassword = $_POST["password"];
//$password = password_hash($rawPassword, PASSWORD_DEFAULT);
$password = $_POST["password"];

// Check if the email already exists in the database
$emailExistsQuery = "SELECT COUNT(*) FROM login WHERE email = :email";
$stmt = $con->prepare($emailExistsQuery);
$stmt->bindParam(':email', $email);
$stmt->execute();
$emailExists = $stmt->fetchColumn();

if ($emailExists) {
  echo "Email '$email' already exists.";
} else {
  $sql = "INSERT INTO login (username, dob, age, contact, email, password) VALUES (:username, :dob, :age, :contact, :email, :password)";
  $stmt = $con->prepare($sql);
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':dob', $dob);
  $stmt->bindParam(':age', $age);
  $stmt->bindParam(':contact', $contact);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':password', $password);

  if ($stmt->execute()) {
    echo "save data";
  } else {
    echo "error";
  }
}

?>