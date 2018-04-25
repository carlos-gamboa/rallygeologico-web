<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompetitionsStatistics Model
 *
 * @method \App\Model\Entity\CompetitionsStatistic get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompetitionsStatistic newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CompetitionsStatistic[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompetitionsStatistic|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompetitionsStatistic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompetitionsStatistic[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompetitionsStatistic findOrCreate($search, callable $callback = null, $options = [])
 */
class CompetitionsStatisticsTable extends Table
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

        $this->setTable('competitions_statistics');
        $this->setDisplayField('FacebookId');
        $this->setPrimaryKey(['FacebookId', 'CompetitionId']);
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
            ->integer('UserId')
            ->allowEmpty('UserId', 'create');

        $validator
            ->integer('CompetitionId')
            ->allowEmpty('CompetitionId', 'create');

        $validator
            ->dateTime('StartingDate')
            ->allowEmpty('StartingDate');

        $validator
            ->dateTime('FinishingDate')
            ->allowEmpty('FinishingDate');

        $validator
            ->integer('Points')
            ->allowEmpty('Points');

        return $validator;
    }
}
