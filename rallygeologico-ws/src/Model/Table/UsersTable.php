<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
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
        $this->setDisplayField('FacebookId');
        $this->setPrimaryKey('FacebookId');
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
            ->scalar('FacebookId')
            ->maxLength('FacebookId', 30)
            ->allowEmpty('FacebookId', 'create');

        $validator
            ->scalar('Username')
            ->maxLength('Username', 30)
            ->requirePresence('Username', 'create')
            ->notEmpty('Username')
            ->add('Username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('FirstName')
            ->maxLength('FirstName', 15)
            ->allowEmpty('FirstName');

        $validator
            ->scalar('LastName')
            ->maxLength('LastName', 15)
            ->allowEmpty('LastName');

        $validator
            ->scalar('Email')
            ->maxLength('Email', 30)
            ->allowEmpty('Email');

        $validator
            ->scalar('PhotoURL')
            ->maxLength('PhotoURL', 200)
            ->allowEmpty('PhotoURL');

        $validator
            ->scalar('IsAdmin')
            ->allowEmpty('IsAdmin');

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
        $rules->add($rules->isUnique(['Username']));

        return $rules;
    }
}
