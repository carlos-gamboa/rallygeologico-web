<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Canton Entity
 *
 * @property string $name
 * @property string $province_id
 *
 * @property \App\Model\Entity\Province $province
 * @property \App\Model\Entity\District[] $district
 */
class Canton extends Entity
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
        'province_id' => true,
        'province' => true,
        'district' => true
    ];
}
