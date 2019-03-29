<?php
session_start();

$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'foroEasylito'
) or die(mysqli_erro($mysqli));

?>
