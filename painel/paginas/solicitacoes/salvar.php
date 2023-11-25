<?php 
$tabela = 'solicitacoes';
require_once("../../../conexao.php");

$livro = $_POST['livro'];
$leitor = $_POST['leitor'];
$id = $_POST['id'];

//validacao
$query = $pdo->query("SELECT * from $tabela where livro = '$livro' and leitor = '$leitor'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_reg = @$res[0]['id'];
if(@count($res) > 0 and $id != $id_reg){
	echo 'Solicitação já Feita!';
	exit();
}



if($id == ""){
$query = $pdo->prepare("INSERT INTO $tabela SET livro = '$livro', leitor = '$leitor', data = curDate() ");
	
}else{
$query = $pdo->prepare("UPDATE $tabela SET livro = '$livro', leitor = '$leitor' where id = '$id'");
}

$query->execute();

echo 'Salvo com Sucesso';
 ?>