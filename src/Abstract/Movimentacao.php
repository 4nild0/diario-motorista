<?php
namespace DiarioMotorista;

abstract class Movimentacao{
    protected string $origem;
    protected string $tipo;
    protected float $valor;
    protected string $data;

    public function __construct(string $origem, float $valor, string $data)
    {
        $this->origem = $origem;
        $this->valor = $valor;
        $this->data = $data;
    }
    public function getOrigem(){
        return $this->origem;
    }
    protected function setOrigem(string $novaOrigem){
        $this->origem = $novaOrigem;
    }
    public function getTipo(){
        return $this->tipo;
    }
    protected function setTipo(string $novoTipo){
        $this->tipo = $novoTipo;
    }
    public function getValor(){
        return $this->valor;
    }
    protected function setValor(int $novoValor){
        $this->valor = $novoValor;
    }
    public function getData(){
        return $this->data;
    }
    public function setData(string $novaData){
        $this->data = $novaData;
    }
    public function adicionarMovimentacao(\PDO $bancoDados, Movimentacao $movimentacao){
        $usuarioID = 1;
        $data = $movimentacao->getData();
        
        $sql = "INSERT INTO movimentacoes (movimentacao_usuarioID,
                                           movimentacao_tipo,
                                           movimentacao_origem,
                                           movimentacao_valor,
                                           movimentacao_dataCriacao)

                    VALUE                 ('{$usuarioID}',
                                           '{$movimentacao->getTipo()}',
                                           '{$movimentacao->getOrigem()}',
                                           '{$movimentacao->getValor()}',
                                           '{$movimentacao->getData()}')";

        $resultado = $bancoDados->exec($sql) or die(print_r($bancoDados->errorInfo(), true));
        return $resultado;

    }
    public static function exibirMovimentacoes(\PDO $bancoDados, int $usuarioID = null, array $argumentos){
        $condicoes = "movimentacao_usuarioID = '{$usuarioID}' ";
        foreach($argumentos as $chaveCondicao => $valorCondicao){
            if($valorCondicao){
                $condicoes = $condicoes . "AND {$chaveCondicao} ='{$valorCondicao}'";
            }
        }
        $sql = "SELECT * FROM movimentacoes WHERE {$condicoes}";
        $movimentacoes = $bancoDados->query($sql) or die(print_r($bancoDados->errorInfo(), true));
        return $movimentacoes;
    }
    public static function atualizarMovimentacao(\PDO $bancoDados, int $movimentacaoID, array $alteracoes){
        $alteracao = "";
        foreach($alteracoes as $chaveAlteracao => $valorAlteracao){
            $alteracao = $alteracao . "{$chaveAlteracao} = '{$valorAlteracao}',";
        }

        $sql = "UPDATE movimentacoes SET {$alteracao} movimentacao_dataAtualizacao = NOW() WHERE movimentacao_id = '{$movimentacaoID}'";
        $movimentacoes = $bancoDados->query($sql) or die(print_r($bancoDados->errorInfo(), true));
        return $movimentacoes;
    }
    public static function deletarMovimentacao(\PDO $bancoDados, int $usuarioID, int $movimentacaoID){
        $sql = "DELETE FROM movimentacoes WHERE movimentacao_usuarioID = '{$usuarioID}' AND movimentacao_id = '{$movimentacaoID}' ";
        $resultado = $bancoDados->exec($sql) or die(print_r($bancoDados->errorInfo(), true));
        return $resultado;
    }
}
?>