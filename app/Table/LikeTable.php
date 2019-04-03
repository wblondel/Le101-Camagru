<?php declare(strict_types=1);

namespace App\Table;

use Core\Table\Table;

/**
 * Class LikeTable
 *
 * @package App\Table
 */
class LikeTable extends Table
{
    protected $table = 'likes';

    /**
     * Récupère le nombre de likes d'une image
     *
     * @param int $imageId
     *
     * @return \App\Entity\LikeEntity
     */
    public function getLikes(int $imageId)
    {
        return $this->query(
            "SELECT COUNT({$this->table}.images_id) as likes
            FROM {$this->table}
            WHERE {$this->table}.images_id = ?",
            [$imageId],
            true
        );
    }
}
