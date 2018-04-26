<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompetitionStatistics Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CompetitionTable|\Cake\ORM\Association\BelongsTo $Competition
 *
 * @method \App\Model\Entity\CompetitionStatistic get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompetitionStatistic newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CompetitionStatistic[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompetitionStatistic|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompetitionStatistic patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompetitionStatistic[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompetitionStatistic findOrCreate($search, callable $callback = null, $options = [])
 */
class CompetitionStatisticsTable extends Table
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

        $this->setTable('competition_statistics');
        $this->setDisplayField('user_id');
        $this->setPrimaryKey(['user_id', 'competition_id']);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Competition', [
            'foreignKey' => 'competition_id',
            'joinType' => 'INNER'
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
            ->dateTime('starting_date')
            ->allowEmpty('starting_date');

        $validator
            ->dateTime('finishing_date')
            ->allowEmpty('finishing_date');

        $validator
            ->integer('points')
            ->allowEmpty('points');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['competition_id'], 'Competition'));

        return $rules;
    }
}
