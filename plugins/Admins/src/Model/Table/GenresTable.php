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

class GenresTable extends Table
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

        $this->setTable('genres');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

    }


public function validationDefault(Validator $validator): Validator{
		$validator = new Validator();
		$validator
			->allowEmptyString('title', 'create')
			->notEmptyString('title', 'You must specify your genere title here.')
			->add('title', 'create', [
				'rule' => ['isCheckUniqueGenere'],
				'message' => 'Genere title already exists.',
				'provider' => 'table',
			]);
		return $validator;
	}

	

	public function isCheckUniqueGenere($field,$id=NULL){

		if(isset($id['data']['id']) && !empty($id['data']['id'])){

			$Data = $this->find()->where(array('title' => $field, 'id != ' => $id['data']['id']))->first();

			if(isset($Data->id)){

				return false;

			}else{

				return true;	

			}	

		}else{

			$Data = $this->find()->where(array('title' => $field))->first();

			if(isset($Data->id)){

				return false;	

			}else{

				return true;	

			}

		}

	}

}

