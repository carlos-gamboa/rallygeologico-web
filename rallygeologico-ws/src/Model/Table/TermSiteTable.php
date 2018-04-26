<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TermSite Model
 *
 * @property \App\Model\Table\TermTable|\Cake\ORM\Association\BelongsTo $Term
 *
 * @method \App\Model\Entity\TermSite get($primaryKey, $options = [])
 * @method \App\Model\Entity\TermSite newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TermSite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TermSite|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TermSite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TermSite[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TermSite findOrCreate($search, callable $callback = null, $options = [])
 */
class TermSiteTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('term_site');
        $this->setDisplayField('term_id');
        $this->setPrimaryKey(['term_id', 'site_id']);

        $this->belongsTo('Term', [
            'foreignKey' => 'term_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Term', [
            'foreignKey' => 'site_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['term_id'], 'Term'));
        $rules->add($rules->existsIn(['site_id'], 'Term'));

        return $rules;
    }
}
