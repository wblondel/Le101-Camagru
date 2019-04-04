<?php declare(strict_types=1);

namespace App\Table;

use Core\Table\Table;

/**
 * Class UserTable
 *
 * @package App\Table
 */
class UserTable extends Table
{
    protected $table = "users";

    /**
     * Retourne l'utilisateur correspondant au username donné
     *
     * @param string $username
     * @return mixed
     */
    public function findbyUsername(string $username)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE username = ?", [$username], true);
    }

    /**
     * @param string $userId
     * @param string $email
     *
     * @return mixed
     */
    public function changeEmail(string $userId, string $email)
    {
        return $this->query(
            'UPDATE users SET email = ? WHERE id = ?',
            [$email, $userId],
            true
        );
    }
}
