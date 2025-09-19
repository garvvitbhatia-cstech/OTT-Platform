<?php
declare(strict_types=1);

namespace Admins\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property \Admins\Model\Table\InvoicesTable&\Cake\ORM\Association\BelongsTo $Invoices
 * @property \Admins\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \Admins\Model\Table\ItemsTable&\Cake\ORM\Association\BelongsTo $Items
 *
 * @method \Admins\Model\Entity\Order newEmptyEntity()
 * @method \Admins\Model\Entity\Order newEntity(array $data, array $options = [])
 * @method \Admins\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \Admins\Model\Entity\Order get($primaryKey, $options = [])
 * @method \Admins\Model\Entity\Order findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Admins\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Admins\Model\Entity\Order[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Admins\Model\Entity\Order|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admins\Model\Entity\Order saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Admins\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Admins\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Admins\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Admins\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdersTable extends Table
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

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

    }

}
