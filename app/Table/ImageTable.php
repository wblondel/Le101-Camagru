<?php declare(strict_types=1);

namespace App\Table;

use Core\Table\Table;

/**
 * Class ImageTable
 * @package App\Table
 */
class ImageTable extends Table
{
    protected $table = 'articles';

    /**
     * Récupère une image en liant la catégorie associée
     * @param $id int
     * @return \App\Entity\ImageEntity
     */
    public function findWithCategory(int $id)
    {
        return $this->query("
            SELECT images.id, images.title, images.text, images.date, tags.name as category
            FROM articles
            LEFT JOIN tags ON category_id = tags.id
            WHERE articles.id = ?", [$id], true);
    }


}
