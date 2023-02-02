<?php
namespace DiarioMotorista;

class DiarioMotorista{
    private \PDO $bancoDados;
    public function __construct(\PDO $bancoDados){
        $this->bancoDados = $bancoDados;
    }
    public function adicionarDespesa(OrigemDespesas $origem, int $valor){
        $sql = "INSERT INTO despesas (despesa_quantidade, despesa_origem, despesa_data)
                               VALUE ('{$valor}', '{$origem->value}', NOW())";
                               
        $this->bancoDados->exec($sql) or die(print_r($this->bancoDados->errorInfo(), true));
    }
    public function exibirDespesas(){
        $sql = "SELECT * FROM despesas";
        $despesas = $this->bancoDados->query($sql, \PDO::FETCH_ASSOC);
        return $despesas->fetchAll();
    }
    public function adicionarReceita(OrigemReceitas $origem, int $valor){
        $sql = "INSERT INTO receitas (receita_quantidade, receita_origem, receita_data)
                               VALUE ('{$valor}', '{$origem->value}', NOW())";
                               
        $this->bancoDados->exec($sql) or die(print_r($this->bancoDados->errorInfo(), true));
    }
    public function exibirReceitas(){
        $sql = "SELECT * FROM receitas";
        $despesas = $this->bancoDados->query($sql, \PDO::FETCH_ASSOC);
        return $despesas->fetchAll();
    }
}
?>