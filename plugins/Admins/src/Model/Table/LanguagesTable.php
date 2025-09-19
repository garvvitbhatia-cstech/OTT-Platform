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

class LanguagesTable extends Table

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



        $this->setTable('languages');

        $this->setDisplayField('title');

        $this->setPrimaryKey('id');

        
    }

}

