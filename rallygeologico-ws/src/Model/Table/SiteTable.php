<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Site Model
 *
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
        $this->setDisplayField('SiteId');
        $this->setPrimaryKey('SiteId');

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
            ->integer('SiteId')
            ->allowEmpty('SiteId', 'create');

        $validator
            ->scalar('Name')
            ->maxLength('Name', 30)
            ->requirePresence('Name', 'create')
            ->notEmpty('Name');

        $validator
            ->integer('PointsAwarded')
            ->requirePresence('PointsAwarded', 'create')
            ->notEmpty('PointsAwarded');

        $validator
            ->scalar('QrUrl')
            ->maxLength('QrUrl', 200)
            ->allowEmpty('QrUrl');

        $validator
            ->scalar('Details')
            ->maxLength('Details', 2000)
            ->allowEmpty('Details');

        $validator
            ->scalar('Description')
            ->maxLength('Description', 2000)
            ->allowEmpty('Description');

        $validator
            ->numeric('Latitude')
            ->requirePresence('Latitude', 'create')
            ->notEmpty('Latitude');

        $validator
            ->numeric('Longitude')
            ->requirePresence('Longitude', 'create')
            ->notEmpty('Longitude');

        $validator
            ->scalar('ProvinceName')
            ->maxLength('ProvinceName', 40)
            ->requirePresence('ProvinceName', 'create')
            ->notEmpty('ProvinceName');

        return $validator;
    }
}
