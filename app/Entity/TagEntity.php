<?php declare(strict_types=1);

namespace App\Entity;

use Core\Entity\Entity;

/**
 * Class TagEntity
 * @package App\Entity
 */
class TagEntity extends Entity
{
    /**
     * @return string
     */
    public function getUrl()
    {
        return 'images/tag/' . $this->id;
    }
}
