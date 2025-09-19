<?php
declare(strict_types=1);

namespace Admins\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductImage Entity
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $image_name
 * @property string|null $image_alt
 * @property string|null $image_title
 * @property int $ordering
 * @property int $status
 *
 * @property \Admins\Model\Entity\Product $product
 */
class ProductImage extends Entity
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
        'product_id' => true,
        'image_name' => true,
        'image_alt' => true,
        'image_title' => true,
        'ordering' => true,
        'status' => true,
        'product' => true,
    ];
}
