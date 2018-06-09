<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TermSite Entity
 *
 * @property int $id
 * @property int $term_id
 * @property int $site_id
 *
 * @property \App\Model\Entity\Term $term
 * @property \App\Model\Entity\Site $site
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
        'term_id' => true,
        'site_id' => true,
        'term' => true,
        'site' => true
    ];
}
