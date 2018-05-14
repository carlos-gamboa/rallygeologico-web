<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CompetitionStatisticsSite Entity
 *
 * @property int $user_id
 * @property int $competition_id
 * @property int $site_id
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\CompetitionStatistic $competition_statistic
 * @property \App\Model\Entity\Site $site
 */
class CompetitionStatisticsSite extends Entity
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
        'user' => true,
        'competition_statistic' => true,
        'site' => true
    ];
}
