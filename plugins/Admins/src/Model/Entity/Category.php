<?php
declare(strict_types=1);

namespace Admins\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property string|null $name
 * @property string|null $icon
 * @property string|null $video
 * @property int $ordering
 * @property int $status
 * @property string $created
 * @property string $modified
 *
 * @property \Admins\Model\Entity\ParentCategory $parent_category
 * @property \Admins\Model\Entity\ChildCategory[] $child_categories
 * @property \Admins\Model\Entity\Product[] $products
 */
class Category extends Entity
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
        'parent_id' => true,
        'name' => true,
        'icon' => true,
        'video' => true,
        'ordering' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'parent_category' => true,
        'child_categories' => true,
        'products' => true,
		'slug' => true,
    ];
}
