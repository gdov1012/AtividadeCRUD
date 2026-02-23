<?php
include 'conexao.php';
header("Content-Type: application/json");
 
$metodo = $_SERVER['REQUEST_METHOD'];
 
switch ($metodo) {
 
    case 'GET':
        $res = $mysqli->query("SELECT * FROM curso");
        echo json_encode($res->fetch_all(MYSQLI_ASSOC));
        break;
 
    case 'POST':
        $dados = json_decode(file_get_contents("php://input"), true);
        $stmt = $mysqli->prepare("INSERT INTO curso (nome) VALUES (?)");
        $stmt->bind_param("s", $dados['nome']);
        $stmt->execute();
        echo json_encode(["mensagem" => "Curso criado"]);
        break;
 
    case 'PUT':
        $dados = json_decode(file_get_contents("php://input"), true);
        $stmt = $mysqli->prepare("UPDATE curso SET nome=? WHERE id=?");
        $stmt->bind_param("si", $dados['nome'], $dados['id']);
        $stmt->execute();
        echo json_encode(["mensagem" => "Curso atualizado"]);
        break;
 
    case 'DELETE':
        $id = $_GET['id'];
        $stmt = $mysqli->prepare("DELETE FROM curso WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo json_encode(["mensagem" => "Curso excluído"]);
        break;
}
?>
 