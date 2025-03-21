<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "majice";

// Konekcija sa bazom
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Konekcija nije uspela: " . $conn->connect_error);
}

// Proveravamo da li su podaci poslati
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_name'], $_POST['product_price'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = (float)$_POST['product_price'];

    $sql = "INSERT INTO narudzbe (naziv, cijena) VALUES ('$product_name', '$product_price')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<h2>Narudžba uspešno primljena!</h2>";
        echo "<p>Vaša narudžba za <strong>$product_name</strong> po ceni od <strong>$product_price KM</strong> je uspešno zabeležena.</p>";
        echo "<a href='index.html'>Vrati se u shop</a>";
    } else {
        echo "Greška: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Greška: Podaci nisu poslati.";
}

$conn->close();
?>