<?php

namespace App\View\Helper;

use Cake\View\Helper;

use Cake\ORM\TableRegistry;

use Aws\S3\S3Client;

use Cake\Core\Configure;

use Cake\Core\Configure\Engine\PhpConfig;



class UserHelper extends Helper{

	#get product details

    public function getSingleRecord($id){
		$Table = TableRegistry::get('Users');
        return $Table->find()->where(array('id' => $id))->first();
	}
	public function getSingleRecordByEmail($email){
		$Table = TableRegistry::get('Users');
        return $Table->find()->where(array('email' => $email))->first();
	}
	public function getTotalView($vID,$type){
		
		$Table = TableRegistry::get('ProductViews');
		$records = $Table->find()->where(array('type' => $type, 'product_id' => $vID))->all();
		$b = 0;
		foreach($records as $key => $record){
			$b = $b+$record->duration;
		}
		$totalTime = $this->setTimeFormating($b);
		
		return array('video_duration' => $totalTime, 'video_views' => $records->count());
	}
	public function setTimeFormating($seconds){
		//$seconds = 8525;
		$H = floor($seconds / 3600);
		$i = ($seconds / 60) % 60;
		$s = $seconds % 60;
		return sprintf("%02d:%02d:%02d", $H, $i, $s);
	}

}