<?php
 
require_once('Frete.class.php');
 
$frete = new Frete();
 
$frete->setCep_origem('07500000');
$frete->setCep_destino('20000000');
/*
 * TIPO DE SERVIÇO
 * VALORES VÁLIDOS:
 *  pac
 *  sedex
 *  sedex 10
 *  sedex a cobrar
 */
$frete->defineServico('sedex');
 
/*PESO EM KG (EX: SE FOR 500gr INFORME 0.5)*/
$frete->setPeso('1');
 
$retorno = $frete->calcular();
 
if($frete->getErro()){
    die("Ocorreu um erro: " . $frete->getErro());
}
 
echo "Informacoes do frete com origem ". $frete->getCep_origem() ." e destino ". $frete->getCep_destino() ." <br />";
echo "Valor do frete: $retorno->Valor reais <br />";
echo "Prazo para entrega: $retorno->PrazoEntrega dias <br />";
echo "Entrega domiciliar? $retorno->EntregaDomiciliar <br />";
echo "Entrega sabado? $retorno->EntregaSabado";
?>