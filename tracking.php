<?php
 $koneksi = mysqli_connect("localhost", "root", "", "wa_blast") 
    or die("Error ".mysqli_error($koneksi));
// Check connection
if ($koneksi->connect_error) {
    die("Connection failed:".$koneksi->connect_error);
}
$id = $_POST['id'];
$phone = $_POST['phone'];
$status = $_POST['status'];
$device_id=$_POST['device_id'];
$spasi='
';
$sql = "INSERT INTO group_inbox (unik,pengirim,pesan,device_id) VALUES ('$id','$phone','$status','$device_id')";
if ($koneksi->query($sql) === TRUE) {
    echo null;
} else {
    echo "Error: " . $sql . "" . $koneksi->error;
}

?>