<?php
session_start();

function isLogin()
{
  if(!isset($_SESSION['logged'])){
    header('Location: index.php');
  }
}
