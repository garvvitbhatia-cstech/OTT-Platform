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

class FooterTable extends Table{
    /**

     * Initialize method

     *

     * @param array $config The configuration for the Table.

     * @return void

     */

    public function initialize(array $config): void{
        parent::initialize($config);
        $this->setTable('footer');
    }

    /**

     * Default validation rules.

     *

     * @param \Cake\Validation\Validator $validator Validator instance.

     * @return \Cake\Validation\Validator

     */
	

	public function validationUpdatefootercontent($validator){
		$validator
			->allowEmptyString('heading','create')
			->notEmptyString('heading', __('You must specify your heading here.'))
			
			->allowEmptyString('sub_heading','create')
			->notEmptyString('sub_heading', __('You must specify your sub heading here.'));
		return $validator;
	}


}

?>