<?php
declare(strict_types=1);

namespace Admins\Model\Entity;

use Cake\ORM\Entity;

/**
 * City Entity
 *
 * @property int $id
 * @property int $country_id
 * @property int $state_id
 * @property string $city
 * @property int $status
 * @property string $created
 * @property string $modified
 *
 * @property \Admins\Model\Entity\Country $country
 * @property \Admins\Model\Entity\State $state
 */
class City extends Entity
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
        'country_id' => true,
        'state_id' => true,
        'city' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'country' => true,
        'state' => true,
    ];
}
