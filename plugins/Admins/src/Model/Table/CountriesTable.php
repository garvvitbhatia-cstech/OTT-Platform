<?php
declare(strict_types=1);

namespace Admins\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Countries Model
 *
 * @property \Admins\Model\Table\CitiesTable&\Cake\ORM\Association\HasMany $Cities
 * @property \Admins\Model\Table\StatesTable&\Cake\ORM\Association\HasMany $States
 *
 * @method \Admins\Model\Entity\Country newEmptyEntity()
 * @method \Admins\Model\Entity\Country newEntity(array $data, array $options = [])
 * @method \Admins\Model\Entity\Country[] newEntities(array $data, array $options = [])
 * @method \Admins\Model\Entity\Country get($primaryKey, $options = [])
 * @method \Admins\Model\Entity\Country findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Admins\Model\Entity\Country patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Admins\Model\Entity\Country[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Admins\Model\Entity\Country|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admins\Model\Entity\Country saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admins\Model\Entity\Country[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Admins\Model\Entity\Country[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Admins\Model\Entity\Country[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Admins\Model\Entity\Country[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CountriesTable extends Table
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

        $this->setTable('countries');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Cities', [
            'foreignKey' => 'country_id',
            'className' => 'Admins.Cities',
        ]);
        $this->hasMany('States', [
            'foreignKey' => 'country_id',
            'className' => 'Admins.States',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator{
		$validator = new Validator();
		
		$validator
			->allowEmptyString('country_name', 'create')
			->notEmpty('country_name', 'You must specify your country name here.')
			->add('country_name', 'update', [
				'rule' => ['isCheckUniqueCountry'],
				'message' => 'Country name already exists.',
				'provider' => 'table',
			])
			->allowEmptyString('country_code', 'create')
			->notEmpty('country_code', 'You must specify your country code here.')
			->allowEmptyString('phonecode', 'create')
			->notEmpty('phonecode', 'You must specify your phone code here.')			
			->allowEmptyString('phone_no_format', 'create')
			->notEmpty('phone_no_format', 'You must specify your phone number format here.');
		return $validator;
	}
	
	public function isCheckUniqueCountry($field,$id=NULL){
		if(isset($id['data']['id']) && !empty($id['data']['id'])){
			$countryData = $this->find()->where(array('country_name' => $field, 'id != ' => $id['data']['id']))->first();
			if(isset($countryData->id)){
				return false;
			}else{
				return true;	
			}	
		}else{
			$countryData = $this->find()->where(array('country_name' => $field))->first();
			if(isset($countryData->id)){
				return false;	
			}else{
				return true;	
			}
		}
	}
	
	public function beforeSave(EventInterface $event, $entity, $options){
		if ($entity->isNew() && !$entity->created) {
			$entity->created = time();
			$entity->modified = time();
		}
		if (!$entity->isNew() && $entity->modified){
			$entity->modified = time();
		}
	}
}
