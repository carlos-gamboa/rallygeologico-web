<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\CompetitionStatisticsTable|\Cake\ORM\Association\HasMany $CompetitionStatistics
 * @property \App\Model\Table\CompetitionStatisticsSiteTable|\Cake\ORM\Association\HasMany $CompetitionStatisticsSite
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Competition',[
            'className' => 'Competition',
            'foreignKey' => 'admin_id'
        ]);
        $this->hasMany('InvitationSend',[
            'className' => 'Invitation',
            'foreignKey' => 'user_id_send'
        ]);
        $this->hasMany('InvitationReceive',[
            'className' => 'Invitation',
            'foreignKey' => 'user_id_receive'
        ]);
        $this->hasMany('CompetitionStatistics', [
            'foreignKey' => 'user_id'
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
            ->scalar('username')
            ->maxLength('username', 30)
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 15)
            ->allowEmpty('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 15)
            ->allowEmpty('last_name');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->scalar('photo_url')
            ->maxLength('photo_url', 200)
            ->allowEmpty('photo_url');

        $validator
            ->allowEmpty('is_admin');

        $validator
            ->integer('login_api')
            ->allowEmpty('login_api');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
