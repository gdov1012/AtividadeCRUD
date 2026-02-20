<?php
  session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../model/FilmeModel.php';
require_once __DIR__ . '/../model/SerieModel.php';
require_once __DIR__ . '/../controller/midia-update.php';
$db = new Database();
$conn = $db->getConnection();

$midia = null;
if (isset($_GET['codigo']) && $_GET['codigo'] !== '') {
    $sql = "SELECT * FROM tbmidia WHERE codigo = :codigo";
    $stmt = $conn->prepare($sql);
    $stmt->execute([":codigo" => $_GET['codigo']]);
    $midia = $stmt->fetch(PDO::FETCH_OBJ);
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar mídia</title>

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="estilos/estilo.css">
</head>

<body>
    <div class="">

        <div class="topo">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            <a class="nav-link" href="telaformulariofilme.php">Adicionar</a>

                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <div class="container py-4">
            <?php if (!$midia): ?>
            <div class="alert alert-warning">
                Mídia não encontrada ou código ausente.
            </div>
            <?php else: ?>
            <div class="mb-3">
                <form action="../controller/midia-update.php" method="post" class="card p-3">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="codigo" value="<?php echo $midia->codigo; ?>">

                    <div class="mb-3">
                        <label>Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control"
                            value="<?php echo $midia->nome ?? ''; ?>">
                    </div>

                    <div class="mb-3">
                           <div class="mb-3">
        <label>Gênero</label>
        <select class="form-select" name="genero" required>
            <option value="Acao">Ação</option>
            <option value="Aventura">Aventura</option>
            <option value="Animacao">Animação</option>
            <option value="Comedia">Comédia</option>
            <option value="Drama">Drama</option>
            <option value="Ficcao Cientifica">Ficção Científica</option>
            <option value="Fantasia">Fantasia</option>
            <option value="Terror">Terror</option>
            <option value="Romance">Romance</option>
            <option value="Musical">Musical</option>
            <option value="Suspense">Suspense</option>
            <option value="Documentario">Documentário</option>
        </select>
    </div>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Sinopse</label>
                        <input class="form-control" type="text" name="sinopse"
                            value="<?php echo $midia->sinopse ?? ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label>Classificação</label>
                        <select name="clasInd" class="form-select" required>
                            <option value="Livre" <?php if (($midia->clasInd ?? '') == 'Livre') echo 'selected'; ?>>
                                L</option>
                            <option value="10" <?php if (($midia->clasInd ?? '') == '10') echo 'selected'; ?>>10
                            </option>
                            <option value="12" <?php if (($midia->clasInd ?? '') == '12') echo 'selected'; ?>>12
                            </option>
                            <option value="14" <?php if (($midia->clasInd ?? '') == '14') echo 'selected'; ?>>14
                            </option>
                            <option value="16" <?php if (($midia->clasInd ?? '') == '16') echo 'selected'; ?>>16
                            </option>
                            <option value="18" <?php if (($midia->clasInd ?? '') == '18') echo 'selected'; ?>>18
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Ano de lançamento</label>
                        <input class="form-control" type="number" min="1940" maxlength="4" name="anoLanc" id="anoLanc"
                            value="<?php echo $midia->anoLanc ?? ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label>Tipo</label>
                        <select name="tipo" id="tipo" class="form-select" required>
                            <option value="Filme" <?php if (($midia->tipo ?? '') == 'Filme') echo 'selected'; ?>>Filme
                            </option>
                            <option value="Serie" <?php if (($midia->tipo ?? '') == 'Serie') echo 'selected'; ?>>Série
                            </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Episódios</label>
                        <input class="form-control" type="text" name="episodio" id="episodio"
                            value="<?php echo $midia->episodio ?? ''; ?>">
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-success" type="submit">Salvar</button>
                        <a class="btn btn-secondary" href="index.php">Cancelar</a>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </div>

                <div class="rodape">
            <p class="rodape">Todos os direitos reservados - 2025</p>
        </div>
    </div>

</body>

</html>
</body>

</html>