<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Term Entity
 *
 * @property int $TermID
 * @property string $ImageUrl
 * @property string $VideoUrl
 * @property string $Name
 * @property string $Description
 *
 * @property \App\Model\Entity\Site[] $site
 */
class Term extends Entity
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
        'ImageUrl' => true,
        'VideoUrl' => true,
        'Name' => true,
        'Description' => true,
        'site' => true
    ];
}
