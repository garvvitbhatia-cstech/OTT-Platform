<?php
declare(strict_types=1);

namespace Admins\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string|null $type
 * @property string|null $name
 * @property string|null $username
 * @property string|null $email
 * @property string|null $contact
 * @property string|null $password
 * @property string|null $temp
 * @property string|null $profile
 * @property string|null $last_login
 * @property int $status
 * @property string|null $created
 * @property string|null $modified
 *
 * @property \Admins\Model\Entity\CartProduct[] $cart_product
 * @property \Admins\Model\Entity\Order[] $orders
 * @property \Admins\Model\Entity\ProductOrder[] $product_order
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
     * @var array
     */
    protected $_accessible = [
        'type' => true,
        'name' => true,
        'username' => true,
        'email' => true,
        'contact' => true,
        'password' => true,
        'temp' => true,
        'profile' => true,
        'last_login' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'cart_product' => true,
        'orders' => true,
        'product_order' => true,
        'city' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
}
