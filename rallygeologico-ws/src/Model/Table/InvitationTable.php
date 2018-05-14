<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Invitation Model
 *
 * @property \App\Model\Table\CompetitionTable|\Cake\ORM\Association\BelongsTo $Competition
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
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Competition', [
            'foreignKey' => 'competition_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('UserSend', [
            'className' => 'Users',
            'foreignKey' => 'user_id_send'
        ]);

        $this->belongsTo('UserReceive', [
            'className' => 'Users',
            'foreignKey' => 'user_id_receive'
        ]);
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('accepted')
            ->allowEmpty('accepted');

        $validator
            ->integer('user_id_send')
            ->requirePresence('user_id_send', 'create')
            ->notEmpty('user_id_send');

        $validator
            ->integer('user_id_receive')
            ->requirePresence('user_id_receive', 'create')
            ->notEmpty('user_id_receive');

        return $validator;
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
        $rules->add($rules->existsIn(['competition_id'], 'Competition'));

        return $rules;
    }
}
