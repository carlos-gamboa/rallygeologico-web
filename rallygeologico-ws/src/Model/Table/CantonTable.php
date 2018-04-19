<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Canton Model
 *
 * @method \App\Model\Entity\Canton get($primaryKey, $options = [])
 * @method \App\Model\Entity\Canton newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Canton[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Canton|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Canton patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Canton[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Canton findOrCreate($search, callable $callback = null, $options = [])
 */
class CantonTable extends Table
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

        $this->setTable('canton');
        $this->setDisplayField('Name');
        $this->setPrimaryKey('Name');
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
            ->scalar('Name')
            ->maxLength('Name', 40)
            ->allowEmpty('Name', 'create');

        $validator
            ->scalar('DistrictName')
            ->maxLength('DistrictName', 40)
            ->requirePresence('DistrictName', 'create')
            ->notEmpty('DistrictName');

        return $validator;
    }
}
