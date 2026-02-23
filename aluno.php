<?php
include 'conexao.php';
header("Content-Type: application/json");
 
$metodo = $_SERVER['REQUEST_METHOD'];
 
switch ($metodo) {
 
    case 'GET':
        $res = $mysqli->query("SELECT * FROM aluno");
        echo json_encode($res->fetch_all(MYSQLI_ASSOC));
        break;
 
    case 'POST':
        $dados = json_decode(file_get_contents("php://input"), true);
        $stmt = $mysqli->prepare("INSERT INTO aluno (nome, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $dados['nome'], $dados['email']);
        $stmt->execute();
        echo json_encode(["mensagem" => "Aluno criado"]);
        break;
 
    case 'PUT':
        $dados = json_decode(file_get_contents("php://input"), true);
        $stmt = $mysqli->prepare("UPDATE aluno SET nome=?, email=? WHERE id=?");
        $stmt->bind_param("ssi", $dados['nome'], $dados['email'], $dados['id']);
        $stmt->execute();
        echo json_encode(["mensagem" => "Aluno atualizado"]);
        break;
 
    case 'DELETE':
        $id = $_GET['id'];
        $stmt = $mysqli->prepare("DELETE FROM aluno WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo json_encode(["mensagem" => "Aluno excluído"]);
        break;
}
?>