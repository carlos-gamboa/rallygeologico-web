<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Multimedia Model
 *
 * @property \App\Model\Table\ActivityTable|\Cake\ORM\Association\BelongsToMany $Activity
 * @property \App\Model\Table\TermTable|\Cake\ORM\Association\BelongsToMany $Term
 *
 * @method \App\Model\Entity\Multimedia get($primaryKey, $options = [])
 * @method \App\Model\Entity\Multimedia newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Multimedia[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Multimedia|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Multimedia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Multimedia[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Multimedia findOrCreate($search, callable $callback = null, $options = [])
 */
class MultimediaTable extends Table
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

        $this->setTable('multimedia');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Activity', [
            'foreignKey' => 'multimedia_id',
            'targetForeignKey' => 'activity_id',
            'joinTable' => 'activity_multimedia'
        ]);
        $this->belongsToMany('Term', [
            'foreignKey' => 'multimedia_id',
            'targetForeignKey' => 'term_id',
            'joinTable' => 'term_multimedia'
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
            ->integer('media_type')
            ->requirePresence('media_type', 'create')
            ->notEmpty('media_type');

        $validator
            ->scalar('media_url')
            ->maxLength('media_url', 2000)
            ->allowEmpty('media_url');

        return $validator;
    }
}
