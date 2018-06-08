<?php declare(strict_types=1);

namespace App\Entity;

use Core\Entity\Entity;

/**
 * Class PostEntity
 * @package App\Entity
 */
class PostEntity extends Entity
{
    /**
     * @return string
     */
    public function getUrl()
    {
        return 'index.php?p=posts.show&id=' . $this->id;
    }

    /**
     * @return string
     */
    public function getExtrait()
    {
        $html = '<p>' . substr($this->text, 0, 100) . '...</p>';
        $html .= '<p><a href="' . $this->getURL() . '">Voir la suite</a></p>';
        return $html;
    }
}
