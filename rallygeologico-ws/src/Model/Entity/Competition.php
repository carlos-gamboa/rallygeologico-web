<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Competition Entity
 *
 * @property int $CompetitionId
 * @property string $IsActive
 * @property \Cake\I18n\FrozenTime $StartingDate
 * @property \Cake\I18n\FrozenTime $FinishingDate
 * @property string $IsPublic
 * @property string $Name
 * @property int $RallyId
 */
class Competition extends Entity
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
        'IsActive' => true,
        'StartingDate' => true,
        'FinishingDate' => true,
        'IsPublic' => true,
        'Name' => true,
        'RallyId' => true
    ];
}
