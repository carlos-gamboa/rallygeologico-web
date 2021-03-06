<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Activity Entity
 *
 * @property int $id
 * @property int $site_id
 * @property int $activity_type
 * @property int $points_awarded
 * @property string $description
 * @property string $name
 *
 * @property \App\Model\Entity\Site $site
 * @property \App\Model\Entity\Option[] $options
 * @property \App\Model\Entity\Multimedia[] $multimedia
 * @property \App\Model\Entity\CompetitionStatistic[] $competition_statistics
 */
class Activity extends Entity
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
        'site_id' => true,
        'activity_type' => true,
        'points_awarded' => true,
        'description' => true,
        'name' => true,
        'site' => true,
        'options' => true,
        'multimedia' => true,
        'competition_statistics' => true
    ];
}
