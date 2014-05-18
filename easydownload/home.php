<?php
/*
*
* easyDownload app para lliure (5.x)
*
* @Versão 2.0
* @DesenvolvedorGustavo Gottardi <gustavo.gottardi@hotmail.com>
* @entre em contato com o desenvolvedor <gustavo.gottardi@hotmail.com> 
* @licença http://opensource.org/licenses/gpl-license.php GNU Public License
*/

$pluginTable .= '_grupos';

$pastas['pp'] = $_ll['app']['pasta'];
$pastas['plp'] = '../uploads/edownloads';


$navigi = new navigi();
$navigi->tabela = $pluginTable;
$navigi->query = 'select * from '.$navigi->tabela.' order by nome asc' ;
$navigi->delete = true;
$navigi->rename = true;
$navigi->config = array(
	'ico' => $_ll['app']['pasta'].'img/grupo.png',
	'link' => $pluginHome.'&amp;p=downloads&amp;grupo='           
	);								
$navigi->monta();

?>