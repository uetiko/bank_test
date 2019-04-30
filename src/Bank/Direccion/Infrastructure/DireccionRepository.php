<?php
namespace Uetiko\Source\Bank\Direccion\Infrastructure;

use Uetiko\Source\Bank\Direccion\Domain\DireccionId;
use Uetiko\Source\Bank\Direccion\Domain\Exceptions\AddressNotFound;
use Uetiko\Source\Bank\Direccion\Domain\Interfaces\DireccionRepository as Repository;
use Uetiko\Source\Bank\Direccion\Domain\Direccion;
use Uetiko\Source\Shared\Intrastructure\Eloquent\EloquentRepository;

class DireccionRepository extends EloquentRepository implements Repository
{

    public function save(Direccion $direccion): int
    {

        return $this->getManager()::table('direccion')->insertGetId([
            'calle' => $direccion->getCalle(),
            'numero_exterior' => $direccion->getNumeroExterior(),
            'numero_interior' => $direccion->getNumeroInterior(),
            'codigo_postal' => $direccion->getCodigoPostal(),
            'estado' => $direccion->getEstado(),
            'ciudad' => $direccion->getCiudad(),
            'colonia' => $direccion->getColonia(),
            'municipio' => $direccion->getMunicipio(),
            'create_at' => new DateTime(),
            'update_at' => new DateTime()
        ]);
    }

    /**
     * @param DireccionId $id
     * @return Direccion
     * @throws AddressNotFound
     */
    public function find(DireccionId $id): Direccion
    {
        $address = $this->getManager()::table('direccion')
            ->where('id', $id->getValue())
            ->first();

        if (is_null($address)) {
            throw new AddressNotFound();
        }

        $addressId = new DireccionId($address->id);
        return new Direccion(
            $addressId, $address->calle, $address->ciudad, $address->colonia,
            $address->codigo_postal, $address->estado, $address->municipio,
            $address->numero_exterior, $address->numero_interior
        );
    }

    /**
     * @param Direccion $direccion
     * @throws AddressNotFound
     */
    public function update(Direccion $direccion)
    {
        try{
            $this->getManager()::table('direccion')
                ->where('id', $direccion->getId())
                ->update([
                    'calle' => $direccion->getCalle(),
                    'numero_exterior' => $direccion->getNumeroExterior(),
                    'numero_interior' => $direccion->getNumeroInterior(),
                    'codigo_postal' => $direccion->getCodigoPostal(),
                    'estado' => $direccion->getEstado(),
                    'ciudad' => $direccion->getCiudad(),
                    'colonia' => $direccion->getColonia(),
                    'municipio' => $direccion->getMunicipio(),
                    'update_at' => new DateTime()
                ]);
        } catch (\Exception $e) {
            throw  new AddressNotFound($e);
        }
    }
}