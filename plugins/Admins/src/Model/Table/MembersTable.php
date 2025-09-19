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

class MembersTable extends Table{

    

    public function initialize(array $config): void{

        parent::initialize($config);



        $this->setTable('members');

        $this->setDisplayField('name');

        $this->setPrimaryKey('id');

 

       /* $this->hasMany('CartProduct', [

            'foreignKey' => 'user_id',

            'className' => 'Admins.CartProduct',

        ]);*/

        

    }



    /*public function findAuth(\Cake\ORM\Query $query, array $options){

		return $query->where(['Users.type' => 'Admin']);

	}*/

	

	public function validationUpdate($validator){

		$validator

			->allowEmptyString('password','create')

			->notEmptyString('password', __('You must specify your current password here.'))							

			->allowEmptyString('new_password','create')

			->notEmptyString('new_password', __('You must specify your new password here.'))			

			->allowEmptyString('confirm_password','create')

			->notEmptyString('confirm_password', __('You must specify your confirm password here.'))			

			->add('confirm_password', 'comparison', [

				'rule' => function ($value, $context){

					return $value == $context['data']['new_password'];

				},

				'message' => 'Confirm password must be equal to new password.'

			])

			->add('new_password', 'length', [

				'rule' => ['lengthBetween', 8, 15],

				'message' => 'Your password must be 8 to 15 characters.',

			])

			->add('new_password', 'strongPassword', [

				'rule' => ['strongPasswordChk'],

				'message' => 'Password should include at least one upper case letter, one number, and one special character.',

				'provider' => 'table',

			]);

		return $validator;

	}

	

	public function validationDefault(Validator $validator): Validator{

		$validator = new Validator();

		

		$validator

			->allowEmptyString('name', 'create')

			->notEmptyString('name', 'You must specify your name here.')

			->allowEmptyString('email', 'create')

			->notEmptyString('email', 'You must specify your email here.')

			->allowEmptyString('contact', 'create')

			->notEmptyString('contact', 'You must specify your contact number here.')

			->add('email', 'validemail', [

				'rule' => 'email',

				'message' => 'You must specify your valid email address here.',

			])

			->add('email', 'update', [

				'rule' => ['isCheckUniqueEmail'],

				'message' => 'Email address already exists.',

				'provider' => 'table',

			]);

			

		return $validator;

	}

	

	public function isCheckUniqueEmail($field,$id=NULL){

		if(isset($id['data']['id']) && !empty($id['data']['id'])){

			$userData = $this->find()->where(array('email' => $field, 'id != ' => $id['data']['id']))->first();

			if(isset($userData->id)){

				return false;

			}else{

				return true;	

			}	

		}else{

			$userData = $this->find()->where(array('email' => $field))->first();

			if(isset($userData->id)){

				return false;	

			}else{

				return true;	

			}

		}

	}

	

	

}

?>