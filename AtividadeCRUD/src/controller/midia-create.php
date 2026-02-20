<?php
require_once "../config/db.php";

$db = new Database();
$conn = $db->getConnection();

switch ($_REQUEST['acao'] ?? '') {
    case 'adicionar':
        $sql = "INSERT INTO tbmidia (nome, genero, sinopse, clasInd, anoLanc, tipo, episodio) 
                VALUES (:nome, :genero, :sinopse, :clasInd, :anoLanc, :tipo, :episodio)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nome'     => $_POST["nome"],
            ':genero'   => $_POST["genero"],
            ':sinopse'  => $_POST["sinopse"],
            ':clasInd'  => $_POST["clasInd"],
            ':anoLanc'  => $_POST["anoLanc"],
            ':tipo'     => $_POST["tipo"],
            ':episodio' => $_POST["episodio"] ?? null
        ]);

        header("Location: ../view/index.php");
        exit;
}