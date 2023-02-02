<?php
namespace DiarioMotorista;

enum OrigemDespesas: string{
    case Aluguel = "aluguel";
    case Combustivel = "combustivel";
    case Manuntencao = "manuntencao";
    case Refeicao = "refeicao";
    case Outros = "outros";
}
?>