<?php

namespace Mautic\FormBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Mautic\ApiBundle\Serializer\Driver\ApiMetadataDriver;
use Mautic\CoreBundle\Doctrine\Mapping\ClassMetadataBuilder;
use Mautic\CoreBundle\Entity\FormEntity;
use Mautic\CoreBundle\Helper\InputHelper;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

namespace Rector\Tests\Doctrine\CodeQuality\Rector\Property\OrderByKeyToClassConstRector\Fixture;

class Form extends FormEntity
{
    /**
     * @var Collection<int, Submission>
     */
    #[ORM\OneToMany(targetEntity: \Mautic\FormBundle\Entity\Submission::class, mappedBy: 'form', fetch: 'EXTRA_LAZY')]
    #[ORM\OrderBy(['dateSubmitted' => 'DESC'])]
    private \Doctrine\Common\Collections\Collection $submissions;
}

?>
-----
<?php

namespace Rector\Tests\Doctrine\CodeQuality\Rector\Property\OrderByKeyToClassConstRector\Fixture;

// what is expected code?
// should remain the same? delete part below ----- (included)

?>
