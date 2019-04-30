<?php
namespace Uetiko\Source\Bank\Usuario\Infrastructure;

use DateTime;
use Uetiko\Source\Bank\Direccion\Domain\Direccion;
use Uetiko\Source\Bank\Usuario\Domain\Usuario;
use Uetiko\Source\Bank\Usuario\Domain\UsuarioId;
use Uetiko\Source\Bank\UsuarioContacto\Domain\Contacto;
use Uetiko\Source\Bank\Usuario\Domain\Interfaces\UsuarioRepository as RepositoryDomain;
use Uetiko\Source\Shared\Intrastructure\Eloquent\EloquentRepository;

/**
 * Class UsuarioRepository
 * @package Uetiko\Source\Bank\Usuario\Infrastructure
 */
class UsuarioRepository extends EloquentRepository implements RepositoryDomain
{
    /**
     * @param Usuario $usuario
     * @param Direccion $direccion
     * @param Contacto $contacto
     * @throws \Exception
     */
    public function save(Usuario $usuario, Direccion $direccion, Contacto $contacto): void
    {
        $contacto_id = $this->getManager()::table('datos_contacto')->insertGetId([
            'correo_electronico' => $contacto->getCorreoElectronico(),
            'telefono' => $contacto->getTelefono(),
            'celular' => $contacto->getCelular(),
            'create_at' => new DateTime(),
            'update_at' => new DateTime()
        ]);

        $direccion_id = $this->getManager()::table('direccion')->insertGetId([
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

        $this->getManager()::table('usuario')->insertGetId([
            'id' => $usuario,
            'nombre' => $usuario->getNombre(),
            'apellido' => $usuario->getApellidos(),
            'create_at' => new DateTime(),
            'update_at' => new DateTime(),
            'direccion_id' => $direccion_id,
            'datos_contacto' => $contacto_id
        ]);
    }

    /**
     * @param UsuarioId $id
     * @return Usuario|null
     */
    public function find(UsuarioId $id): ?Usuario
    {
        $user = $this->getManager()::table('usuario')
            ->where('id', $id->getValue())
            ->first();

        $id = new UsuarioId($user->id);
        return new Usuario($id, $user->nombre, $user->apellido);
    }

    /**
     * @param Usuario $usuario
     * @throws \Exception
     */
    public function update(Usuario $usuario){
        $this->getManager()::table('usuario')
            ->where('id', $usuario->getId())
            ->update([
                'nombre' => $usuario->getNombre(),
                'apellido' => $usuario->getApellidos(),
                'update_at' => new DateTime()
            ]);
    }
}