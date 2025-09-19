<?php

namespace App\View\Helper;

use Cake\View\Helper;

use Cake\ORM\TableRegistry;

use Aws\S3\S3Client;

use Cake\Core\Configure;

use Cake\Core\Configure\Engine\PhpConfig;



class MediaHelper extends Helper{

	#get product details

	public function getItems($catID){
		$Table = TableRegistry::get('Products');
        $records = $Table->find()->where(array('status' => 1,'FIND_IN_SET(\''. $catID .'\',Products.category_id)'))->order(array('id' => 'DESC'))->all();
		return $records;
	}
	
	public function getItemsForEmail($catID){
		$Table = TableRegistry::get('Products');
        $records = $Table->find()->where(array('status' => 1,'FIND_IN_SET(\''. $catID .'\',Products.category_id)'))->order(array('id' => 'DESC'))->limit(6)->all();
		return $records;
	}
	
	public function getItem($pID){

		$Table = TableRegistry::get('Products');
        $record = $Table->find()->where(array('id'=>$pID))->first();
		return $record;

	}
	public function getCategory($cateID){
		$exp = explode(',',$cateID);
		$record = array();
		if(isset($exp[0])){
			$Table = TableRegistry::get('Categories');
			$record = $Table->find()->where(array('id'=>$exp[0]))->first();
		}
		return $record;

	}

    public function getVerticalItem($rent,$live,$itemData){

		$img = SITEURL.'img/vertical-no-img.jpg';

		if($itemData['img_v'] != ""){

			$img = SITEURL.'img/banners/'.$itemData['img_v'];

		}
		$movieTitle = $itemData['title'];
		if(strlen($itemData['title']) > 18){
			$movieTitle = substr($itemData['title'],0,18).'...';
		}
		$html = '<div class="item">

				<a href="'.SITEURL.'movie/'.$itemData['cat_slug'].'/'.$itemData['slug'].'/'.'">

				<img src="'.$img.'">';

				if($rent == 1 && $itemData['free_paid'] == 'Paid'){

					$html .= '<span class="rent-tag">Rent</span>';

				}

				$html .= '<span class="overlay-section">

				<span class="tilte-section">

				<span class="title">'.$movieTitle.'</span>

				</span>

				</span>

				</a>

				</div>';

		return $html;

	}

	public function getHorizontalItem($rent,$live,$itemData){

		$img = SITEURL.'img/horizontal-no-img.jpg';

		if($itemData['img_h'] != ""){

			$img = SITEURL.'img/banners/'.$itemData['img_h'];

		}
		$movieTitle = $itemData['title'];
		if(strlen($itemData['title']) > 18){
			$movieTitle = substr($itemData['title'],0,18).'...';
		}
		$html = '<div class="item">

				<a href="'.SITEURL.'movie/'.$itemData['cat_slug'].'/'.$itemData['slug'].'/'.'">';

				if($live == 1){

				$html .= '<span class="live-tag">Live</span>';

				}

				$html .= '<img src="'.$img.'">

				<span class="tilte-section tv-live">

				<span class="title">'.$movieTitle.'</span>

				</span>

				</a>

				</div>';

		return $html;

	}
	public function getFooterContent(){
		$Table = TableRegistry::get('Footer');
        $records = $Table->find()->where(array('id' => 1))->first();
		return $records;
	}
	
	public function getFooterContentApps($type = NULL){
		$Table = TableRegistry::get('FooterApps');
        $records = $Table->find()->where(array('type' => $type))->all();
		return $records;
	}

}