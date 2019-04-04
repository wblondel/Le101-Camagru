<?php declare(strict_types=1);

namespace App\Table;

use Core\Table\Table;

/**
 * Class CommentTable
 *
 * @package App\Table
 */
class CommentTable extends Table
{
    protected $table = 'comments';

    /**
     * Récupères les commentaires d'une image
     *
     * @param int $imageId
     *
     * @return array
     */
    public function findForImage(int $imageId)
    {
        return $this->query(
            "SELECT {$this->table}.*, users.username
            FROM {$this->table}
            JOIN users ON {$this->table}.users_id=users.id
            WHERE {$this->table}.images_id=?
            ORDER BY {$this->table}.created_at DESC",
            [$imageId]
        );
    }

    /**
     * Récupère un commentaire en liant les infos associées (user)
     *
     * @param int $commentId
     *
     * @return \App\Entity\CommentEntity
     */
    public function findWithDetails(int $commentId)
    {
        return $this->query(
            "SELECT {$this->table}.*, users.username,
            FROM {$this->table}
            JOIN users ON {$this->table}.users_id=users.id
            LEFT JOIN likes ON {$this->table}.id=likes.images_id
            WHERE {$this->table}.id = ?",
            [$commentId],
            true
        );
    }
}
