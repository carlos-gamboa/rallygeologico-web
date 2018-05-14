<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RallySite Model
 *
 * @property \App\Model\Table\RallyTable|\Cake\ORM\Association\BelongsTo $Rally
 * @property \App\Model\Table\SiteTable|\Cake\ORM\Association\BelongsTo $Site
 *
 * @method \App\Model\Entity\RallySite get($primaryKey, $options = [])
 * @method \App\Model\Entity\RallySite newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RallySite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RallySite|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RallySite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RallySite[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RallySite findOrCreate($search, callable $callback = null, $options = [])
 */
class RallySiteTable extends Table
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

        $this->setTable('rally_site');
        $this->setDisplayField('rally_id');
        $this->setPrimaryKey(['rally_id', 'site_id']);

        $this->belongsTo('Rally', [
            'foreignKey' => 'rally_id',
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
        $rules->add($rules->existsIn(['rally_id'], 'Rally'));
        $rules->add($rules->existsIn(['site_id'], 'Site'));

        return $rules;
    }
}
