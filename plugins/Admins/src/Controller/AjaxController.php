<?php

declare(strict_types=1);



/**

 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)

 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)

 *

 * Licensed under The MIT License

 * For full copyright and license information, please see the LICENSE.txt

 * Redistributions of files must retain the above copyright notice.

 *

 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)

 * @link      https://cakephp.org CakePHP(tm) Project

 * @since     0.2.9

 * @license   https://opensource.org/licenses/mit-license.php MIT License

 */

namespace Admins\Controller;

use Admins\Controller\AppController;



use Cake\Core\Configure;

use Cake\Http\Exception\ForbiddenException;

use Cake\Http\Exception\NotFoundException;

use Cake\Http\Response;

use Cake\View\Exception\MissingTemplateException;

use Cake\Auth\DefaultPasswordHasher; // Add this line

use Cake\ORM\TableRegistry;

use Cake\Utility\Security; // Add this line



/**

 * Static content controller

 *

 * This controller will render views from templates/Pages/

 *

 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html

 */

class AjaxController extends AppController{

    /**

     * Displays a view

     *

     * @param array ...$path Path segments.

     * @return \Cake\Http\Response|null

     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.

     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not

     *   be found and in debug mode.

     * @throws \Cake\Http\Exception\NotFoundException When the view file could not

     *   be found and not in debug mode.

     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.

     */

	 

	public function initialize(): void{

        parent::initialize();			

	}

	

	public function changeStatus($id=NULL, $status=NULL){
		
		$this->viewBuilder()->setLayout('false');

		$this->autoRender = false;		

		if($this->request->is('Ajax')){
			$postData = $this->request->getData();
			if(!empty($postData)){
				$modal = $postData['modal'];
				$id = $postData['id'];
				$status = $postData['status'];
				$this->loadModel($modal);
				$entity = $this->$modal->findById($id)->firstOrFail();
				$updStatus = ($status == 1)?2:1;			
				$data = $this->$modal->patchEntity($entity,$postData);
				$data['id'] = $id;
				$data['status'] = $updStatus;
				$this->$modal->save($data);
				
				if($modal == 'Banners'){
					$table = TableRegistry::get($modal);
					$bannerDetails = $table->find()->where(array('id' => $id))->first();
					if($bannerDetails->type == 'Media' && $bannerDetails->product_id > 0){
						$videoBannerStatus = ($updStatus == 1)?1:0;	
						$productTable = TableRegistry::get('Products');
						$video['id'] = $bannerDetails->product_id;
						$video['big_banner_status'] = $videoBannerStatus;
						$tableVideoEntity = $productTable->newEntity($video);
						$productTable->save($tableVideoEntity);
					}
				}
			}
			echo json_encode($status);

		}		

		exit;

	}

	

