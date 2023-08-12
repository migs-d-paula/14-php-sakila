<?php
session_start();

$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$base = 'sakila';

$form_pesquisa = $_POST["campo_pesquisa"];

$conexao = new mysqli($servidor, $usuario, $senha, $base);

if($conexao->connect_error)
{
    die('Falha de Conexão: ' . $conexao->connect_error);
}

$sql = 'SELECT filme.filme_id, titulo, ano_de_lancamento, categoria.nome FROM filme_categoria INNER JOIN filme ON (filme_categoria.filme_id = filme.filme_id) INNER JOIN categoria ON (filme_categoria.categoria_id = categoria.categoria_id) WHERE titulo LIKE "' . $form_pesquisa . '%";';
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
$conexao->close();


?>