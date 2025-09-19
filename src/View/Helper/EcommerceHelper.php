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
		$list .= '<option value="">Category Name</option>';
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
	#get all category  data
    public function getAllGenres($catId=NULL){
		$selectedIDs = explode(",",$catId);
		$Table = TableRegistry::get('Genres');
		$list = '';		
		$list .= '<option value="">Genres Title</option>';
		$categoryList = $Table->find('all')->where(array('status' => 1))->order(array('title' => 'ASC'));
		if(!empty($categoryList)){
			foreach($categoryList as $keys => $vals):
				$seleted = '';
				if(in_array($vals->title,$selectedIDs)){$seleted = 'selected="selected"';}
				$list .= '<option '.$seleted.' value="'.$vals->title.'">'.ucwords($vals->title).'</option>';
			endforeach;
			return $list;
		}        
	}
	
	#get cagetgory name
	public function getCategoryNameById($catId=NULL){
		$selectedIDs = explode(",",$catId);
		$Table = TableRegistry::get('Categories');
		$fullName = "";
		foreach($selectedIDs as $selectedID){
			$category = $Table->find()->where(array('id' => $selectedID))->first();
			if(!empty($category)){
				if($fullName == ""){$fullName = ucwords($category->name);}else{ $fullName = $fullName."<br>".ucwords($category->name);}
			}
		}
		return $fullName;
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
	public function getViews($pID){
		
		$Table = TableRegistry::get('ProductViews');
		$records = $Table->find()->where(array('type' => 1, 'product_id' => $pID))->all();
		$b = 0;
		foreach($records as $key => $record){
			$b = $b+$record->duration;
		}
		$totalTime = $this->setTimeFormating($b);
		return array('total_duration' => $totalTime, 'total_view' => $records->count());
		
	}
	
	public function getTrailerViews($pID){
		$Table = TableRegistry::get('ProductViews');
		$records = $Table->find()->where(array('type' => 2, 'product_id' => $pID))->all();
		$b = 0;
		foreach($records as $key => $record){
			$b = $b+$record->duration;
		}
		$totalTime = $this->setTimeFormating($b);
		return array('total_duration' => $totalTime, 'total_view' => $records->count());
		
	}
	public function setTimeFormating($seconds){
		//$seconds = 8525;
		$H = floor($seconds / 3600);
		$i = ($seconds / 60) % 60;
		$s = $seconds % 60;
		return sprintf("%02d:%02d:%02d", $H, $i, $s);
	}
	
	#get product details
    public function getItemDetails($itemId,$type){
		if($type == 'Subscription'){
			$Table = TableRegistry::get('Packages');
			$record = $Table->find()->where(array('id' => $itemId))->first();
			return ucwords($record->title).' ('.$record->type.')';
		}else{
			$Table = TableRegistry::get('Products');
			$record = $Table->find()->where(array('id' => $itemId))->first();
			if(isset($record->product_name)){
			return ucwords($record->product_name).' (Rental)';
			}else{
			    return 'Video title not available';
			}
		}
	}
	
	public function getMediaExist($id=NULL){
		$Table = TableRegistry::get('Products');
		$media = $Table->find()->where(array('id' => $id))->first();
		$video = $trailer_video = 'No';
		if(!empty($media->video)){
			if(file_exists(WWW_ROOT.'img/products/'.$media->video)){
				$video = 'Yes';	
			}
		}
		if(!empty($media->trailer_video)){
			if(file_exists(WWW_ROOT.'img/products/'.$media->trailer_video)){
				$trailer_video = 'Yes';	
			}
		}		
		return array('video' => $video, 'trailer_video' => $trailer_video);		
	}
}