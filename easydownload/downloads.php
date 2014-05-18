<?php
/**
*
* easyDownload app para lliure (5.x)
*
* @Versão 2.0
* @DesenvolvedorGustavo Gottardi <gustavo.gottardi@hotmail.com>
* @entre em contato com o desenvolvedor <gustavo.gottardi@hotmail.com> 
* @licença http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

?>

<div class="boxCenter">
	<?php
	$dir = "../uploads/edownloads/";
	$arquivo = mysql_fetch_array(mysql_query('select * from '.$pluginTable.'_grupos where id = "'.$_GET['grupo'].'" limit 1'));
	?>
	<h2><?php echo $arquivo['nome']?></h2>
	<?php
	if(!isset($_GET['id'])){
		if(isset($_GET['del'])){
			plg_historic('return');
			$consulta = 'select arquivo from '.$pluginTable.' where id ="'.$_GET['del'].'" limit 1';
			$query = mysql_fetch_array(mysql_query($consulta));
			
			if(!empty($query['imagem']))
				@unlink($dir.$query['imagem']);
			

			$alter['id'] = $_GET['del'];
			jf_delete($pluginTable, $alter);
		}
		?>

		<table class="table">
			<tr>
				<th></th>
				<th width="24px"></th>
			</tr>
			
			<?php
			$sql = mysql_query('select * from '.$pluginTable.' where grupo = "'.$_GET['grupo'].'" order by nome asc');
			while($dados = mysql_fetch_array($sql)){
				?>
				<tr id="<?php echo "empr".$dados['id'];?>">
					<td><a href="<?php echo $pluginHome."&amp;p=downloads&amp;grupo=".$_GET['grupo']."&amp;id=".$dados['id']?>"><?php echo $dados['nome'];?></a></td>
					
					<td><a href="<?php echo $pluginHome."&amp;p=downloads&amp;grupo=".$_GET['grupo']."&amp;del=".$dados['id'];?>" onclick="return confirmAlgo('Você quer mesmo excluir esse arquivo?')" ><img src="imagens/icones/trash.png"></td>
				</tr>
				<?php
			}
			?>
		</table>
		<?php
	} else {
		if(!empty($_POST)){
			$erro = false;
			
			$file = new fileup;
			$file->diretorio = '../uploads/agende/';
			$file->up(); 
		
			if(!empty($_GET['id'])){
				$alter['id'] = $_GET['id'];
				
				jf_update($pluginTable, $_POST, $alter);
				echo ($erro? '' : '<img src="error.jpg" onerror="jfAlert(\'Alteração realizada com sucesso!\', \'2\')" class="imge" alt="" />');
			} else {
				$_POST['grupo'] = $_GET['grupo'];
				jf_insert($pluginTable, $_POST);
				$dados = $_POST;
				echo ($erro? '' : '<img src="error.jpg" onerror="mLaviso(\'Arquivo adicionado com sucesso!\', \'2\')" class="imge" alt="" />');
				echo '<meta http-equiv="refresh" content="1;url='.$_ll['app']['home'].'&p=downloads&grupo='.$_GET['grupo'].'"> ';
			}
		}
		
		if(!empty($_GET['id']))
			$dados = mysql_fetch_array(mysql_query('select * from '.$pluginTable.' where id = "'.$_GET['id'].'"'));
			
		?>
		<form class="form" method="post" enctype="multipart/form-data">
			<fieldset>
				<div>
					<label>Nome</label>
					<input type="text"  <?php $item = 'nome';  echo 'name="'.$item.'"'.(isset($dados[$item])?'value="'.$dados[$item].'"': '') ?> />
				</div>
				
				<div>
					<label>Indormações adicionais</label>
					<input type="text"  <?php $item = 'info';  echo 'name="'.$item.'"'.(isset($dados[$item])?'value="'.$dados[$item].'"': '') ?> />
				</div>

				<div>
					<?php
					$file = new fileup; 
					$file->titulo = 'Arquivo:';
					$file->rotulo = 'Selecionar arquivo';
					$file->registro = $dados['arquivo'];
					$file->campo = 'arquivo';
					$file->extencao = '*';
					$file->form();
					?>
				</div>
			</fieldset>	
			
			<div class="botoes">
				<button type="submit" class="confirm">Gravar</button>
				<a href="<?php echo $backReal?>">Voltar</a>
			</div>
		</form>
		<?php
		unset($dados);
	}
	?>
</div>
