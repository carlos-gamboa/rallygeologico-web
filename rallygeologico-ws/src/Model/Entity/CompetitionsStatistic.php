<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CompetitionsStatistic Entity
 *
 * @property int $UserId
 * @property int $CompetitionId
 * @property \Cake\I18n\FrozenTime $StartingDate
 * @property \Cake\I18n\FrozenTime $FinishingDate
 * @property int $Points
 */
class CompetitionsStatistic extends Entity
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
        'StartingDate' => true,
        'FinishingDate' => true,
        'Points' => true
    ];
}
