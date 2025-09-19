<?php
declare(strict_types=1);

namespace Admins\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductOrder Model
 *
 * @property \Admins\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \Admins\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \Admins\Model\Entity\ProductOrder newEmptyEntity()
 * @method \Admins\Model\Entity\ProductOrder newEntity(array $data, array $options = [])
 * @method \Admins\Model\Entity\ProductOrder[] newEntities(array $data, array $options = [])
 * @method \Admins\Model\Entity\ProductOrder get($primaryKey, $options = [])
 * @method \Admins\Model\Entity\ProductOrder findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Admins\Model\Entity\ProductOrder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Admins\Model\Entity\ProductOrder[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Admins\Model\Entity\ProductOrder|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admins\Model\Entity\ProductOrder saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admins\Model\Entity\ProductOrder[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Admins\Model\Entity\ProductOrder[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Admins\Model\Entity\ProductOrder[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Admins\Model\Entity\ProductOrder[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductOrderTable extends Table
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

        $this->setTable('product_order');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Admins.Users',
        ]);
        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
            'className' => 'Admins.Products',
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
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

        $validator
            ->scalar('price')
            ->maxLength('price', 100)
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->scalar('total')
            ->maxLength('total', 100)
            ->requirePresence('total', 'create')
            ->notEmptyString('total');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['product_id'], 'Products'), ['errorField' => 'product_id']);

        return $rules;
    }
}
