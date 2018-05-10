<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Multimedia Entity
 *
 * @property int $id
 * @property int $media_type
 * @property string $media_url
 *
 * @property \App\Model\Entity\Activity[] $activity
 * @property \App\Model\Entity\Term[] $term
 */
class Multimedia extends Entity
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
        'media_type' => true,
        'media_url' => true,
        'activity' => true,
        'term' => true
    ];
}
