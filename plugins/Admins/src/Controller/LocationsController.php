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

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class LocationsController extends AppController{
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
        $this->loadComponent('Paginator');
    }

	public function countries(){
		$this->set('title_for_layout', 'Countries');
		$this->loadModel('Admins.Countries');
		$session = $this->getUser();

		$conditions = array();
		$postData = $this->request->getQuery();
		if(!empty($postData)){
			if(isset($postData['country_name']) && $postData['country_name'] !=''){
				$conditions['country_name like'] = '%'.$postData['country_name'].'%';
			}
			if(isset($postData['country_code']) && $postData['country_code'] !=''){
				$conditions['country_code like'] = '%'.$postData['country_code'].'%';
			}
			if(isset($postData['phonecode']) && $postData['phonecode'] !=''){
				$conditions['phonecode like'] = '%'.$postData['phonecode'].'%';
			}
			if(isset($postData['status']) && $postData['status'] !=''){
				$conditions['Countries.status'] = $postData['status'];
			}
		}
		$this->paginate['order'] = array('ordering'=>'asc');
		$this->paginate['limit'] = Configure::read('Paginate.limit');
		$this->paginate['conditions'] = $conditions;

		// Paginate the ORM table.
		$this->set('countries', $this->paginate('Countries'));
		$this->set('setStatus', Configure::read('status'));
		$this->set('session',$session);
	}

	public function addCountry($id=NULL){
		$this->set('title_for_layout', 'Add Country');
		$this->loadModel('Admins.Countries');
		$session = $this->getUser();
		$countries = $this->Countries->newEmptyEntity();
		if(isset($id) && !empty($id)){
			$this->set('title_for_layout', 'Edit Country');
			//$id = base64_decode($id);
			$countries = $this->Countries->findById($id)->firstOrFail();
			if(!isset($countries->id) && empty($countries->id)){
				$countries = $this->Countries->newEmptyEntity();
			}
		}
		if($this->request->is(['post', 'put'])){
			$country = $this->Countries->patchEntity($countries, $this->request->getData());
			if(isset($country['old_image']) && !empty($country['old_image']) && $country['old_image'] != $country['flag_image']){
				if(file_exists(Configure::read('Data.RelativePath').'countries/'.$country['old_image'])){
					unlink(Configure::read('Data.RelativePath').'countries/'.$country['old_image']);
				}
			}
			if($record = $this->Countries->save($country)){
				$this->Flash->success(__('The country detail has been saved successfully.'));
				return $this->redirect(['action' => 'addCountry',$record->id]);
			}
			$this->Flash->error(__('Unable to update the country.'));
		}
		$this->set(compact('countries','session'));
	}

	public function viewCountryDetails($id=NULL){
		$this->viewBuilder()->layout = false;
		$this->autoRender = false;
		if($this->request->is('Ajax')){
			$this->loadModel('Admins.Countries');
			$postData = $this->request->getData();
			if(!empty($postData)){
				$id = $postData['countryId'];
				$countryDetails = $this->Countries->findById($id)->firstOrFail();
				$this->set(array('countryDetail'=>$countryDetails));
				$this->render('view_country_details');
			}
		}
	}

	public function states(){
		$this->set('title_for_layout', 'States');
		$this->loadModel('Admins.States');
		$this->loadModel('Admins.Countries');
		$session = $this->getUser();

		$conditions = array();
		$postData = $this->request->getQuery();
		if(!empty($postData)){
			if(isset($postData['country_id']) && $postData['country_id'] !=''){
				$conditions['country_id'] = $postData['country_id'];
			}
			if(isset($postData['state']) && $postData['state'] !=''){
				$conditions['state like'] = '%'.$postData['state'].'%';
			}
			if(isset($postData['status']) && $postData['status'] !=''){
				$conditions['States.status'] = $postData['status'];
			}
		}
		$this->paginate['order'] = array('id'=>'asc');
		$this->paginate['limit'] = Configure::read('Paginate.limit');
		$this->paginate['conditions'] = $conditions;

		// Paginate the ORM table.
		$this->set('states', $this->paginate($this->States->find('all')->contain(['Countries'])));
		$this->set('countryList',$this->getCountryList());
		$this->set('setStatus', Configure::read('status'));
		$this->set('session',$session);
	}

	public function addState($id=NULL){
		$this->set('title_for_layout', 'Add State');
		$this->loadModel('Admins.Countries');
		$this->loadModel('Admins.States');
		$session = $this->getUser();
		$countries = $this->States->newEmptyEntity();
		if(isset($id) && !empty($id)){
			$this->set('title_for_layout', 'Edit State');
			///$id = base64_decode($id);
			$states = $this->States->findById($id)->firstOrFail();
			if(!isset($states->id) && empty($states->id)){
				$states = $this->States->newEmptyEntity();
			}
		}
		if($this->request->is(['post', 'put'])){
			$state = $this->States->patchEntity($states, $this->request->getData());
			if($record = $this->States->save($state)){
				$this->Flash->success(__('The state detail has been saved successfully.'));
				return $this->redirect(['action' => 'addState',$record->id]);
			}
			$this->Flash->error(__('Unable to update the state.'));
		}
		$countryList = $this->getCountryList();
		$this->set(compact('states','session','countryList'));
	}

	public function viewStateDetails($id=NULL){
		$this->viewBuilder()->layout = false;
		$this->autoRender = false;
		if($this->request->is('Ajax')){
			$this->loadModel('Admins.States');
			$postData = $this->request->getData();
			if(!empty($postData)){
				$id = $postData['stateId'];
				$stateDetails = $this->States->findById($id)->contain(['Countries'])->firstOrFail();
				$this->set(array('stateDetails'=>$stateDetails));
				$this->render('view_state_details');
			}
		}
	}

	public function cities(){
		$this->set('title_for_layout', 'Cities');
		$this->loadModel('Admins.States');
		$this->loadModel('Admins.Countries');
		$this->loadModel('Admins.Cities');
		$session = $this->getUser();

		$conditions = array();
		$postData = $this->request->getQuery();
		if(!empty($postData)){
			if(isset($postData['country_id']) && $postData['country_id'] !=''){
				$conditions['Cities.country_id'] = $postData['country_id'];
			}
			if(isset($postData['state_id']) && $postData['state_id'] !=''){
				$conditions['Cities.state_id'] = $postData['state_id'];
			}
			if(isset($postData['city']) && $postData['city'] !=''){
				$conditions['city like'] = '%'.$postData['city'].'%';
			}
			if(isset($postData['status']) && $postData['status'] !=''){
				$conditions['Cities.status'] = $postData['status'];
			}
		}
		$this->paginate['order'] = array('id'=>'asc');
		$this->paginate['limit'] = Configure::read('Paginate.limit');
		$this->paginate['conditions'] = $conditions;

		// Paginate the ORM table.
		$this->set('cities', $this->paginate($this->Cities->find('all')->contain(['Countries','States'])));
		$this->set('countryList',$this->getCountryList());
		$this->set('stateList',$this->getStateList());
		$this->set('setStatus', Configure::read('status'));
		$this->set('session',$session);
	}

	public function addCity($id=NULL){
		$this->set('title_for_layout', 'Add State');
		$this->loadModel('Admins.Countries');
		$this->loadModel('Admins.States');
		$this->loadModel('Admins.Cities');
		$session = $this->getUser();
		$cities = $this->Cities->newEmptyEntity();
		if(isset($id) && !empty($id)){
			$this->set('title_for_layout', 'Edit State');
			//$id = base64_decode($id);
			$cities = $this->Cities->findById($id)->firstOrFail();
			if(!isset($cities->id) && empty($cities->id)){
				$cities = $this->Cities->newEmptyEntity();
			}
		}
		if($this->request->is(['post', 'put'])){
			$city = $this->Cities->patchEntity($cities, $this->request->getData());
			if($record = $this->Cities->save($city)){
				$this->Flash->success(__('The city detail has been saved successfully.'));
				return $this->redirect(['action' => 'addCity',$record->id]);
			}
			$this->Flash->error(__('Unable to update the state.'));
		}
		$countryList = $this->getCountryList();
		$stateList = $this->getStateList();
		$this->set(compact('cities','session','countryList','stateList'));
	}

	public function viewCityDetails($id=NULL){
		$this->viewBuilder()->layout = false;
		$this->autoRender = false;
		if($this->request->is('Ajax')){
			$this->loadModel('Admins.Cities');
			$postData = $this->request->getData();
			if(!empty($postData)){
				$id = $postData['cityId'];
				$cityDetails = $this->Cities->findById($id)->contain(['Countries','States'])->firstOrFail();
				$this->set(array('cityDetails'=>$cityDetails));
				$this->render('view_city_details');
			}
		}
	}

	function getCountryList(){
		$this->loadModel('Admins.Countries');
		return $this->Countries->find('list', ['keyField'=>'id','valueField'=>'country_name', 'order'=>'ordering ASC']);
	}

	function getStateList(){
		$this->loadModel('Admins.States');
		return $this->States->find('list', ['keyField'=>'id','valueField'=>'state', 'order'=>'state ASC']);
	}
}
?>
