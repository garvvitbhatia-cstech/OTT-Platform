<?php
namespace App\View\Helper;
use Cake\View\Helper;
use Cake\ORM\TableRegistry;
use Aws\S3\S3Client;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;

class SettingHelper extends Helper{
	#get product details
    public function getSetting($field){
		$Table = TableRegistry::get('Settings');
        $data = $Table->find()->where(array('id' => 1))->first();
		return $data->$field;
	}
	public function getPackages(){
		$Table = TableRegistry::get('Packages');
        return $Table->find()->where(array('status' => 1))->all();
	}
	public function getLanguages(){
		$Table = TableRegistry::get('Languages');
        return $Table->find()->all();
	}
	public function firstPack(){
		$Table = TableRegistry::get('Packages');
        $record = $Table->find()->where(array('status' => 1))->order(array('id' => 'ASC'))->first();
		return $record->id;
	}
	public function getPackageDetails($id){
		$Table = TableRegistry::get('Packages');
        $record = $Table->find()->where(array('id' => $id))->first();
		return $record;
	}
	public function getApplications($type){
		$Table = TableRegistry::get('FooterApps');
        $records = $Table->find()->where(array('type' => $type, 'status' => 1))->order(array('ordering' => 'ASC'))->all();
		return $records;
	}
	public function headerNavigations(){
		$Table = TableRegistry::get('HeaderNavigations');
        $records = $Table->find()->where(array('status' => 1))->order(array('ordering' => 'ASC'))->all();
		return $records;
	}	
	public function footerNavigations(){		
		$Table = TableRegistry::get('FooterNavigations');        
		$records = $Table->find()->where(array('status' => 1))->order(array('ordering' => 'ASC'))->all();		
		return $records;	
	}
	public function slider(){
		$Table = TableRegistry::get('Banners');
        $records = $Table->find()->where(array('status' => 1))->order(array('ordering' => 'ASC'))->all();
		return $records;
	}
	
	public function getSingleSlider($order){
		$Table = TableRegistry::get('Banners');
        $records = $Table->find()->where(array('status' => 1,'ordering' => $order))->first();
		return $records;
	}
	public function checkSubbscription($userID){
		$result = 'No';
		$currentDate = time();
		$Table = TableRegistry::get('Orders');
        $firstOrder = $Table->find()->where(array('type' => 'Subscription','pack_start_date <=' => $currentDate, 'pack_end_date >= ' => $currentDate, 'payment_status' => 'Completed', 'user_id' => $userID))->order(array('id' => 'DESC'))->first();
		if(isset($firstOrder->id)){
			$result = 'Yes';
		}
		return $result;
	}
	public function checkRental($userID,$itemID){
		$result = 'No';
		$currentDate = time();
		$Table = TableRegistry::get('Orders');
        $firstOrder = $Table->find()->where(array('type' => 'Rental','item_id' => $itemID, 'pack_start_date <=' => $currentDate, 'pack_end_date >= ' => $currentDate, 'payment_status' => 'Completed', 'user_id' => $userID))->order(array('id' => 'DESC'))->first();
		if(isset($firstOrder->id)){
			$result = 'Yes';
		}
		return $result;
	}
	public function getRental($userID){

		$currentDate = time();
		$Table = TableRegistry::get('Orders');
        $rentalOrders = $Table->find()->where(array('type' => 'Rental','pack_start_date <=' => $currentDate, 'pack_end_date >= ' => $currentDate, 'payment_status' => 'Completed', 'user_id' => $userID))->order(array('id' => 'DESC'))->all();

		return $rentalOrders;
	}
	public function getExpireRental($userID){

		$currentDate = time();
		$Table = TableRegistry::get('Orders');
        $rentalOrders = $Table->find()->where(array('type' => 'Rental','pack_end_date <' => $currentDate, 'payment_status' => 'Completed', 'user_id' => $userID))->order(array('id' => 'DESC'))->all();

		return $rentalOrders;
	}
	public function getCurrentPlanDetails($userID){
		$result = 'No';
		$currentDate = time();
		$Table = TableRegistry::get('Orders');
        $firstOrder = $Table->find()->where(array('pack_start_date <=' => $currentDate, 'pack_end_date >= ' => $currentDate, 'payment_status' => 'Completed', 'user_id' => $userID))->order(array('id' => 'DESC'))->first();
		$packageDetails = $this->getPackageDetails($firstOrder->item_id);
		$resultArray = array('plan_title' => $packageDetails->title,'price' => $firstOrder->total,'start_date' => $firstOrder->pack_start_date,'end_date' => $firstOrder->pack_end_date);
		return $resultArray;
	}
}