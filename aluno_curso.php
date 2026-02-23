<?php
include 'conexao.php';
header("Content-Type: application/json");
 
$metodo = $_SERVER['REQUEST_METHOD'];
 
switch ($metodo) {
 
    case 'GET':
        $sql = "
        SELECT
            a.id AS aluno_id,
            a.nome AS aluno,
            c.id AS curso_id,
            c.nome AS curso
        FROM aluno_curso ac
        JOIN aluno a ON ac.aluno_id = a.id
        JOIN curso c ON ac.curso_id = c.id
        ";
        $res = $mysqli->query($sql);
        echo json_encode($res->fetch_all(MYSQLI_ASSOC));
        break;
 
    case 'POST':
        $dados = json_decode(file_get_contents("php://input"), true);
        $stmt = $mysqli->prepare("INSERT INTO aluno_curso (aluno_id, curso_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $dados['aluno_id'], $dados['curso_id']);
        $stmt->execute();
        echo json_encode(["mensagem" => "Matrícula realizada"]);
        break;
 
    case 'DELETE':
        $aluno_id = $_GET['aluno_id'];
        $curso_id = $_GET['curso_id'];
        $stmt = $mysqli->prepare("DELETE FROM aluno_curso WHERE aluno_id=? AND curso_id=?");
        $stmt->bind_param("ii", $aluno_id, $curso_id);
        $stmt->execute();
        echo json_encode(["mensagem" => "Matrícula removida"]);
        break;
}
?>