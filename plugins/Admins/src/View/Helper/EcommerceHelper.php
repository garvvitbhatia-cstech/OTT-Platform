<?php

namespace Admins\View\Helper;

use Cake\View\Helper;

use Cake\ORM\TableRegistry;

use Aws\S3\S3Client;

use Cake\Core\Configure;

use Cake\Core\Configure\Engine\PhpConfig;



class EcommerceHelper extends Helper{



	#get sub category  data

    public function getSubCategory($categoryList=NULL,$parentId=NULL){

		$Table = TableRegistry::get('Categories');

		$list = '';		

		$list .= '<option value="">Root</option>';

		if(!empty($categoryList)){

			foreach($categoryList as $keys => $vals):

				$seleted = '';

				$newList = $Table->find()->where(array('parent_id' => $keys,'status'=>1))->all();

				if($parentId == $keys){$seleted = 'selected="selected"';}				

				$list .= '<option '.$seleted.' value="'.$keys.'">'.ucwords($vals).'</option>';

				foreach($newList as $nKey => $nVal):

					$list .= '<option disabled="disabled" value=""> → '.ucwords($nVal['name']).'</option>';

				endforeach;				

			endforeach;				

			return $list;

		}        

	}

	

	#get all category  data

    public function getAllCategory($catId=NULL){
		
		$selectedIDs = explode(",",$catId);
		
		$Table = TableRegistry::get('Categories');
		$list = '';		
		$list .= '<option value="">Category Names</option>';

		$categoryList = $Table->find('all')->where(array('status' => 1))->order(array('ordering' => 'ASC'));

		if(!empty($categoryList)){
			foreach($categoryList as $keys => $vals):

				$seleted = '';
				if(in_array($vals->id,$selectedIDs)){$seleted = 'selected="selected"';}
				$list .= '<option '.$seleted.' value="'.$vals->id.'">'.ucwords($vals->name).'</option>';

			endforeach;
			return $list;
		}        
	}
	#get cagetgory name

	public function getCategoryNameById($catId=NULL){

		$Table = TableRegistry::get('Categories');

		$category = $Table->find()->where(array('id' => $catId))->first();

		if(!empty($category)){

			return ucwords($category->name);

		}

	}

	

	#get cagetgory name

	public function getCategoryExist($catId=NULL){

		$Table = TableRegistry::get('Products');

		$category = $Table->find()->where(array('category_id' => $catId))->all();

		if($category->count() > 0){

			return $category->count();

		}else{

			return 0;

		}

	}

	

	#get product details

    public function getItemDetails($itemId = NULL){

		$Table = TableRegistry::get('Packages');

        return $Table->find()->where(array('id' => $itemId))->first();

	}

}