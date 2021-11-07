<?php
ob_start(); //Turns on output buffering 
session_start();
// include "../functions.php";
$connection = mysqli_connect("localhost", "root", "", "whatsapp");
if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}
include "functions.php";
if(isLoggedIn()){

}