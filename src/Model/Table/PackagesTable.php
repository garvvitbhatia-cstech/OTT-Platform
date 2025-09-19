<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

class PackagesTable extends Table
{
	public function singleRecord($id){
		$pageData = $this->find()->where(array('id' => $id))->first();
		return $pageData;
	}
	public function countRecord($id){
		$count = $this->find()->where(array('id' => $id))->count();
		return $count;
	}
}
