<?php 
$tabela = 'emprestimos';
require_once("../../../conexao.php");

$id = @$_POST['id'];

$query = $pdo->query("SELECT * from $tabela where livro = '$id' and devolvido = 'Não' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-hover" id="">
	<thead> 
	<tr> 
	<th class="esc">Leitor</th>	
	<th class="">Emprestado</th>	
	<th class="">Data Entrega</th>
	
	</tr> 
	</thead> 
	<tbody>	
HTML;


for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$leitor = $res[$i]['leitor'];
	$data_emprestimo = $res[$i]['data_emprestimo'];
	$data_devolucao = $res[$i]['data_devolucao'];
	
	$data_emprestimoF = implode('/', array_reverse(@explode('-', $data_emprestimo)));
	$data_devolucaoF = implode('/', array_reverse(@explode('-', $data_devolucao)));

	
	
	$query2 = $pdo->query("SELECT * from leitores where id = '$leitor'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$nome_leitor = @$res2[0]['nome'];

echo <<<HTML
<tr>
<td class="esc">{$nome_leitor}</td>
<td class="esc">{$data_emprestimoF}</td>
<td class="esc verde">{$data_devolucaoF}</td>


</tr>
HTML;

}


echo <<<HTML
</tbody>

</table>
HTML;

}else{
	echo '<small>Não possui empréstimos ativos para este livro!</small>';
}
?>

