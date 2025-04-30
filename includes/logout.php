<?php
session_start();
unset($_SESSION["id"]);

header("Location: ../php/loginPokemon.php");

die();
