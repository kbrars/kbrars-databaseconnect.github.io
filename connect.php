<?php

$baglanti=new mysqli("localhost", "root", "", "deneme");

if ($baglanti->connect_error) 
{
  die("baglantı başarısız " . $conn->connect_error);
}
?>