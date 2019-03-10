<?php declare(strict_types=1);

namespace App\Entity;

use Core\Entity\Entity;
use Core\String\Str;

/**
 * Class ImageEntity
 *
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
        return '/i/' . $this->id;
    }

    /**
     * @return string
     */
    public function getShortDesc()
    {
        return substr($this->description, 0, 30) . '...';
    }

    /**
     * @return string
     */
    public function getLongDesc()
    {
        return substr($this->description, 0, 80) . '...';
    }

    /**
     * @return string
     */
    public function getAlt()
    {
        return "Small desc";
    }

    /**
     * @return string
     */
    public function getElapsedTime()
    {
        return Str::time_elapsed_string($this->created_at);
    }

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

    public function getLikesNb()
    {
        // TODO: Remove this override so that it returns the true number of likes
        return 0;
    }

    public function getCommentsNb()
    {
        // TODO: Remove this override so that it returns the true number of comments
        return 0;
    }
}
