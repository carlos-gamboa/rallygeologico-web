<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rally Entity
 *
 * @property int $RallyId
 * @property string $Name
 * @property int $PointsAwarded
 * @property string $ImageUrl
 * @property string $Description
 *
 * @property \App\Model\Entity\Site[] $site
 */
class Rally extends Entity
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
        'Name' => true,
        'PointsAwarded' => true,
        'ImageUrl' => true,
        'Description' => true,
        'site' => true
    ];
}
