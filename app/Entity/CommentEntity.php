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
                    '<a href="/u/' . $this->username . '">' .
                        '<img src="https://placekitten.com/50/50">' .
                    '</a>' .
                '</div>' .
                '<div class="commentText">' .
                    '<p>' .
                        '<a href="/u/' . $this->username . '">' . $this->username . '</a>' .
                        ': ' . htmlentities($this->comment) .
                    '</p>' .
                    '<span class="date sub-text">' . $this->getCreationDate() . '</span>' .
                '</div>';
    }
}
