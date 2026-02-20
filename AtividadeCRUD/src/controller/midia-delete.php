
<?php
require_once "../config/db.php";

$db = new Database();
$conn = $db->getConnection();

switch (@$_REQUEST['acao']) {
    case 'deletar':
        $sql = "DELETE FROM tbmidia WHERE codigo = :codigo";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':codigo' => $_REQUEST["codigo"]]);

        header("Location: ../view/index.php");
        exit;
}
