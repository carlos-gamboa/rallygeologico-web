<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Site Model
 *
 * @property \App\Model\Table\DistrictTable|\Cake\ORM\Association\BelongsTo $District
 * @property \App\Model\Table\CompetitionStatisticsTable|\Cake\ORM\Association\BelongsToMany $CompetitionStatistics
 * @property \App\Model\Table\RallyTable|\Cake\ORM\Association\BelongsToMany $Rally
 * @property \App\Model\Table\TermTable|\Cake\ORM\Association\BelongsToMany $Term
 *
 * @method \App\Model\Entity\Site get($primaryKey, $options = [])
 * @method \App\Model\Entity\Site newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Site[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Site|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Site patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Site[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Site findOrCreate($search, callable $callback = null, $options = [])
 */
class SiteTable extends Table
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

        $this->setTable('site');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('District', [
            'foreignKey' => 'district_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('CompetitionStatistics', [
            'foreignKey' => 'site_id',
            'targetForeignKey' => 'competition_statistic_id',
            'joinTable' => 'competition_statistics_site'
        ]);
        $this->belongsToMany('Rally', [
            'foreignKey' => 'site_id',
            'targetForeignKey' => 'rally_id',
            'joinTable' => 'rally_site'
        ]);
        $this->belongsToMany('Term', [
            'foreignKey' => 'site_id',
            'targetForeignKey' => 'term_id',
            'joinTable' => 'term_site'
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
            ->scalar('name')
            ->maxLength('name', 30)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('points_awarded')
            ->requirePresence('points_awarded', 'create')
            ->notEmpty('points_awarded');

        $validator
            ->scalar('qr_url')
            ->maxLength('qr_url', 200)
            ->allowEmpty('qr_url');

        $validator
            ->scalar('details')
            ->maxLength('details', 2000)
            ->allowEmpty('details');

        $validator
            ->scalar('description')
            ->maxLength('description', 2000)
            ->allowEmpty('description');

        $validator
            ->numeric('latitude')
            ->requirePresence('latitude', 'create')
            ->notEmpty('latitude');

        $validator
            ->numeric('longitude')
            ->requirePresence('longitude', 'create')
            ->notEmpty('longitude');

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
        $rules->add($rules->existsIn(['district_id'], 'District'));

        return $rules;
    }
}
