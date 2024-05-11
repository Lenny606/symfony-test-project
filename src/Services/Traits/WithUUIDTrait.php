<?php
declare(strict_types=1);

namespace App\Services\Traits;

use App\Exceptions\EntityException;
use Exception;
use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

trait WithUUIDTrait
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'uuid', nullable: false)]
    private Uuid $id;

    public function getId(): string
    {
        if (!$this->id) {
            throw new Exception("Id is not set");
        }
        return $this->id->toString();
    }

    private function generateId(): void
    {
        $this->setId(Uuid::uuid4());
    }

    public function setId(string|UuidInterface $id): static
    {
        if ($this->id) {
            throw new EntityException("Attempting to regenerate id!");
        }

        if (is_string($id)) {
            if (!Uuid::isValid($id)) {
                throw new Exception("'$id' is not a valid Uuid=");
            }

            $id = Uuid::fromString($id);
        }

        $this->id = $id;
        return $this;
    }
}