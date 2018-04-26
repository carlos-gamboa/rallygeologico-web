<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Rally Entity
 *
 * @property int $id
 * @property string $name
 * @property int $points_awarded
 * @property string $image_url
 * @property string $description
 *
 * @property \App\Model\Entity\Competition[] $competition
 * @property \App\Model\Entity\Site[] $site
 */
class Rally extends Entity
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
        'name' => true,
        'points_awarded' => true,
        'image_url' => true,
        'description' => true,
        'competition' => true,
        'site' => true
    ];
}
