<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Invitation Entity
 *
 * @property int $InvitationId
 * @property string $Accepted
 * @property int $UserIdSend
 * @property int $UserIdReceive
 * @property int $CompetitionId
 */
class Invitation extends Entity
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
        'Accepted' => true,
        'UserIdSend' => true,
        'UserIdReceive' => true,
        'CompetitionId' => true
    ];
}
