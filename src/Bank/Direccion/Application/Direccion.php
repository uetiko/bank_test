<?php
namespace Uetiko\Source\Bank\Direccion\Application;

use Uetiko\Source\Bank\Direccion\Domain\Direccion as DireccionDomain;
use Uetiko\Source\Bank\Direccion\Domain\Interfaces\DireccionRepository;

class Direccion
{
    /** @var Direccion $direccion */
    private $direccion = null;

    public function __construct(DireccionDomain $direccion)
    {
        $this->direccion = $direccion;
    }

    public function create(DireccionRepository $repository){
        $repository->save($this->direccion);
        return $this->direccion;
    }
}