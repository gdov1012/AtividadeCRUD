<?php
require_once "../config/db.php";

$db = new Database();
$conn = $db->getConnection();

$sql = "SELECT * FROM tbmidia";
$stmt = $conn->query($sql);

$qtd = $stmt->rowCount();

if ($qtd > 0) {
    echo "<table class='table table-dark table-hover'>";
    echo "<thead>";
    echo "<tr>
            <th>Código</th>
            <th>Nome</th>
            <th>Gênero</th>
            <th>Sinopse</th>
            <th>Classificação</th>
            <th>Ano</th>
            <th>Tipo</th>
            <th>Episódio</th>
            <th>Ações</th>
          </tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        echo "<tr>";
        echo "<td>" . $row->codigo   . "</td>";
        echo "<td>" . $row->nome     . "</td>";
        echo "<td>" . $row->genero   . "</td>";
        echo "<td>" . $row->sinopse  . "</td>";
        echo "<td>" . $row->clasInd  . "</td>";
        echo "<td>" . $row->anoLanc  . "</td>";
        echo "<td>" . $row->tipo     . "</td>";
        echo "<td>" . $row->episodio . "</td>";
        echo "<td>
                <a href='telacrud.php?codigo=" . $row->codigo . "' class='btn btn-success btn-sm'>Editar</a>
                <a href='../controller/midia-delete.php?acao=deletar&codigo=" . $row->codigo . "' 
                   class='btn btn-danger btn-sm' 
                   onclick=\"return confirm('Tem certeza que deseja excluir?');\">Excluir</a>
              </td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p class='text-light'>Nenhum registro encontrado.</p>";
}
?>
