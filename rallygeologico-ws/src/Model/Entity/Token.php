<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Token Entity
 *
 * @property int $id
 * @property string $value
 * @property string $type
 * @property \Cake\I18n\FrozenTime $created
 * @property int $user_id
 *
 * @property \App\Model\Entity\User $user
 */
class Token extends Entity
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
        'value' => true,
        'type' => true,
        'created' => true,
        'user_id' => true,
        'user' => true
    ];
}
