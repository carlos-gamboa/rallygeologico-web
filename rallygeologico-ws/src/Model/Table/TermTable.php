<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Term Model
 *
 * @property \App\Model\Table\SiteTable|\Cake\ORM\Association\BelongsToMany $Site
 * @property \App\Model\Table\SiteTable|\Cake\ORM\Association\BelongsToMany $Multimedia
 *
 * @method \App\Model\Entity\Term get($primaryKey, $options = [])
 * @method \App\Model\Entity\Term newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Term[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Term|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Term patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Term[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Term findOrCreate($search, callable $callback = null, $options = [])
 */
class TermTable extends Table
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

        $this->setTable('term');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Site', [
            'foreignKey' => 'term_id',
            'targetForeignKey' => 'site_id',
            'joinTable' => 'term_site'
        ]);

        $this->belongsToMany('Multimedia', [
            'foreignKey' => 'term_id',
            'targetForeignKey' => 'multimedia_id',
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
            ->scalar('name')
            ->maxLength('name', 40)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 5000)
            ->allowEmpty('description');

        return $validator;
    }
}
