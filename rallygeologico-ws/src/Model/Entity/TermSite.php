<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TermSite Entity
 *
 * @property int $term_id
 * @property int $site_id
 *
 * @property \App\Model\Entity\Term $term
 */
class TermSite extends Entity
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
        'term' => true
    ];
}
