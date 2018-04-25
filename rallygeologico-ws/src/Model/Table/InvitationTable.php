<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Invitation Model
 *
 * @method \App\Model\Entity\Invitation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Invitation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Invitation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Invitation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Invitation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Invitation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Invitation findOrCreate($search, callable $callback = null, $options = [])
 */
class InvitationTable extends Table
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

        $this->setTable('invitation');
        $this->setDisplayField('InvitationId');
        $this->setPrimaryKey('InvitationId');
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
            ->integer('InvitationId')
            ->allowEmpty('InvitationId', 'create');

        $validator
            ->scalar('Accepted')
            ->allowEmpty('Accepted');

        $validator
            ->integer('UserIdSend')
            ->requirePresence('UserIdSend', 'create')
            ->notEmpty('UserIdSend');

        $validator
            ->integer('UserIdReceive')
            ->requirePresence('UserIdReceive', 'create')
            ->notEmpty('UserIdReceive');

        $validator
            ->integer('CompetitionId')
            ->requirePresence('CompetitionId', 'create')
            ->notEmpty('CompetitionId');

        return $validator;
    }
}
