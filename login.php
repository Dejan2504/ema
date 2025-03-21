<form action="login.php" method="POST">
    Unesi ime:
    <br>
    <input type="text" name="ime">
    <br>
    Unesi prezime:
    <br>
    <input type="text" name="prezime">
    <br>
    Unesi lozinku:
    <br>
    <input type="text" name="lozinka">
    <br>
    Unesi email:
    <br>
    <input type="text" name="email">
    <br>
    <input type="submit" value="PRIJAVI SE">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ime'], $_POST['prezime'], $_POST['lozinka'], $_POST['email'])) {
        $Ime = $_POST['ime'];
        $Prezime = $_POST['prezime'];
        $Lozinka = $_POST['lozinka'];
        $Email = $_POST['email'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "majice";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Konekcija nije uspela: " . mysqli_connect_error());
        }

        $upit = "SELECT ime, prezime FROM users WHERE email='$Email' AND lozinka='$Lozinka'";
        $rez = mysqli_query($conn, $upit);

        if (mysqli_num_rows($rez) > 0) {
            $row = mysqli_fetch_assoc($rez);
            $_SESSION['ime'] = $row['ime'];
            $_SESSION['prezime'] = $row['prezime'];

            echo "Dobrodošao/la, " . $row['ime'] . " " . $row['prezime'] . "! <br>";
            echo "<a href='index.html'>Idi na početnu stranicu</a>";
        } else {
            echo "Greška: Pogrešan email ili lozinka. Pokušajte ponovo.";
        }

        mysqli_close($conn);
    } else {
        echo "Greška: Sva polja su obavezna!";
    }
}
?>