<?php
require_once "../config/db.php";

$db = new Database();
$conn = $db->getConnection();

switch ($_REQUEST['acao'] ?? '') {
    case 'editar':
        $sql = "UPDATE tbmidia SET
                    nome = :nome,
                    genero = :genero,
                    sinopse = :sinopse,
                    clasInd = :clasInd,
                    anoLanc = :anoLanc,
                    tipo = :tipo,
                    episodio = :episodio
                WHERE codigo = :codigo";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nome'     => $_POST["nome"],
            ':genero'   => $_POST["genero"], 
            ':sinopse'  => $_POST["sinopse"],
            ':clasInd'  => $_POST["clasInd"],
            ':anoLanc'  => $_POST["anoLanc"],
            ':tipo'     => $_POST["tipo"],
            ':episodio' => $_POST["episodio"] ?? null,
            ':codigo'   => $_POST["codigo"]
        ]);

        header("Location: ../view/index.php");
        exit;
}
