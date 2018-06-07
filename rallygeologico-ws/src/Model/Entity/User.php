<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $api_id
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $photo_url
 * @property int $is_admin
 * @property int $login_api
 * @property int $password_needs_change
 *
 * @property \App\Model\Entity\Competition[] $competition
 * @property \App\Model\Entity\Invitation[] $invitation_send
 * @property \App\Model\Entity\Invitation[] $invitation_receive
 * @property \App\Model\Entity\CompetitionStatistic[] $competition_statistics
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
        'api_id' => true,
        'username' => true,
        'password' => true,
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'photo_url' => true,
        'is_admin' => true,
        'login_api' => true,
        'password_needs_change' => true,
        'competition' => true,
        'invitation_send' => true,
        'invitation_receive' => true,
        'competition_statistics' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
