<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Competition Model
 *
 * @method \App\Model\Entity\Competition get($primaryKey, $options = [])
 * @method \App\Model\Entity\Competition newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Competition[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Competition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Competition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Competition[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Competition findOrCreate($search, callable $callback = null, $options = [])
 */
class CompetitionTable extends Table
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

        $this->setTable('competition');
        $this->setDisplayField('CompetitionId');
        $this->setPrimaryKey('CompetitionId');
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
            ->integer('CompetitionId')
            ->allowEmpty('CompetitionId', 'create');

        $validator
            ->scalar('IsActive')
            ->allowEmpty('IsActive');

        $validator
            ->dateTime('StartingDate')
            ->allowEmpty('StartingDate');

        $validator
            ->dateTime('FinishingDate')
            ->allowEmpty('FinishingDate');

        $validator
            ->scalar('IsPublic')
            ->allowEmpty('IsPublic');

        $validator
            ->scalar('Name')
            ->maxLength('Name', 30)
            ->requirePresence('Name', 'create')
            ->notEmpty('Name');

        $validator
            ->integer('RallyId')
            ->requirePresence('RallyId', 'create')
            ->notEmpty('RallyId');

        return $validator;
    }
}
