<?php
namespace DiarioMotorista;

use DateTime;

class DiarioMotorista{
    private \PDO $bancoDados;
    public function __construct(\PDO $bancoDados){
        $this->bancoDados = $bancoDados;
    }
    public function adicionarDespesa(OrigemDespesas $origem, int $valor){
        $sql = "INSERT INTO despesas (despesa_quantidade, despesa_origem, despesa_data) VALUE ('{$valor}', '{$origem->value}', NOW())";
        $this->bancoDados->exec($sql) or die(print_r($this->bancoDados->errorInfo(), true));
    }
}
?>