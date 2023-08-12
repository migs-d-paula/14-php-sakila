<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  
  <title>SAKILA</title>
</head>
<body>
  <?php
  
  session_start();

echo '<form action = "pesquisa.php" method = "post">';
echo '<div class="mb-3">';
echo '<label for=" " class="form-label"></label>';
echo '<input type="" class="form-control" name="campo_pesquisa" id="exampleInputEmail1" aria-describedby="emailHelp">';
echo '<div id="emailHelp" class="form-text"></div>';
echo '<button type="submit" class="btn btn-primary">Pesquisar</button>';
echo '</form>';

    $servidor = 'localhost';
    $usuario = 'root';
    $senha = '';
    $base = 'sakila';

    $conexao = new mysqli($servidor, $usuario, $senha, $base);

    if($conexao->connect_error)
{
    die('Falha de Conexão: ' . $conexao->connect_error);
}

$sql = 'SELECT filme.filme_id, titulo, ano_de_lancamento, categoria.nome FROM filme_categoria INNER JOIN filme ON (filme_categoria.filme_id = filme.filme_id) INNER JOIN categoria ON (filme_categoria.categoria_id = categoria.categoria_id);';
$resultado = $conexao->query($sql);

if ($resultado->num_rows > 0)
{
echo '<table class="table table-dark table-striped">';
echo '<thead>';
echo '<tr>';
echo '<th scope="col">ID do filme</th>';
echo '<th scope="col">Título</th>';
echo '<th scope="col">Ano de lançamento</th>';
echo '<th scope="col">Categoria</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

while($linhas = $resultado->fetch_assoc())
  {

echo '  <tr>';
    echo '  <th scope="row">' . $linhas['filme_id'] . '</th>';
    echo '  <td>' . $linhas['titulo'] . '</td>';
    echo '  <td>' . $linhas['ano_de_lancamento'] . '</td>';
    echo '  <td>' . $linhas['nome'] . '</td>';
    echo '</tr>';
  }

echo '</tbody>';
echo '</table>';
  
}

$form_pesquisa = $_POST["campo_pesquisa"];

$conexao = new mysqli($servidor, $usuario, $senha, $base);

if($conexao->connect_error)
{
    die('Falha de Conexão: ' . $conexao->connect_error);
}

$sql = 'SELECT filme.filme_id, titulo, ano_de_lancamento, categoria.nome FROM filme_categoria INNER JOIN filme ON (filme_categoria.filme_id = filme.filme_id) INNER JOIN categoria ON (filme_categoria.categoria_id = categoria.categoria_id) WHERE titulo LIKE "' . $form_pesquisa . '%";';
$resultado = $conexao->query($sql);

?>
</body>
</html>