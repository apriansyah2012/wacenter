<?php
 $koneksi = mysqli_connect("localhost", "root", "", "wa_blast") 
    or die("Error ".mysqli_error($koneksi));
// Check connection
if ($koneksi->connect_error) {
    die("Connection failed:".$koneksi->connect_error);
}
$id = $_POST['id'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$spasi='
';
$sql = "INSERT INTO whatsapp_inbox (unik,pengirim,pesan) VALUES ('$id','$phone','$message')";
if ($koneksi->query($sql) === TRUE) {
    echo null;
} else {
    echo "Error: " . $sql . "" . $koneksi->error;
}

?>
