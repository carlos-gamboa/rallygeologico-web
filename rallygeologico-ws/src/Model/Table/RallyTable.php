<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rally Model
 *
 * @property \App\Model\Table\CompetitionTable|\Cake\ORM\Association\HasMany $Competition
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
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Competition', [
            'foreignKey' => 'rally_id'
        ]);
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
            ->scalar('image_url')
            ->maxLength('image_url', 200)
            ->allowEmpty('image_url');

        $validator
            ->scalar('description')
            ->maxLength('description', 5000)
            ->allowEmpty('description');

        return $validator;
    }
}
