<?php
session_start();
if(isset($_SESSION['mail'])){
	unset($_SESSION['mail']);
}
if(isset($_SESSION['matricule'])){
	unset($_SESSION['matricule']);
}
header('Location: ../');