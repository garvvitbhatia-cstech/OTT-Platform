<?php

declare(strict_types=1);



namespace Admins\Model\Table;



use Cake\ORM\Query;

use Cake\ORM\RulesChecker;

use Cake\ORM\Table;

use Cake\Validation\Validator;



/**

 * Products Model

 *

 * @property \Admins\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories

 * @property \Admins\Model\Table\CartProductTable&\Cake\ORM\Association\HasMany $CartProduct

 * @property \Admins\Model\Table\ProductImagesTable&\Cake\ORM\Association\HasMany $ProductImages

 * @property \Admins\Model\Table\ProductOrderTable&\Cake\ORM\Association\HasMany $ProductOrder

 *

 * @method \Admins\Model\Entity\Product newEmptyEntity()

 * @method \Admins\Model\Entity\Product newEntity(array $data, array $options = [])

 * @method \Admins\Model\Entity\Product[] newEntities(array $data, array $options = [])

 * @method \Admins\Model\Entity\Product get($primaryKey, $options = [])

 * @method \Admins\Model\Entity\Product findOrCreate($search, ?callable $callback = null, $options = [])

 * @method \Admins\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])

 * @method \Admins\Model\Entity\Product[] patchEntities(iterable $entities, array $data, array $options = [])

 * @method \Admins\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, $options = [])

 * @method \Admins\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])

 * @method \Admins\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])

 * @method \Admins\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])

 * @method \Admins\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])

 * @method \Admins\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])

 *

 * @mixin \Cake\ORM\Behavior\TimestampBehavior

 */

class ProductsTable extends Table

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

				

        $this->setTable('products');

        $this->setDisplayField('id');

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

			->allowEmptyString('category_id','create')

			->notEmptyString('category_id', __('You must specify your category name here.'))

			->allowEmptyString('product_name','create')

			->notEmptyString('product_name', __('You must specify your product name here.'))			

			->add('product_name', 'checkUniqueProduct', [

				'rule' => 'isCheckUniqueProduct',

				'message' => 'Product name already exists.',

				'provider' => 'table',

			]);

			

		return $validator;

	}

	

	public function isCheckUniqueProduct($field,$id=NULL){

		if(isset($id['data']['id']) && !empty($id['data']['id'])){

			$productData = $this->find()->where(array('product_name' => $field, 'id != ' => $id['data']['id']))->first();

			if(isset($productData->id)){

				return false;

			}else{

				return true;	

			}	

		}else{

			$productData = $this->find()->where(array('product_name' => $field))->first();

			if(isset($productData->id)){

				return false;	

			}else{

				return true;	

			}

		}

	}

}

