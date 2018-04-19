<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Province Model
 *
 * @method \App\Model\Entity\Province get($primaryKey, $options = [])
 * @method \App\Model\Entity\Province newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Province[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Province|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Province patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Province[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Province findOrCreate($search, callable $callback = null, $options = [])
 */
class ProvinceTable extends Table
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

        $this->setTable('province');
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
            ->maxLength('Name', 20)
            ->allowEmpty('Name', 'create');

        $validator
            ->scalar('CantonName')
            ->maxLength('CantonName', 40)
            ->requirePresence('CantonName', 'create')
            ->notEmpty('CantonName');

        return $validator;
    }
}
