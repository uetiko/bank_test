<?php
namespace Uetiko\Source\Bank\UsuarioContacto\Infrastructure;

use DateTime;
use Uetiko\Source\Bank\UsuarioContacto\Domain\Contacto;
use Uetiko\Source\Bank\UsuarioContacto\Domain\ContactoId;
use Uetiko\Source\Bank\UsuarioContacto\Domain\Exceptions\ContactoNotFound;
use Uetiko\Source\Bank\UsuarioContacto\Domain\Interfaces\ContactoRepository as Repository;
use Uetiko\Source\Shared\Intrastructure\Eloquent\EloquentRepository;


class ContactoRepository extends EloquentRepository implements Repository
{
    /**
     * @param Contacto $contacto
     * @return int
     * @throws \Exception
     */
    public function save(Contacto $contacto): int
    {
        return $this->getManager()::table('datos_contacto')
            ->insertGetId([
                'correo_electronico' => $contacto->getCorreoElectronico(),
                'telefono' => $contacto->getTelefono(),
                'celular' => $contacto->getCelular(),
                'create_at' => new DateTime(),
                'update_at' => new DateTime()
            ]);
    }

    /**
     * @param ContactoId $id
     * @return Contacto
     * @throws ContactoNotFound
     */
    public function find(ContactoId $id)
    {
        $contact = $this->getManager()::table('datos_contacto')
            ->where('id', $id->getValue())
            ->first();

        if (Null === $contact) {
            throw new ContactoNotFound();
        }

        $contactId = new ContactoId($contact->id);
        return new Contacto(
            $contactId, $contact->telefono, $contact->correo_electronico,
            $contact->celular
        );
    }

    /**
     * @param Contacto $contacto
     * @throws ContactoNotFound
     */
    public function update(Contacto $contacto)
    {
        try {
            $this->getManager()::table('datos_contacto')
                ->where('id', $contacto->getId())
                ->update([
                    'correo_electronico' => $contacto->getCorreoElectronico(),
                    'telefono' => $contacto->getTelefono(),
                    'celular' => $contacto->getCelular(),
                    'update_at' => new DateTime()

                ]);
        } catch (\Exception $e){
            throw new ContactoNotFound($e);
        }
    }
}