<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TermMultimedia Entity
 *
 * @property int $term_id
 * @property int $multimedia_id
 *
 * @property \App\Model\Entity\Term $term
 * @property \App\Model\Entity\Multimedia $multimedia
 */
class TermMultimedia extends Entity
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
        'term' => true,
        'multimedia' => true
    ];
}
