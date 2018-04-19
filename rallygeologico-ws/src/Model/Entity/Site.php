<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Site Entity
 *
 * @property int $SiteId
 * @property string $Name
 * @property int $PointsAwarded
 * @property string $QrUrl
 * @property string $Details
 * @property string $Description
 * @property float $Latitude
 * @property float $Longitude
 * @property string $ProvinceName
 *
 * @property \App\Model\Entity\Rally[] $rally
 * @property \App\Model\Entity\Term[] $term
 */
class Site extends Entity
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
        'QrUrl' => true,
        'Details' => true,
        'Description' => true,
        'Latitude' => true,
        'Longitude' => true,
        'ProvinceName' => true,
        'rally' => true,
        'term' => true
    ];
}
