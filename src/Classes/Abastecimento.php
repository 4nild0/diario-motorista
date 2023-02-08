<?php
namespace DiarioMotorista;

class Abastecimento extends Despesa{
    #Propriedade "valor" da classe Movimentacao será tratada como "valorTotal" nesta classe;
    private float $valorLitro;
    private string $movimentacaoID;
    protected string $origem = OrigemDespesas:: Combustivel->value;

    public function __construct(){
        
    }
    
    public function getValorTotal(){
        return $this->valor;
    }
    public function setValorTotal(float $novoValorTotal){
        $this->valor = $novoValorTotal;
    }
    public function getValorLitro(){
        return $this->valorLitro;
    }
    public function setValorLitro(float $novoValorLitro){
        $this->valorLitro = $novoValorLitro;
    }
    public function getMovimentacaoID(){
        return $this->movimentacaoID;
    }
    public function setMovimentacaoID(int $novaMovimentacaoID){
        $this->movimentacaoID = $novaMovimentacaoID;
    }
    public function adicionarAbastecimento(\PDO $bancoDados, int $usuarioID, Abastecimento $abastecimento){
        /** Para gerar um abastecimento é preciso gerar primeiro uma movimentacao e recuperar o ID dela.
         *  Para recuperar o ID da movimentacao correta eu uso o usuarioID e Data.
         *  Neste caso a data precisa ser declarada antes nessa função.
         */

        #Declaração de Data
        $data = new \DateTime();
        $dataFormatada = $data->format("Y-m-d H:i:s");
        $abastecimento->setData($dataFormatada);

        #Recuperacao de 
        $argumentos = ["movimentacao_dataCriacao" => $dataFormatada];
        $this->adicionarMovimentacao($bancoDados, $abastecimento);
        foreach ($this->exibirMovimentacoes($bancoDados, usuarioID: 1, argumentos: $argumentos) as $fileira){
            $abastecimento->setMovimentacaoID($fileira['movimentacao_id']);
        }

        #Insercao de Abastecimento
        $sql = "INSERT INTO abastecimentos (abastecimento_usuarioID,
                                           abastecimento_movimentacaoID,
                                           abastecimento_valorTotal,
                                           abastecimento_valorLitro,
                                           abastecimento_dataCriacao)

                    VALUE                 ('{$usuarioID}',
                                           '{$abastecimento->getMovimentacaoID()}',
                                           '{$abastecimento->getValorTotal()}',
                                           '{$abastecimento->getValorLitro()}',
                                           '{$abastecimento->getData()}')";

        $resultado = $bancoDados->exec($sql) or die(print_r($bancoDados->errorInfo(), true));

        
    return $resultado;
    }
    public static function exibirAbastecimentos(\PDO $bancoDados, int $usuarioID = null, array $argumentos){
        $condicoes = "abastecimento_usuarioID = '{$usuarioID}' ";
        if(count($argumentos) > 0){
            foreach($argumentos as $chaveCondicao => $valorCondicao){
                $condicoes = $condicoes . "AND {$chaveCondicao} ='{$valorCondicao}'";
            }
        }

        $sql = "SELECT * FROM abastecimentos WHERE {$condicoes}";
        $abastecimentos = $bancoDados->query($sql) or die(print_r($bancoDados->errorInfo(), true));

        return $abastecimentos;
    }
    public static function atualizarAbastecimento(\PDO $bancoDados, int $abastecimentoID, $movimentacaoID, array $alteracoes){
        $alteracao = "";
        foreach($alteracoes as $chaveAlteracao => $valorAlteracao){
            $alteracao = $alteracao . "{$chaveAlteracao} = '{$valorAlteracao}',";
        }

        $sql = "UPDATE abastecimentos SET {$alteracao} abastecimento_dataAtualizacao = NOW() WHERE abastecimento_id = '{$abastecimentoID}'";
        $abastecimentos = $bancoDados->query($sql) or die(print_r($bancoDados->errorInfo(), true));

        self:: atualizarMovimentacao($bancoDados, $movimentacaoID, ["movimentacao_valor" => $alteracoes['abastecimento_valorTotal']]);

        return $abastecimentos;
    }
    public static function deletarAbastecimento(\PDO $bancoDados, int $usuarioID, int $abastecimentoID, $movimentacaoID){
        $sql = "DELETE FROM abastecimentos WHERE abastecimento_usuarioID = '{$usuarioID}' AND abastecimento_id = '{$abastecimentoID}' ";
        $resultado = $bancoDados->exec($sql) or die(print_r($bancoDados->errorInfo(), true));
        self:: deletarMovimentacao($bancoDados, $usuarioID, $movimentacaoID);
        return $resultado;
    }
}
?>