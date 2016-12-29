<?php
/**
 * Description of Frete.class.php
 *
 * @author Pedro Henrique
 */
class Frete {
 
    private $cod_servico;
    private $cep_origem;
    private $cep_destino;
    private $peso;
    private $altura = '4';
    private $largura = '12';
    private $comprimento = '16';
    private $valor = '10.00';
    private $erro;
 
    public function getCep_origem() {
        return $this->cep_origem;
    }
 
    public function setCep_origem($cep_origem) {
        $this->cep_origem = $cep_origem;
    }
 
    public function getCep_destino() {
        return $this->cep_destino;
    }
 
    public function setCep_destino($cep_destino) {
        $this->cep_destino = $cep_destino;
    }
 
    public function getPeso() {
        return $this->peso;
    }
 
    public function setPeso($peso) {
        $this->peso = $peso;
    }
 
    public function getAltura() {
        return $this->altura;
    }
 
    public function setAltura($altura) {
        $this->altura = $altura;
    }
 
    public function getLargura() {
        return $this->largura;
    }
 
    public function setLargura($largura) {
        $this->largura = $largura;
    }
 
    public function getComprimento() {
        return $this->comprimento;
    }
 
    public function setComprimento($comprimento) {
        $this->comprimento = $comprimento;
    }
 
    public function getValor() {
        return $this->valor;
    }
 
    public function setValor($valor) {
        $this->valor = $valor;
    }
 
    public function getErro() {
        return $this->erro;
    }
 
    public function setErro($erro) {
        $this->erro = $erro;
    }
 
    public function defineServico($servico){
        $servico = strtolower($servico);
        if($servico == 'pac'){
            $this->cod_servico = '41106';
        }
        elseif($servico == 'sedex'){
            $this->cod_servico = '40010';
        }
        elseif($servico == 'sedex a cobrar'){
            $this->cod_servico = '40045';
        }
        elseif($servico == 'sedex 10'){
            $this->cod_servico = '40215';
        }
        else{
            return false;
        }
    }
 
    public function calcular(){
        $ws_correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$this->cep_origem."&sCepDestino=".$this->cep_destino."&nVlPeso=".$this->peso."&nCdFormato=1&nVlComprimento=".$this->comprimento."&nVlAltura=".$this->altura."&nVlLargura=".$this->largura."&sCdMaoPropria=n&nVlValorDeclarado=".$this->valor."&sCdAvisoRecebimento=n&nCdServico=".$this->cod_servico."&nVlDiametro=0&StrRetorno=xml";
        $xml = simplexml_load_file($ws_correios);
        if($xml->cServico->Erro == '0'){
            return $xml->cServico;
        }else{
            $this->setErro($xml->cServico->MsgErro);
            return false;
        }
    }
}