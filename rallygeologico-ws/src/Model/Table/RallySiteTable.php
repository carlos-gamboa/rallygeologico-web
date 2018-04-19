<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RallySite Model
 *
 * @method \App\Model\Entity\RallySite get($primaryKey, $options = [])
 * @method \App\Model\Entity\RallySite newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RallySite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RallySite|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RallySite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RallySite[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RallySite findOrCreate($search, callable $callback = null, $options = [])
 */
class RallySiteTable extends Table
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

        $this->setTable('rally_site');
        $this->setDisplayField('RallyId');
        $this->setPrimaryKey(['RallyId', 'SiteId']);
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
            ->integer('RallyId')
            ->allowEmpty('RallyId', 'create');

        $validator
            ->integer('SiteId')
            ->allowEmpty('SiteId', 'create');

        return $validator;
    }
}
