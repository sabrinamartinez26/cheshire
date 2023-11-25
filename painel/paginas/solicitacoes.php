<?php 
$pag = 'solicitacoes';

//verificar se ele tem a permissão de estar nessa página
if(@$solicitacoes == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
 ?>
 <div class="row">
 	<a onclick="inserir()" type="button" class="btn btn-primary"><span class="fa fa-plus"></span> Nova Solicitação</a>

 	<li class="dropdown head-dpdn2" style="display: inline-block;">
			<a href="#" class="dropdown-toggle btn btn-danger" data-toggle="dropdown" aria-expanded="false" id="btn-deletar" style="display:none"><span class="fa fa-trash"></span> DELETAR</a>

			<ul class="dropdown-menu" style="margin-left:0px;">
			<li>
			<div class="notification_desc2">
			<p>Confirmar Exclusão? <a href="#" onclick="deletarSel()"><span class="text-danger">Sim</span></a></p>
			</div>
			</li>										
			</ul>
		</li>	
 </div>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">

</div>

<input type="hidden" name="ids" id="ids">


<!-- Modal Cadastro -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form">
			<div class="modal-body">
				

					<div class="row">
						<div class="col-md-12">							
								<label>Leitor</label>
								<select class="form-control sel2" name="leitor" id="leitor" style="width:100%">					<  

								<?php 
								$query = $pdo->query("SELECT * FROM leitores  order by nome asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								for($i=0; $i < @count($res); $i++){		
									?>	
									<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?> / <?php echo $res[$i]['cpf'] ?></option>

								<?php } ?>

							</select>								
						</div>



						<div class="col-md-12" style="margin-top: 10px">							
								<label>Livro</label>
								<select class="form-control sel3" name="livro" id="livro" style="width:100%">					<  

								<?php 
								$query = $pdo->query("SELECT * FROM livros where estoque <= 0 order by titulo asc");
								$res = $query->fetchAll(PDO::FETCH_ASSOC);
								for($i=0; $i < @count($res); $i++){		
									?>	
									<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['titulo'] ?> / <?php echo $res[$i]['subtitulo'] ?></option>

								<?php } ?>

							</select>								
						</div>

						<div class="col-md-12" align="right" style="margin-top: 10px">							
								
								<button type="submit" class="btn btn-primary" style="margin-top: 22px">Salvar</button>						
						</div>

						
					</div>


				
					<input type="hidden" class="form-control" id="id" name="id">					

				<br>
				<small><div id="mensagem" align="center"></div></small>
			</div>
			
			</form>
		</div>
	</div>
</div>




<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>


