<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rally Model
 *
 * @property \App\Model\Table\SiteTable|\Cake\ORM\Association\BelongsToMany $Site
 *
 * @method \App\Model\Entity\Rally get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rally newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Rally[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rally|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rally patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rally[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rally findOrCreate($search, callable $callback = null, $options = [])
 */
class RallyTable extends Table
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

        $this->setTable('rally');
        $this->setDisplayField('RallyId');
        $this->setPrimaryKey('RallyId');

        $this->belongsToMany('Site', [
            'foreignKey' => 'rally_id',
            'targetForeignKey' => 'site_id',
            'joinTable' => 'rally_site'
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
            ->integer('RallyId')
            ->allowEmpty('RallyId', 'create');

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
            ->scalar('ImageUrl')
            ->maxLength('ImageUrl', 200)
            ->allowEmpty('ImageUrl');

        $validator
            ->scalar('Description')
            ->maxLength('Description', 5000)
            ->allowEmpty('Description');

        return $validator;
    }
}
