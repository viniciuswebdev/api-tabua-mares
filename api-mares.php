<?php

//Passagem dos parâmetros via URL
$localID = $_GET["localID"];
$mes = ucfirst(strtolower($_GET["mes"]));
$ano = $_GET["ano"];

//Lê o HTML da página correspondente
$url = "http://www.mar.mil.br/dhn/chm/box-previsao-mare/tabuas/" . $localID . $mes . $ano . ".htm";
libxml_use_internal_errors(true);
$html = file_get_contents($url);
$doc = new DOMDocument();
$doc->strictErrorChecking = FALSE;
$doc->loadHTML($html);
libxml_clear_errors();
$xml = simplexml_import_dom($doc);

//Objeto principal
$json = new stdClass();
$json->ID = intval($localID);
$json->local = strip_tags($xml->xpath("//center/strong/font[@size=2]")[0]->asXML());
$json->mes = $mes;
$json->ano = intval($ano);

$dias = array();                    //Array com as medições de todos os dias.
$dia = new stdClass();              //Objeto com os dados de um dia.
$medicoes = array();                //Array com as medições de um dia.

$rows = $xml->xpath('//tr');        //Obtém todas as linhas da tabela.
array_splice($rows, 0, 2);          //Pula as duas primeiras linhas.

$n_row = 0;
$ocurrence = 0;                     //OCURRENCE armazena em qual medição de um mesmo dia o iterador está.
$d_mes = 1;
foreach($rows as $row){
    $n_row++;
    $columns = $row->td;
    $ocurrence++;
    $medicao = new stdClass();

    if($ocurrence == 1){        //Primeira linha do dia
        foreach($columns as $col) {
            //Define o dia da semana.
            if (isset($col->strong)) { 
                $dia->d_sem = reset($col->strong);
            }
        }
    }

    if($row->td[2]){
        //Define o horário da medição.
        $medicao->hora = trim(end($row->td[2]));
    }
    if($row->td[3]){
        //Define a altura da medição.
        $medicao->altura = trim(end($row->td[3]));
    }

    if(is_string(end($columns))) {
        //Se chegou em uma linha branca, então as medições daquele dia acabaram.
        //Guarda os dados daquele dia e reinicializa as variáveis.
        $dia->d_mes = $d_mes++;
        $dia->medicoes = $medicoes;
        $dias[] = $dia;

        $dia = new stdClass();
        $medicoes = array();
        $ocurrence = 0;
    } else {
        //Apenas insere a medição se não for linha branca.
        $medicoes[] = $medicao;
    }

}
//Guarda o último dia de medição.
$dia->d_mes = $d_mes++;
$dia->medicoes = $medicoes;
$dias[] = $dia;

$json->dias = $dias;
echo json_encode($json);
?>
