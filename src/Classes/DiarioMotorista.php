<?php
namespace DiarioMotorista;

class DiarioMotorista{
    private \PDO $bancoDados;
    public function __construct(\PDO $bancoDados){
        $this->bancoDados = $bancoDados;
    }
}
?>