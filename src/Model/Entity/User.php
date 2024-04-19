<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\Validation\Validator;

/**
 * User Entity
 *
 * @property string $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $address
 * @property string $phone_no
 * @property bool $isAdmin
 * @property string $nonce
 * @property \Cake\I18n\Date $nonce_expiry
 *
 * @property \App\Model\Entity\Payment[] $payments
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'username' => true,
        'email' => true,
        'password' => true,
        'address' => true,
        'phone_no' => true,
        'isAdmin' => true,
        'nonce' => true,
        'nonce_expiry' => true,
        'payments' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var list<string>
     */
    protected array $_hidden = [
        'password',
    ];

    /**
     * Hashing password for User entity
     *
     * @param string $password Password field
     * @return string|null hashed password
     * @see \App\Model\Entity\User::$password
     */
    protected function _setPassword(string $password): ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }

        return $password;
    }


}
