<?php
namespace DiarioMotorista;

class Receita extends Movimentacao{
    protected string $tipo = "receita";
    public function __construct(OrigemReceitas $origem, float $valor)
    {
        $this->origem = $origem->value;
        $this->valor = $valor;
    }
}
?>