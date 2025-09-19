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

class FooterNavigationsTable extends Table{

    /**

     * Initialize method

     *

     * @param array $config The configuration for the Table.

     * @return void

     */

    public function initialize(array $config): void {

        parent::initialize($config);
		
        $this->setTable('footer_navigations');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');
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
			// A list of fields
			->allowEmptyString('title','create')
			->notEmptyString('title', __('You must specify your title here.'))
			->add('title', 'update', [
				'rule' => ['isCheckUniqueTitle'],
				'message' => 'Title already exists.',
				'provider' => 'table',
			])
			->allowEmptyString('param','create')
			->notEmptyString('param', __('You must specify your param name here.'))
			->allowEmptyString('link','create')
			->notEmptyString('link', __('You must specify your link here.'));

		return $validator;
	}
	
	public function isCheckUniqueTitle($field,$id=NULL){
		if(isset($id['data']['id']) && !empty($id['data']['id'])){
			$navigationData = $this->find()->where(array('title' => $field, 'id != ' => $id['data']['id']))->first();
			if(isset($navigationData->id)){
				return false;
			}else{
				return true;	
			}	
		}else{
			$navigationDatas = $this->find()->where(array('title' => $field))->first();
			if(isset($navigationDatas->id)){
				return false;	
			}else{
				return true;	
			}
		}
	}
	
    /**

     * Returns a rules checker object that will be used for validating

     * application integrity.

     *

     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.

     * @return \Cake\ORM\RulesChecker

     */
}

