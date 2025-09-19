<?php

declare(strict_types=1);



namespace Admins\Model\Table;



use Cake\ORM\Query;

use Cake\ORM\RulesChecker;

use Cake\ORM\Table;

use Cake\Validation\Validator;



/**

 * Categories Model

 *

 * @property \Admins\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $ParentCategories

 * @property \Admins\Model\Table\CategoriesTable&\Cake\ORM\Association\HasMany $ChildCategories

 * @property \Admins\Model\Table\ProductsTable&\Cake\ORM\Association\HasMany $Products

 *

 * @method \Admins\Model\Entity\Category newEmptyEntity()

 * @method \Admins\Model\Entity\Category newEntity(array $data, array $options = [])

 * @method \Admins\Model\Entity\Category[] newEntities(array $data, array $options = [])

 * @method \Admins\Model\Entity\Category get($primaryKey, $options = [])

 * @method \Admins\Model\Entity\Category findOrCreate($search, ?callable $callback = null, $options = [])

 * @method \Admins\Model\Entity\Category patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])

 * @method \Admins\Model\Entity\Category[] patchEntities(iterable $entities, array $data, array $options = [])

 * @method \Admins\Model\Entity\Category|false save(\Cake\Datasource\EntityInterface $entity, $options = [])

 * @method \Admins\Model\Entity\Category saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])

 * @method \Admins\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])

 * @method \Admins\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])

 * @method \Admins\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])

 * @method \Admins\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])

 *

 * @mixin \Cake\ORM\Behavior\TimestampBehavior

 */

class CategoriesTable extends Table

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



        $this->setTable('categories');

        $this->setDisplayField('name');

        $this->setPrimaryKey('id');



        /*$this->belongsTo('ParentCategories', [

            'className' => 'Admins.Categories',

            'foreignKey' => 'parent_id',

        ]);

        $this->hasMany('ChildCategories', [

            'className' => 'Admins.Categories',

            'foreignKey' => 'parent_id',

        ]);*/

        $this->hasMany('Products', [

            'foreignKey' => 'category_id',

            'className' => 'Admins.Products',

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

			->allowEmptyString('name', 'create')

			->notEmptyString('name', 'You must specify your category name here.')

			->add('state', 'update', [

				'rule' => ['isCheckUniqueCategory'],

				'message' => 'category name already exists.',

				'provider' => 'table',

			]);

		return $validator;

	}

	

	public function isCheckUniqueCategory($field,$id=NULL){

		if(isset($id['data']['id']) && !empty($id['data']['id'])){

			$stateData = $this->find()->where(array('name' => $field, 'id != ' => $id['data']['id']))->first();

			if(isset($stateData->id)){

				return false;

			}else{

				return true;	

			}	

		}else{

			$stateData = $this->find()->where(array('name' => $field))->first();

			if(isset($stateData->id)){

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

	}



    /**

     * Returns a rules checker object that will be used for validating

     * application integrity.

     *

     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.

     * @return \Cake\ORM\RulesChecker

     */

   

}

