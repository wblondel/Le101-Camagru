<?php declare(strict_types=1);

namespace App\Entity;

use Core\Entity\Entity;
use Core\String\Str;

/**
 * Class ImageEntity
 * @package App\Entity
 */
class ImageEntity extends Entity
{
    /**
     * @return string
     */
    public function getFilePath()
    {
        return '/uploads/pictures/' . $this->filename;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return '/images/' . $this->id;
    }

    /**
     * @return string
     */
    public function getShortDesc()
    {
        return substr($this->description, 0, 30) . '...';
    }

    public function getAlt()
    {
        return "Small desc";
    }

    public function getElaspedTime()
    {
        return Str::time_elapsed_string($this->created_at);
    }

    public function getCreationDate()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }
}
