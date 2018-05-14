<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Site Entity
 *
 * @property int $id
 * @property string $name
 * @property int $points_awarded
 * @property string $qr_url
 * @property string $details
 * @property string $description
 * @property float $latitude
 * @property float $longitude
 * @property string $district_id
 *
 * @property \App\Model\Entity\District $district
 * @property \App\Model\Entity\CompetitionStatistic[] $competition_statistics
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
        'name' => true,
        'points_awarded' => true,
        'qr_url' => true,
        'details' => true,
        'description' => true,
        'latitude' => true,
        'longitude' => true,
        'district_id' => true,
        'district' => true,
        'competition_statistics' => true,
        'rally' => true,
        'term' => true
    ];
}
