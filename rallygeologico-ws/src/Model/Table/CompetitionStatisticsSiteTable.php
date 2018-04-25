<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompetitionStatisticsSite Model
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
        $this->setDisplayField('FacebookId');
        $this->setPrimaryKey(['FacebookId', 'CompetitionId', 'SiteId']);
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
            ->integer('SiteId')
            ->allowEmpty('SiteId', 'create');

        return $validator;
    }
}
