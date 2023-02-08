<?php
namespace DiarioMotorista;

enum OrigemReceitas: string{
    case _99 = "99";
    case InDriver = "indriver";
    case Maxim = "maxim";
    case Taxi = "taxi";
    case Uber = "uber";
}
?>