<?php declare(strict_types=1);

namespace App\Table;

use Core\Table\Table;

/**
 * Class ImageTable
 * @package App\Table
 */
class ImageTable extends Table
{
    protected $table = 'images';

    /**
     * Récupère les dernières images.
     * @return array
     */
    public function last()
    {
        return $this->query("
            SELECT images.id, images.description, images.users_id, images.created_at, images.modified_at, images.filename
            FROM images
            ORDER BY images.created_at DESC
        ");
    }

    /*
     * Récupère une image avec le user associé
     * @return array
     */
    public function findWithUser(int $id)
    {
        return $this->query("
            SELECT images.*, users.username
            FROM images
            JOIN users ON images.users_id=users.id
            WHERE images.id = ?", [$id], true);
    }

    /**
     * Récupère les dernières images avec les tags associés.
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
     * Récupère une image en liant les tags associés
     * @param $id int
     * @return \App\Entity\ImageEntity
     */
    public function findWithTags(int $id)
    {
        // TODO: [SQL] Récupère une image en liant les tags associés
        return $this->query("
            SELECT *
            FROM images
            WHERE 1 = 0
        ");
    }

    /**
     * Récupère les dernières images du tag donné
     * @param $tag_id int
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
}
