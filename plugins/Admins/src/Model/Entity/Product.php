<?php
declare(strict_types=1);

namespace Admins\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int $category_id
 * @property string|null $product_name
 * @property string|null $sku
 * @property string|null $price
 * @property int $quantity
 * @property string|null $description
 * @property string|null $keywords
 * @property string|null $seo_title
 * @property string|null $seo_keywords
 * @property string|null $seo_description
 * @property string|null $robot_tags
 * @property int $status
 * @property string|null $created
 * @property string|null $modified
 *
 * @property \Admins\Model\Entity\Category $category
 * @property \Admins\Model\Entity\CartProduct[] $cart_product
 * @property \Admins\Model\Entity\ProductImage[] $product_images
 * @property \Admins\Model\Entity\ProductOrder[] $product_order
 */
class Product extends Entity
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
        'category_id' => true,
        'product_name' => true,
        'description' => true,
        'keywords' => true,
        'seo_title' => true,
        'seo_keywords' => true,
        'seo_description' => true,
        'robot_tags' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'category' => true,
        'vertical_banner' => true,
        'big_banner' => true,
		'horizontal_banner' => true,
        'product_order' => true,
		'director' => true,
		'type' => true,
		'slug' => true,
		'trailer_video' => true,
		'production_year' => true,
		'language' => true,
		'censor_category' => true,
		'hours' => true,
		'minutes' => true,
		'genres' => true,
		'price' => true,
		'producer' => true
    ];
}
