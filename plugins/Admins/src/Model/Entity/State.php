<?php
declare(strict_types=1);

namespace Admins\Model\Entity;

use Cake\ORM\Entity;

/**
 * State Entity
 *
 * @property int $id
 * @property int $country_id
 * @property string $state
 * @property string $abbreviation
 * @property int $status
 * @property string $created
 * @property string $modified
 *
 * @property \Admins\Model\Entity\Country $country
 * @property \Admins\Model\Entity\City[] $cities
 */
class State extends Entity
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
        'state' => true,
        'abbreviation' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'country' => true,
        'cities' => true,
    ];
}
