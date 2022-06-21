<?php

$baglanti=new mysqli("localhost", "root", "", "deneme");

if ($baglanti->connect_error) 
{
  die("baglantı başarısız " . $conn->connect_error);
}


$ID = $_GET['id'];
$delete = "DELETE FROM uyeler WHERE id='$ID'";
 
if ($baglanti->query($delete) === TRUE) {
  header('Location: index.php');
}
else
{
    echo "Hata" . $baglanti->error;;
}

