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

    public function getHTML()
    {
        return '<div class="commenterImage">' .
                    '<img src="https://placekitten.com/50/50">' .
                '</div>' .
                '<div class="commentText">' .
                    '<p>' . $this->username . ': ' . htmlentities($this->comment) . '</p>' .
                    '<span class="date sub-text">' . $this->getCreationDate() . '</span>' .
                '</div>';
    }
}
