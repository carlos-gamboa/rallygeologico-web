<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompetitionStatisticsActivity Model
 *
 * @property \App\Model\Table\CompetitionStatisticsTable|\Cake\ORM\Association\BelongsTo $CompetitionStatistics
 * @property \App\Model\Table\ActivityTable|\Cake\ORM\Association\BelongsTo $Activity
 *
 * @method \App\Model\Entity\CompetitionStatisticsActivity get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompetitionStatisticsActivity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CompetitionStatisticsActivity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompetitionStatisticsActivity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompetitionStatisticsActivity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompetitionStatisticsActivity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompetitionStatisticsActivity findOrCreate($search, callable $callback = null, $options = [])
 */
class CompetitionStatisticsActivityTable extends Table
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

        $this->setTable('competition_statistics_activity');
        $this->setDisplayField('competition_statistics_id');
        $this->setPrimaryKey(['competition_statistics_id', 'activity_id']);

        $this->belongsTo('CompetitionStatistics', [
            'foreignKey' => 'competition_statistics_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Activity', [
            'foreignKey' => 'activity_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['competition_statistics_id'], 'CompetitionStatistics'));
        $rules->add($rules->existsIn(['activity_id'], 'Activity'));

        return $rules;
    }
}
