<?php


namespace Uetiko\Source\Bank\Direccion\Domain\Interfaces;


use Uetiko\Source\Bank\Direccion\Domain\DireccionId;
use Uetiko\Source\Bank\Direccion\Domain\Direccion;

interface DireccionRepository
{
    public function save(Direccion $direccion): int;

    public function find(DireccionId $id): Direccion;

    public function update(Direccion $direccion);
}