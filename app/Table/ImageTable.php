<?php declare(strict_types=1);

namespace App\Table;

use Core\Table\Table;

/**
 * Class ImageTable
 *
 * @package App\Table
 */
class ImageTable extends Table
{
    protected $table = 'images';

    /**
     * Récupère les dernières images.
     *
     * @return array
     */
    public function last()
    {
        return $this->query("
            SELECT {$this->table}.*, users.username, COUNT(likes.images_id) as likes
            FROM {$this->table}
            JOIN users ON {$this->table}.users_id=users.id
            LEFT JOIN likes ON {$this->table}.id=likes.images_id
            GROUP BY {$this->table}.id
            ORDER BY {$this->table}.created_at DESC
        ");
    }

    /**
     * Récupère les dernières images avec les tags associés.
     *
     * @return array
     */
    public function lastWithTags()
    {
        // TODO: [SQL] Récupère toutes les images avec les tags associés (les plus récentes d'abord)
        return $this->query("
            SELECT *
            FROM images
            WHERE 1 = 0
        ");
    }

    /**
     * Récupère une image en liant les infos associées (likes, tags, user)
     *
     * @param int $imageId
     * @param int $userId
     *
     * @return \App\Entity\ImageEntity
     */
    public function findWithDetails(int $imageId, int $userId)
    {
        return $this->query(
            "SELECT {$this->table}.*, users.username, COUNT(likes.images_id) as likes, COUNT(IF(likes.users_id=?,1,NULL)) 'liked_by_user'
            FROM {$this->table}
            JOIN users ON {$this->table}.users_id=users.id
            LEFT JOIN likes ON {$this->table}.id=likes.images_id
            WHERE {$this->table}.id = ?",
            [$userId, $imageId],
            true
        );
    }

    /**
     * Récupère les dernières images du tag donné
     *
     * @param int $tag_id
     *
     * @return array
     */
    public function lastByTag(int $tag_id)
    {
        // TODO: [SQL] Récupère les dernières images du tag donné
        return $this->query("
            SELECT *
            FROM images
            WHERE 1 = 0
        ");
    }

    public function lastByUserId(int $userId)
    {
        return $this->query(
            "SELECT {$this->table}.*
            FROM {$this->table}
            JOIN users ON {$this->table}.users_id=users.id
            WHERE users_id = ?
            ORDER BY {$this->table}.created_at DESC",
            [$userId]
        );
    }
}
