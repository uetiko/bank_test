<?php


namespace Uetiko\Source\Bank\Direccion\Domain;


class Direccion
{
    /** @var DireccionId $id */
    private $id = null;
    /** @var string $calle */
    private $calle = null;
    /** @var string $numero_exterior */
    private $numero_exterior = null;
    /** @var string $numero_interior */
    private $numero_interior = null;
    /** @var int $codigo_postall */
    private $codigo_postal = null;
    /** @var string $estado */
    private $estado = null;
    /** @var string $ciudad */
    private $ciudad = null;
    /** @var string $colonia */
    private $colonia = null;
    /** @var string $municipio */
    private $municipio = null;

    /**
     * Direccion constructor.
     * @param DireccionId $id
     * @param string $calle
     * @param string $ciudad
     * @param string $colonia
     * @param int $codigo_postal
     * @param string $estado
     * @param string $municipio
     * @param string $numero_exterior
     * @param string $numero_interior
     */
    public function __construct(
        DireccionId $id, string $calle, string $ciudad, string $colonia,
        int $codigo_postal, string $estado, string $municipio,
        string $numero_exterior, string $numero_interior
    )
    {
        $this->id = $id;
        $this->calle = $calle;
        $this->ciudad = $ciudad;
        $this->colonia = $colonia;
        $this->codigo_postal = $codigo_postal;
        $this->estado = $estado;
        $this->municipio = $municipio;
        $this->numero_exterior = $numero_exterior;
        $this->numero_interior = $numero_interior;
    }

    /**
     * @return DireccionId
     */
    public function getId(): DireccionId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCalle(): string
    {
        return $this->calle;
    }

    /**
     * @return string
     */
    public function getNumeroExterior(): string
    {
        return $this->numero_exterior;
    }

    /**
     * @return string
     */
    public function getNumeroInterior(): string
    {
        return $this->numero_interior;
    }

    /**
     * @return int
     */
    public function getCodigoPostal(): int
    {
        return $this->codigo_postal;
    }

    /**
     * @return string
     */
    public function getEstado(): string
    {
        return $this->estado;
    }

    /**
     * @return string
     */
    public function getCiudad(): string
    {
        return $this->ciudad;
    }

    /**
     * @return string
     */
    public function getColonia(): string
    {
        return $this->colonia;
    }

    /**
     * @return string
     */
    public function getMunicipio(): string
    {
        return $this->municipio;
    }
}