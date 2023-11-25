<?php 
$tabela = 'emprestimos';
require_once("../../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];

$id = $_POST['id'];
$acao = @$_POST['acao'];

$query2 = $pdo->query("SELECT * from $tabela where id = '$id'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$id_livro = @$res2[0]['livro'];
$hash = @$res2[0]['hash'];

$query2 = $pdo->query("SELECT * from livros where id = '$id_livro'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$estoque = @$res2[0]['estoque'];
$titulo_livro = @$res2[0]['titulo'];
$total_estoque = $estoque + 1;

$pdo->query("UPDATE $tabela SET devolvido = 'Sim', funcionario = '$id_usuario', data_devolucao = curDate() WHERE id = '$id' ");
echo 'Alterado com Sucesso';

$pdo->query("UPDATE livros SET status = 'Disponível', estoque = '$total_estoque' where id = '$id_livro'");

//cancelamento do agendamento de mensagem
if($hash != ""){
	require("../../api/deletar_agd.php");
}

if($api_whatsapp == 'Sim'){
	//verificar se tem alerta de solicitação para o livro
	$query = $pdo->query("SELECT * from solicitacoes where livro = '$id_livro'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$linhas = @count($res);
	if($linhas > 0){
		for($i=0; $i<$linhas; $i++){
			$leitor = $res[$i]['leitor'];

			$query2 = $pdo->query("SELECT * from leitores where id = '$leitor'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
			$nome_leitor = @$res2[0]['nome'];
			$telefone_leitor = @$res2[0]['telefone'];

			$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_leitor);
			$mensagem = '*'.mb_strtoupper($nome_sistema).'* %0A';
			
			$mensagem .= 'Livro: *'.$titulo_livro.'* _Já está Disponível_ %0A%0A';
			$mensagem .= '_Olá '.$nome_leitor.', venha buscar o livro o quanto antes, pois ele já está novamente disponível para empréstimo!_ %0A';

			require("../../api/mensagem.php");

		}
	}
}

?>