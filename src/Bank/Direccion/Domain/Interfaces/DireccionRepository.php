<?php


namespace Uetiko\Source\Bank\Direccion\Domain\Interfaces;


use Uetiko\Source\Bank\Usuario\Domain\Direccion;

interface DireccionRepository
{
    public function save(Direccion $direccion): void;
}