	public function updateOrder(){

		$this->viewBuilder()->setLayout('false');

		if($this->request->is('Ajax')){

			$actualVal = 0;

			$postData = $this->request->getData();
			$id = $postData['id'];
			$prev = $postData['prev'];
			$modal = $postData['modal'];
			$currval = $postData['curval'];

			$table = TableRegistry::get($modal);
			$query = $table->find();
			$record= $query->select(array('max_order' => $query->func()->max('ordering')))->first();
			$actualVal = $record['max_order'];
			if($currval != 0 && is_numeric($currval)){

				$data = $table->find()->where(array('ordering' => $currval))->first();
				#save current row
				$saveData['id'] = $id;
				$saveData['ordering'] = $currval;
				$tableEntity = $table->newEntity($saveData);
				$table->save($tableEntity);

				#save previous row
				if(isset($data['id'])){
					$newData['id'] = $data['id'];
					$newData['ordering'] = $prev;
					$tableEntityNew = $table->newEntity($newData);
					$table->save($tableEntityNew);
				}

			}

		}
		exit;

	}
	public function arrangeOrder($tableName, $rowId){
		$Table = TableRegistry::get($tableName);
		$allReacords = $Table->find()->order(array('ordering'=>'ASC'))->all();
		$counter = 1;
		foreach($allReacords as $allReacord){
			$newData['id'] = $allReacord->id;
			$newData['ordering'] = $counter;
			$tableEntityNew = $Table->newEntity($newData);
			$Table->save($tableEntityNew);
			$counter++;
		}
		return true;
	}
	public function deleteRecord(){

		$this->viewBuilder()->layout = false;
		$this->autoRender = false;		
		if($this->request->is('Ajax')){
			$postData = $this->request->getData();
			if(!empty($postData)){
				$modal = $postData['model'];
				$rowId = $postData['rowId'];
				$table = TableRegistry::get($modal);
				$this->loadModel($modal);
				
				if($modal == 'Banners'){
					$deleteRecord = $table->find()->where(array('id' => $rowId))->first();
					$imageName = $deleteRecord->banner;
					if($imageName != "" && file_exists(WWW_ROOT.'img/banners/'.$imageName) && $deleteRecord->type == 'Custom'){
						unlink(WWW_ROOT.'img/banners/'.$imageName);
					}
					$this->arrangeOrder($modal, $rowId);
				}
				if($modal == 'Products'){
					/*$deleteRecord = $table->find()->where(array('id' => $rowId))->first();
					$videoName = $deleteRecord->video;
					if($videoName != "" && file_exists(WWW_ROOT.'img/products/'.$videoName)){
						unlink(WWW_ROOT.'img/products/'.$videoName);
					}
					$trailerVideo = $deleteRecord->trailer_video;
					if($trailerVideo != "" && file_exists(WWW_ROOT.'img/products/'.$trailerVideo)){
						unlink(WWW_ROOT.'img/products/'.$trailerVideo);
					}
					$bigBanner = $deleteRecord->big_banner;
					if($bigBanner != "" && file_exists(WWW_ROOT.'img/banners/'.$bigBanner)){
						unlink(WWW_ROOT.'img/banners/'.$bigBanner);
					}
					$verticalBanner = $deleteRecord->vertical_banner;
					if($verticalBanner != "" && file_exists(WWW_ROOT.'img/banners/'.$verticalBanner)){
						unlink(WWW_ROOT.'img/banners/'.$verticalBanner);
					}
					$horizontalBanner = $deleteRecord->horizontal_banner;
					if($horizontalBanner != "" && file_exists(WWW_ROOT.'img/banners/'.$horizontalBanner)){
						unlink(WWW_ROOT.'img/banners/'.$horizontalBanner);
					}*/
					/*$bannerTable = TableRegistry::get('Banners');
					$bannerData = $bannerTable->find()->where(array('product_id' => $rowId))->first();
					if(isset($bannerData->id)){
						$this->loadModel('Banners');
						$relatedBanner = $this->Banners->get($bannerData->id);
						$this->Banners->delete($relatedBanner);
						$this->arrangeOrder('Banners', $bannerData->id);
					}*/
				}
				
				if($modal == 'FooterApps'){
					$deleteRecord = $table->find()->where(array('id' => $rowId))->first();
					$imageName = $deleteRecord->icon;
					if($imageName != "" && file_exists(WWW_ROOT.'img/banners/'.$imageName)){
						unlink(WWW_ROOT.'img/banners/'.$imageName);
					}
				}
				$record = $this->$modal->get($rowId);
         		$this->$modal->delete($record);
				if($modal == 'Products'){
					$bannerTable = TableRegistry::get('Banners');
					$bannerData = $bannerTable->find()->where(array('product_id' => $rowId))->first();
					if(isset($bannerData->id)){
						$this->loadModel('Banners');
						$relatedBanner = $this->Banners->get($bannerData->id);
						$this->Banners->delete($relatedBanner);
						$this->arrangeOrder('Banners', $bannerData->id);
					}
				}

			}

		}

		exit;

	}

	

	public function getState(){

		if($this->request->is('Ajax')){

			$postData = $this->request->getData();

			$table = TableRegistry::get('States');

			$states = $table->find('list', ['keyField' => 'id','valueField' => 'state'])->where(['country_id' => $postData['countryId'], 'status' => 1])->order(['country_id' => 'asc']);

			$this->set(compact('states'));

		}

	}

	

	public function getCity(){

		if($this->request->is('Ajax')){

			$postData = $this->request->getData();

			$table = TableRegistry::get('Cities');

			$cities = $table->find('list', ['keyField' => 'id','valueField' => 'city'])->where(['state_id' => $postData['stateId'], 'status' => 1])->order(['city' => 'asc']);

			$this->set(compact('cities'));

		}

	}

}



?>