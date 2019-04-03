<?php declare(strict_types=1);

namespace App\Entity;

use Core\Entity\Entity;

/**
 * Class CommentEntity
 *
 * @package App\Entity
 */
class CommentEntity extends Entity
{
    /**
     * @return string
     */
    public function getCreationDate()
    {
        $date = date('d/m/Y', strtotime($this->created_at));
        if ($date === false) {
            return "";
        } else {
            return $date;
        }
    }
}
