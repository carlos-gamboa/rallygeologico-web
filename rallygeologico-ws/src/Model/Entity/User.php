<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $facebook_id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $photo_url
 * @property string $is_admin
 *
 * @property \App\Model\Entity\CompetitionStatistic[] $competition_statistics
 * @property \App\Model\Entity\CompetitionStatisticsSite[] $competition_statistics_site
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
        'facebook_id' => true,
        'username' => true,
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'photo_url' => true,
        'is_admin' => true,
        'facebook' => true,
        'competition_statistics' => true,
        'competition_statistics_site' => true
    ];
}
