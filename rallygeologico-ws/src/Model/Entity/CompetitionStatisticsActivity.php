<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CompetitionStatisticsActivity Entity
 *
 * @property int $competition_statistics_id
 * @property int $activity_id
 * @property \Cake\I18n\FrozenTime $resolved_date
 * @property int $points_obtained
 *
 * @property \App\Model\Entity\CompetitionStatistic $competition_statistic
 * @property \App\Model\Entity\Activity $activity
 */
class CompetitionStatisticsActivity extends Entity
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
        'resolved_date' => true,
        'points_obtained' => true,
        'competition_statistic' => true,
        'activity' => true
    ];
}
