<?php
/**
*
* easyDownload app para lliure (5.x)
*
* @versão 1.0
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
	<h4><?php echo $arquivo['nome']?></h4>
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
			
			if(!empty($_FILES['arquivo']['name'])){
				$arquivo = $_FILES['arquivo'];
				$arquivoNome = explode('.', $arquivo['name']);
				$arquivoNome = array_pop($arquivoNome); // pega a extenção
				$arquivoNome = md5(uniqid(time())).'.'.$arquivoNome;	

				$caminho_imagem = $arquivo['tmp_name'];

				$path =  $dir.$arquivoNome;
				move_uploaded_file($arquivo["tmp_name"], $path);
				$_POST['arquivo'] = $arquivoNome;
				
				@unlink($dir.$_POST['imagemOld']);
			} 
		
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
			<div>
				<label>Nome</label>
				<input type="text"  <?php $item = 'nome';  echo 'name="'.$item.'"'.(isset($dados[$item])?'value="'.$dados[$item].'"': '') ?> />
			</div>
						
			<div>
				<label>Arquivo</label>
				<?php
				if(!empty($dados['arquivo']))
					echo '<input type="hidden" name="imagemOld" value="'.$dados['arquivo'].'" />'				
				?>
				<input type="file" name="arquivo" />
				<span class="ex">Para trocar sua arquivo apenas selecione uma novo. <strong>Campo opcional</strong></span>
			</div>	
				
			<span class="botao"><button type="submit">Gravar</button></span>
			<span class="botao"><a href="<?php echo $backReal?>">Voltar</a></span>
		</form>
		<?php
		unset($dados);
	}
	?>
</div>
