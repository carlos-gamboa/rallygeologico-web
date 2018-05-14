<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Canton Model
 *
 * @property \App\Model\Table\ProvinceTable|\Cake\ORM\Association\BelongsTo $Province
 * @property \App\Model\Table\DistrictTable|\Cake\ORM\Association\HasMany $District
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
        $this->setDisplayField('name');
        $this->setPrimaryKey('name');

        $this->belongsTo('Province', [
            'foreignKey' => 'province_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('District', [
            'foreignKey' => 'canton_id'
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
            ->scalar('name')
            ->maxLength('name', 40)
            ->allowEmpty('name', 'create');

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
        $rules->add($rules->existsIn(['province_id'], 'Province'));

        return $rules;
    }
}
