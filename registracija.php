<form action="registracija.php" method="POST">
    UNESI IME:
    <br>
    <input type="text" name="ime">
    <br>
    UNESI PREZIME:
    <br>
    <input type="text" name="prezime">
    <br>
    UNESI ADRESU:
    <br>
    <input type="text" name="adresa">
    <br>
    UNESI E-MAIL:
    <br>
    <input type="text" name="email">
    <br>
    UNESI LOZINKU:
    <br>
    <input type="text" name="lozinka">
    <br>
    <input type="submit" value="REGISTRUJ SE">
</form>
<?php


$servername="localhost";
$username="root";
$password="";
$dbname="majice";
$conn=mysqli_connect("localhost","root","","majice");

if (!$conn) {
    die("Konekcija nije uspela: " . mysqli_connect_error());
}

if (isset($_POST['ime'], $_POST['prezime'], $_POST['adresa'], $_POST['email'], $_POST['lozinka']) &&
    !empty($_POST['ime']) && !empty($_POST['prezime']) && !empty($_POST['adresa']) && !empty($_POST['email']) && !empty($_POST['lozinka'])){
        
$Ime=$_POST['ime'];
$Prezime=$_POST['prezime'];
$Adresa=$_POST['adresa'];
$E_mail=$_POST['email'];
$Lozinka=$_POST['lozinka'];

$upit="INSERT INTO users (ime,prezime,adresa,email,lozinka) VALUES ('$Ime','$Prezime','$Adresa','$E_mail', '$Lozinka')" ;
$rez=mysqli_query($conn,$upit);

if (!$rez) {
    echo "Greška pri unosu: " . mysqli_error($conn);
} else {
    echo "Uspešno registrovan korisnik!";
}
} else {
echo "Molimo popunite sva polja.";
}

?>