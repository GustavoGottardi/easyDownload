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
	plg_historic('return');
	if(!empty($_GET['id'])){
		if(!empty($_POST)){
			$alter['id'] = $_GET['id'];
			
			jf_update(PREFIXO.'easydownloader_grupos', $_POST, $alter);
			?><img src="error.jpg" onerror="mLaviso('Grupo alterado com sucesso!', '2')" class="imge" alt="" /><?php
			echo '<meta http-equiv="refresh" content="1;url=?app=easydownload&p=downloads&grupo='.$_GET['id'].'"> ';
		} 

		$consulta = mysql_fetch_array(mysql_query('select * from '.PREFIXO.'easydownloader_grupos where id = "'.$_GET['id'].'"'));
		
		$dados = $consulta;
	} else {
		if(!empty($_POST)){

			jf_insert(PREFIXO.'easydownloader_grupos', $_POST);
			$dados = $_POST;
			?><img src="error.jpg" onerror="mLaviso('Novo grupo criado com sucesso!', '2')" class="imge" alt="" /><?php
			echo '<meta http-equiv="refresh" content="1;url=?app=easydownload"> ';
		}
	}
	?>

	<form class="form" method="post">
		<div>
			<label>Nome</label>
			<input type="text"  <?php $item = 'nome';  echo 'name="'.$item.'"'.(isset($dados[$item])?'value="'.$dados[$item].'"': '') ?> />
		</div>
			
		<span class="botao"><button type="submit">Gravar</button></span>
		<span class="botao"><a href="<?php echo $backReal;?>">Voltar</a></span>
	</form>

	<?php
	unset($dados);
	?>
</div>