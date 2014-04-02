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
$pluginHome = $_ll['app']['home'];
$pluginPasta = $_ll['app']['pasta'];
$pluginTable = PREFIXO."easydownloader";

$botoes = array(
	array('href' => $backReal, 'img' => $plgIcones.'br_prev.png', 'title' => $backNome)
	);

if(!isset($_GET['grupo'])){
	$botoes[] = array('href' => $pluginHome.'&amp;p=grupo', 'img' => $plgIcones.'folder.png', 'title' => 'Criar grupo');
} elseif(!isset($_GET['id'])) {
	$botoes[] = array('href' => $pluginHome.'&amp;p=grupo&amp;id='.$_GET['grupo'], 'img' => $plgIcones.'pencil.png', 'title' => 'Alterar grupo');
	$botoes[] = array('href' => $pluginHome.'&amp;p=downloads&amp;grupo='.$_GET['grupo'].'&amp;id', 'img' => $plgIcones.'preso.png', 'title' => 'Adicionar arquivo');
}

echo app_bar('EasyDownload', $botoes);

$pagina = isset($_GET['p']) ? $_GET['p'] : 'home';

if(!file_exists($pluginPasta.$pagina.'.php'))
 $pagina = 'home';
  
require_once($pluginPasta.$pagina.'.php');
