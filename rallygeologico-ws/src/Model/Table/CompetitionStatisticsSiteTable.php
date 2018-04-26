<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompetitionStatisticsSite Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CompetitionStatisticsTable|\Cake\ORM\Association\BelongsTo $CompetitionStatistics
 * @property \App\Model\Table\SiteTable|\Cake\ORM\Association\BelongsTo $Site
 *
 * @method \App\Model\Entity\CompetitionStatisticsSite get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompetitionStatisticsSite newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CompetitionStatisticsSite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompetitionStatisticsSite|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompetitionStatisticsSite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompetitionStatisticsSite[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompetitionStatisticsSite findOrCreate($search, callable $callback = null, $options = [])
 */
class CompetitionStatisticsSiteTable extends Table
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

        $this->setTable('competition_statistics_site');
        $this->setDisplayField('user_id');
        $this->setPrimaryKey(['user_id', 'competition_id', 'site_id']);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('CompetitionStatistics', [
            'foreignKey' => 'competition_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Site', [
            'foreignKey' => 'site_id',
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['competition_id'], 'CompetitionStatistics'));
        $rules->add($rules->existsIn(['site_id'], 'Site'));

        return $rules;
    }
}
