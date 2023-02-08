<?php
namespace DiarioMotorista;

class Despesa extends Movimentacao{
    protected string $tipo = "despesa";
    public function __construct(OrigemDespesas $origem, float $valor)
    {
        $this->origem = $origem->value;
        $this->valor = $valor;
    }
}
?>