<?php
declare(strict_types=1);
namespace Admins\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**

 * Users Model

 *

 * @property \Admins\Model\Table\CartProductTable&\Cake\ORM\Association\HasMany $CartProduct

 * @property \Admins\Model\Table\OrdersTable&\Cake\ORM\Association\HasMany $Orders

 * @property \Admins\Model\Table\ProductOrderTable&\Cake\ORM\Association\HasMany $ProductOrder

 *

 * @method \Admins\Model\Entity\User newEmptyEntity()

 * @method \Admins\Model\Entity\User newEntity(array $data, array $options = [])

 * @method \Admins\Model\Entity\User[] newEntities(array $data, array $options = [])

 * @method \Admins\Model\Entity\User get($primaryKey, $options = [])

 * @method \Admins\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])

 * @method \Admins\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])

 * @method \Admins\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])

 * @method \Admins\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])

 * @method \Admins\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])

 * @method \Admins\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])

 * @method \Admins\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])

 * @method \Admins\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])

 * @method \Admins\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])

 *

 * @mixin \Cake\ORM\Behavior\TimestampBehavior

 */

class CouponCodesTable extends Table{

    /**

     * Initialize method

     *

     * @param array $config The configuration for the Table.

     * @return void

     */

    public function initialize(array $config): void{

        parent::initialize($config);

        $this->setTable('coupon_codes');
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
			->allowEmptyString('title', 'create')
			->notEmptyString('title', 'You must specify your coupon title here.')
			->add('title', 'create', [
				'rule' => ['isCheckUniqueCoupon'],
				'message' => 'Coupon already exists.',
				'provider' => 'table',
			])
			->allowEmptyString('value', 'create')
			->notEmptyString('value', 'You must specify your coupon value here.')
			->allowEmptyString('expiry_date', 'create')
			->notEmptyString('expiry_date', 'You must specify your expiry date here.');
			
		return $validator;
	}

	

	public function isCheckUniqueCoupon($field,$id=NULL){
		if(isset($id['data']['id']) && !empty($id['data']['id'])){
			$couponData = $this->find()->where(array('title' => $field, 'id != ' => $id['data']['id']))->first();
			if(isset($couponData->id)){
				return false;
			}else{
				return true;	
			}	
		}else{
			$couponData = $this->find()->where(array('title' => $field))->first();
			if(isset($couponData->id)){
				return false;	
			}else{
				return true;	
			}
		}		

	}	

	/*

	public function beforeSave(EventInterface $event, $entity, $options){

		if ($entity->isNew() && !$entity->created) {

			$entity->created = time();

			$entity->modified = time();

		}

		if (!$entity->isNew() && $entity->modified){

			$entity->modified = time();

		}

	}*/

}

?>