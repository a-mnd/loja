<?php
$host = "localhost";
$banco = "banco";
$user = "root";
$senha = "";
$conexaodois = new PDO("mysql:host=$host;dbname=$banco", $user, $senha);
if(!$conexaodois) {
    echo "Não foi :(";
}