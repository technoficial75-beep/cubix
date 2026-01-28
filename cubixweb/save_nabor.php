<?php
// Táto cesta vytvorí priečinok priamo tam, kde máš web
$basePath = "aplications/";

// Získanie dát
$role    = $_POST['role']    ?? 'Ostatne';
$nick    = $_POST['nick']    ?? 'Anonym';
$age     = $_POST['age']     ?? '0';
$discord = $_POST['discord'] ?? 'Neznamy';
$message = $_POST['message'] ?? '';

// 1. Vytvor hlavný priečinok 'aplications', ak neexistuje
if (!file_exists($basePath)) {
    mkdir($basePath, 0777, true);
}

// 2. Vytvor priečinok pre konkrétnu rolu
$rolePath = $basePath . $role . "/";
if (!file_exists($rolePath)) {
    mkdir($rolePath, 0777, true);
}

// 3. Obsah súboru
$content = "Meno: $nick\nVek: $age\nDiscord: $discord\nSprava: $message";

// 4. Uloženie (názov súboru bude napr. Steve_12345.txt)
$fileName = $rolePath . preg_replace('/[^A-Za-z0-9]/', '', $nick) . "_" . time() . ".txt";

if (file_put_contents($fileName, $content)) {
    echo "OK";
} else {
    header('HTTP/1.1 500 Internal Server Error');
    echo "Chyba pri zapise";
}
?>