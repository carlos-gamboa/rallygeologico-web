<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $FacebookId
 * @property string $Username
 * @property string $FirstName
 * @property string $LastName
 * @property string $Email
 * @property string $PhotoURL
 * @property string $IsAdmin
 */
class User extends Entity
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
        'Username' => true,
        'FirstName' => true,
        'LastName' => true,
        'Email' => true,
        'PhotoURL' => true,
        'IsAdmin' => true
    ];
}
