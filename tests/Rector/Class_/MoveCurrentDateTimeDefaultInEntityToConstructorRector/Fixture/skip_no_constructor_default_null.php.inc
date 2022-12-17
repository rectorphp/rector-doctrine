<?php

namespace Rector\Doctrine\Tests\Rector\Class_\MoveCurrentDateTimeDefaultInEntityToConstructorRector\Fixture;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="signing_parties")
 * @ORM\Entity(repositoryClass="MvSignature\Repository\SigningPartyRepository")
 */
class SkipNoConstructorDefaultNull
{
    /**
     * @ORM\Column(name="reminded_at", type="datetime", nullable=true)
     */
    private ?DateTime $remindedAt = null;

    public function getRemindedAt(): ?DateTime
    {
        return $this->remindedAt;
    }

    public function setRemindedAt(?DateTime $remindedAt): SkipNoConstructorDefaultNull
    {
        $this->remindedAt = $remindedAt;

        return $this;
    }
}
