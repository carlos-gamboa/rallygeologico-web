<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RallySite Entity
 *
 * @property int $id
 * @property int $rally_id
 * @property int $site_id
 *
 * @property \App\Model\Entity\Rally $rally
 * @property \App\Model\Entity\Site $site
 */
class RallySite extends Entity
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
        'rally_id' => true,
        'site_id' => true,
        'rally' => true,
        'site' => true
    ];
}
