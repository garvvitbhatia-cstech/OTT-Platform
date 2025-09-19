<?php
declare(strict_types=1);

namespace Admins\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductOrder Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $quantity
 * @property string $price
 * @property string $total
 * @property string $created
 *
 * @property \Admins\Model\Entity\User $user
 * @property \Admins\Model\Entity\Product $product
 */
class ProductOrder extends Entity
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
        'user_id' => true,
        'product_id' => true,
        'quantity' => true,
        'price' => true,
        'total' => true,
        'created' => true,
        'user' => true,
        'product' => true,
    ];
}
