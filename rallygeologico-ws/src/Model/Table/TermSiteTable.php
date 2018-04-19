<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TermSite Model
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
        $this->setDisplayField('TermId');
        $this->setPrimaryKey(['TermId', 'SiteId']);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('TermId')
            ->allowEmpty('TermId', 'create');

        $validator
            ->integer('SiteId')
            ->allowEmpty('SiteId', 'create');

        return $validator;
    }
}
