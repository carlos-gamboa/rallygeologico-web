<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Competition Model
 *
 * @property \App\Model\Table\RallyTable|\Cake\ORM\Association\BelongsTo $Rally
 * @property \App\Model\Table\CompetitionStatisticsTable|\Cake\ORM\Association\HasMany $CompetitionStatistics
 * @property \App\Model\Table\CompetitionStatisticsSiteTable|\Cake\ORM\Association\HasMany $CompetitionStatisticsSite
 * @property \App\Model\Table\InvitationTable|\Cake\ORM\Association\HasMany $Invitation
 *
 * @method \App\Model\Entity\Competition get($primaryKey, $options = [])
 * @method \App\Model\Entity\Competition newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Competition[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Competition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Competition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Competition[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Competition findOrCreate($search, callable $callback = null, $options = [])
 */
class CompetitionTable extends Table
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

        $this->setTable('competition');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Rally', [
            'foreignKey' => 'rally_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('CompetitionStatistics', [
            'foreignKey' => 'competition_id'
        ]);
        $this->hasMany('CompetitionStatisticsSite', [
            'foreignKey' => 'competition_id'
        ]);
        $this->hasMany('Invitation', [
            'foreignKey' => 'competition_id'
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
            ->scalar('is_active')
            ->allowEmpty('is_active');

        $validator
            ->dateTime('starting_date')
            ->allowEmpty('starting_date');

        $validator
            ->dateTime('finishing_date')
            ->allowEmpty('finishing_date');

        $validator
            ->scalar('is_public')
            ->allowEmpty('is_public');

        $validator
            ->scalar('Name')
            ->maxLength('Name', 30)
            ->requirePresence('Name', 'create')
            ->notEmpty('Name');

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
        $rules->add($rules->existsIn(['rally_id'], 'Rally'));

        return $rules;
    }
}
