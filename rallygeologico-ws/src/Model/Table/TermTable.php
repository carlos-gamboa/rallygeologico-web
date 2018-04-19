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
        $this->setDisplayField('TermID');
        $this->setPrimaryKey('TermID');

        $this->belongsToMany('Site', [
            'foreignKey' => 'term_id',
            'targetForeignKey' => 'site_id',
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
            ->integer('TermID')
            ->allowEmpty('TermID', 'create');

        $validator
            ->scalar('ImageUrl')
            ->maxLength('ImageUrl', 2000)
            ->allowEmpty('ImageUrl');

        $validator
            ->scalar('VideoUrl')
            ->maxLength('VideoUrl', 200)
            ->allowEmpty('VideoUrl');

        $validator
            ->scalar('Name')
            ->maxLength('Name', 40)
            ->requirePresence('Name', 'create')
            ->notEmpty('Name');

        $validator
            ->scalar('Description')
            ->maxLength('Description', 2000)
            ->allowEmpty('Description');

        return $validator;
    }
}
