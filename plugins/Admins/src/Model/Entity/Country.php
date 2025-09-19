<?php
declare(strict_types=1);

namespace Admins\Model\Entity;

use Cake\ORM\Entity;

/**
 * Country Entity
 *
 * @property int $id
 * @property string|null $country_name
 * @property string|null $country_code
 * @property string|null $phonecode
 * @property string|null $phone_no_format
 * @property string|null $zipcode_format
 * @property string|null $flag_image
 * @property int|null $ordering
 * @property int|null $status
 * @property string $created
 * @property string $modified
 *
 * @property \Admins\Model\Entity\City[] $cities
 * @property \Admins\Model\Entity\State[] $states
 */
class Country extends Entity
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
        'country_name' => true,
        'country_code' => true,
        'phonecode' => true,
        'phone_no_format' => true,
        'zipcode_format' => true,
        'flag_image' => true,
        'ordering' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'cities' => true,
        'states' => true,
    ];
}
