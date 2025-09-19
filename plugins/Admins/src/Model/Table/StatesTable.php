<?php
declare(strict_types=1);

namespace Admins\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * States Model
 *
 * @property \Admins\Model\Table\CountriesTable&\Cake\ORM\Association\BelongsTo $Countries
 * @property \Admins\Model\Table\CitiesTable&\Cake\ORM\Association\HasMany $Cities
 *
 * @method \Admins\Model\Entity\State newEmptyEntity()
 * @method \Admins\Model\Entity\State newEntity(array $data, array $options = [])
 * @method \Admins\Model\Entity\State[] newEntities(array $data, array $options = [])
 * @method \Admins\Model\Entity\State get($primaryKey, $options = [])
 * @method \Admins\Model\Entity\State findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Admins\Model\Entity\State patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Admins\Model\Entity\State[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Admins\Model\Entity\State|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admins\Model\Entity\State saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admins\Model\Entity\State[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Admins\Model\Entity\State[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Admins\Model\Entity\State[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Admins\Model\Entity\State[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StatesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('states');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER',
            'className' => 'Admins.Countries',
        ]);
        $this->hasMany('Cities', [
            'foreignKey' => 'state_id',
            'className' => 'Admins.Cities',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('state')
            ->maxLength('state', 50)
            ->requirePresence('state', 'create')
            ->notEmptyString('state');

        $validator
            ->scalar('abbreviation')
            ->maxLength('abbreviation', 50)
            ->requirePresence('abbreviation', 'create')
            ->notEmptyString('abbreviation');

        $validator
            ->notEmptyString('status');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['country_id'], 'Countries'), ['errorField' => 'country_id']);

        return $rules;
    }
}
