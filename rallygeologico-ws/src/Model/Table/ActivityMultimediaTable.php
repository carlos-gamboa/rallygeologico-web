<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ActivityMultimedia Model
 *
 * @property \App\Model\Table\ActivityTable|\Cake\ORM\Association\BelongsTo $Activity
 * @property \App\Model\Table\MultimediaTable|\Cake\ORM\Association\BelongsTo $Multimedia
 *
 * @method \App\Model\Entity\ActivityMultimedia get($primaryKey, $options = [])
 * @method \App\Model\Entity\ActivityMultimedia newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ActivityMultimedia[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ActivityMultimedia|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ActivityMultimedia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityMultimedia[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ActivityMultimedia findOrCreate($search, callable $callback = null, $options = [])
 */
class ActivityMultimediaTable extends Table
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

        $this->setTable('activity_multimedia');
        $this->setDisplayField('activity_id');
        $this->setPrimaryKey(['activity_id', 'multimedia_id']);

        $this->belongsTo('Activity', [
            'foreignKey' => 'activity_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Multimedia', [
            'foreignKey' => 'multimedia_id',
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
        $rules->add($rules->existsIn(['activity_id'], 'Activity'));
        $rules->add($rules->existsIn(['multimedia_id'], 'Multimedia'));

        return $rules;
    }
}
