<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CompetitionStatistic Entity
 *
 * @property int $user_id
 * @property int $competition_id
 * @property \Cake\I18n\FrozenTime $starting_date
 * @property \Cake\I18n\FrozenTime $finishing_date
 * @property int $points
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Competition $competition
 */
class CompetitionStatistic extends Entity
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
        'starting_date' => true,
        'finishing_date' => true,
        'points' => true,
        'user' => true,
        'competition' => true
    ];
}
