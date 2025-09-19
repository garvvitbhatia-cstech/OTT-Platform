<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class LanguagesTable extends Table
{
	public function singleRecord($id){
		$pageData = $this->find()->where(array('id' => $id))->first();
		return $pageData;
	}
	public function conditionalSingleRecord($conditions){
		$pageData = $this->find()->where($conditions)->first();
		return $pageData;
	}
	public function conditionalRecordCount($conditions){
		$pageData = $this->find()->where($conditions)->count();
		return $pageData;
	}
	public function createRecord($data){
		$tableEntity = $this->newEntity($data);
		$result = $this->save($tableEntity);
		return $result->id;
	}
	public function conditionalRecords($conditions){
		$pageData = $this->find()->where($conditions)->order(array('title' => 'ASC'))->all();
		return $pageData;
	}
}
