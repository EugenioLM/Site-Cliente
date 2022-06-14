<?
function anti_sqlx($texto){
	// Lista de palavras para procurar
	$check[1] = chr(34); // s�mbolo "
	$check[2] = chr(39); // s�mbolo '
	$check[3] = chr(92); // s�mbolo /
	$check[4] = chr(96); // s�mbolo `
	$check[5] = "drop table";
	$check[6] = "update";
	$check[7] = "alter table";
	$check[8] = "drop database";	
	$check[9] = "drop";
	$check[10] = "select";
	$check[11] = "delete";
	$check[12] = "insert";
	$check[13] = "alter";
	$check[14] = "destroy";
	$check[15] = "table";
	$check[16] = "database";
	$check[17] = "union";
	$check[18] = "TABLE_NAME";
	$check[19] = "1=1";
	$check[20] = 'or 1';
	$check[21] = 'exec';
	$check[22] = 'INFORMATION_SCHEMA';
	$check[23] = 'like';
	$check[24] = 'COLUMNS';
	$check[25] = 'into';
	$check[26] = 'VALUES';
	
	// Cria se as vari�veis $y e $x para controle no WHILE que far� a busca e substitui��o
	$y = 1;
	$x = sizeof($check);
	// Faz-se o WHILE, procurando alguma das palavras especificadas acima, caso encontre alguma delas, este script substituir� por um espa�o em branco " ".
	while($y <= $x){
		   $target = strpos($texto,$check[$y]);
			if($target !== false){
				$texto = str_replace($check[$y], "", $texto);
			}
		$y++;
	}
	// Retorna a vari�vel limpa sem perigos de SQL Injection
	return $texto;
} 

function anti_sqli($sql)
{
// remove palavras que contenham sintaxe sql


$sql = trim($sql);//limpa espa�os vazio
$sql = strip_tags($sql);//tira tags html e php
$sql = addslashes($sql);//Adiciona barras invertidas a uma string
return $sql;
}

function protect( $str )
{
/**
* Fun��o para retornar uma string protegida contra SQL/Blind/XSS Injection
* @param Mixed str
* @access public
* @return string
*/
//Simples n�o?
$variavel = protect( $_POST['variavel_exemplo'] );
if( !is_array( $str ) ) {
$str = preg_replace("/(from|select|insert|delete|where|drop table|show tables)/i","",$str);
$str = preg_replace('~&amp;#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $str);
$str = preg_replace('~&amp;#([0-9]+);~e', 'chr("\\1")', $str);
$str = str_replace("<script","",$str);
$str = str_replace("script>","",$str);
$str = str_replace("<Script","",$str);
$str = str_replace("Script>","",$str);
$str = trim($str);
$tbl = get_html_translation_table(HTML_ENTITIES);
$tbl = array_flip($tbl);
$str = addslashes($str);
$str = strip_tags($str);
return strtr($str, $tbl);
}
else return $str;
}
?>