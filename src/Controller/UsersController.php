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

namespace App\Controller;



use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;


/**

 * Static content controller

 *

 * This controller will render views from templates/Pages/

 *

 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html

 */

class UsersController extends AppController

{

	public function signin(){
		$session = $this->request->getSession();
		if($session->check('LoginUser')){
			return $this->redirect('/');
		}
		$this->viewBuilder()->setLayout('signin');
		$this->loadModel('InnerPages');
		$pageData = $this->InnerPages->singleRecord(7);
		$this->set('pageData',$pageData);

	}

	public function signup(){
		$session = $this->request->getSession();
		if($session->check('LoginUser')){
			return $this->redirect('/');
		}
		$this->viewBuilder()->setLayout('signin');
		$this->loadModel('InnerPages');
		$pageData = $this->InnerPages->singleRecord(8);
		$this->set('pageData',$pageData);
	}

	public function forgotPassword(){
		$session = $this->request->getSession();
		if($session->check('LoginUser')){
			return $this->redirect('/');
		}
		$this->viewBuilder()->setLayout('signin');
		$this->loadModel('InnerPages');
		$pageData = $this->InnerPages->singleRecord(9);
		$this->set('pageData',$pageData);
	}

	public function pricing(){
		$this->viewBuilder()->setLayout('pricing');
		$this->loadModel('InnerPages');
		$pageData = $this->InnerPages->singleRecord(10);
		$this->set('pageData',$pageData);
		$session = $this->request->getSession();
		if($session->check('CouponCode')){
			$session->delete('CouponCode');
		}
	}

	public function myAccount(){

		$session = $this->request->getSession();
		if(!$session->check('LoginUser')){
			return $this->redirect('/sign-in/');
		}
		$this->viewBuilder()->setLayout('pricing');
		$this->loadModel('InnerPages');
		$this->loadModel('Users');
		$pageData = $this->InnerPages->singleRecord(18);
		$session = $this->request->getSession();
		$userData = $this->Users->singleRecord($session->read('LoginUser.id'));
		$this->set('userData',$userData);
		$this->set('pageData',$pageData);

	}
	public function viewFilmDetails($vID){

		$session = $this->request->getSession();
		if(!$session->check('LoginUser')){
			return $this->redirect('/sign-in/');
		}
		$this->viewBuilder()->setLayout('pricing');
		$vID = base64_decode($vID);
		
		
		$session = $this->request->getSession();
		if($this->request->is('post')){
			
		}
		
		$productTable = TableRegistry::get('Products');
		$filmData = $productTable->find()->where(array('id' => $vID))->first();
		$this->set('filmData',$filmData);

		
		$this->loadModel('Users');		
		$userData = $this->Users->singleRecord($session->read('LoginUser.id'));
		$this->set('userData',$userData);
		
		$this->loadModel('InnerPages');
		$pageData = $this->InnerPages->singleRecord(19);
		$this->set('pageData',$pageData);
		
		$Table = TableRegistry::get('ProductViews');
		$records = $Table->find()->where(array('type' => 1, 'product_id' => $vID))->all();
		$b = 0;
		foreach($records as $key => $record){
			$b = $b+$record->duration;
		}
		$totalTime = $this->setTimeFormating($b);
		
		$this->set('video_duration',$totalTime);
		$this->set('video_views',$records->count());
		
		
		$records2 = $Table->find()->where(array('type' => 2, 'product_id' => $vID))->all();
		$c = 0;
		foreach($records2 as $key => $record2){
			$c = $c+$record2->duration;
		}
		$totalTime2 = $this->setTimeFormating($c);
		
		$this->set('trailer_duration',$totalTime2);
		$this->set('trailer_views',$records2->count());
		
		$cateTable = TableRegistry::get('Categories');
		$selectedIDs = explode(",",$filmData->category_id);
		$cateName = '';
		foreach($selectedIDs as $key => $cateID){
			$cateData = $cateTable->find()->where(array('id' => $cateID))->first();
			if(isset($cateData->name)){
				if($cateName == ''){
					$cateName = $cateData->name;
				}else{
					$cateName = $cateName.', '.$cateData->name;
				}
			}
		}
		$this->set('cateName',$cateName);
		
		$showForm = $this->checkUserSubscribed();
		$this->set('showForm',$showForm);
		

	}
	public function setTimeFormating($seconds){
		//$seconds = 8525;
		$H = floor($seconds / 3600);
		$i = ($seconds / 60) % 60;
		$s = $seconds % 60;
		return sprintf("%02d:%02d:%02d", $H, $i, $s);
	}
	public function myFilms(){

		$session = $this->request->getSession();
		if(!$session->check('LoginUser')){
			return $this->redirect('/sign-in/');
		}
		$this->viewBuilder()->setLayout('pricing');
		$this->loadModel('InnerPages');
		$this->loadModel('Users');
		$session = $this->request->getSession();
		if($this->request->is('post')){
			
		}
		
		$productTable = TableRegistry::get('Products');
		$films = $productTable->find('all')->where(array('added_by' => $session->read('LoginUser.id')))->order(array('id' => 'DESC'));
		$this->set('films',$films);

		$pageData = $this->InnerPages->singleRecord(19);
		$userData = $this->Users->singleRecord($session->read('LoginUser.id'));
		$this->set('userData',$userData);
		$this->set('pageData',$pageData);
		
		$showForm = $this->checkUserSubscribed();
		$this->set('showForm',$showForm);

	}
	public function editFilmDetails($vID){

		$session = $this->request->getSession();
		if(!$session->check('LoginUser')){
			return $this->redirect('/sign-in/');
		}
		$vID = base64_decode($vID);
		
		$this->viewBuilder()->setLayout('pricing');
		$this->loadModel('InnerPages');
		$this->loadModel('Users');
		$session = $this->request->getSession();
		if($this->request->is('post')){
			$postData = $this->request->getData();
			
			$generes = '';
			if(isset($postData['genres']) && is_array($postData['genres'])){				
				$generes = implode(",", $postData['genres']);			
			}
			$categoryIds = '';			
			if(isset($postData['category_id']) && is_array($postData['category_id'])){
				$categoryIds = implode(",", $postData['category_id']);		
			}
			$session = $this->request->getSession();
			$products['added_by'] = $session->read('LoginUser.id');
            $products['id'] = $postData['id'];
            $products['video'] = $postData['video'];
			$products['product_name'] = $postData['product_name'];
			$products['director'] = $postData['director'];
			$products['producer'] = $postData['producer'];
			$products['production_year'] = $postData['production_year'];
			$products['language'] = $postData['language'];
			$products['censor_category'] = $postData['censor_category'];
			$products['description'] = $postData['description'];
			$products['trailer_video'] = $postData['trailer_video'];
			$products['keywords'] = $postData['keywords'];
			$products['trailer_video_password'] = $postData['trailer_video_password'];
			$products['video_password'] = $postData['video_password'];
			$products['vertical_banner'] = $postData['vertical_banner'];
			$products['horizontal_banner'] = $postData['horizontal_banner'];
			$products['big_banner'] = $postData['banner'];
            $products['category_id'] = $categoryIds;
			$products['genres'] = $generes;
            $products['slug'] = $this->builtSlug($postData['product_name']);
			$products['big_banner_status'] = 0;
			$products['price'] = 0;
			if(isset($id) && !empty($id)){
				$products['modified'] = time();
			}else{
				$products['created'] = time();
				$products['modified'] = time();

			}
			if(isset($postData['language']) && !empty($postData['language'])){
				$this->loadModel('Languages');
				$languageCount = $this->Languages->conditionalRecordCount(array('title' => $postData['language']));
				if($languageCount == 0){
					$saveLang['title'] = ucwords($postData['language']);
					$this->Languages->createRecord($saveLang);
				}
			}
			$this->loadModel('Products');
			if($record = $this->Products->createRecord($products)){
				$this->Flash->set('Film request post successfully.',array('element' => 'success'));
				return $this->redirect('/my-films/');
			}
		}
		
		$categoryTable = TableRegistry::get('Categories');
		$categoryList = $categoryTable->find('all')->where(array('status' => 1))->order(array('ordering' => 'ASC'));
		$this->set('categoryList',$categoryList);
		
		$genresTable = TableRegistry::get('Genres');
		$genresTableList = $genresTable->find('all')->where(array('status' => 1))->order(array('title' => 'ASC'));
		$this->set('genresTableList',$genresTableList);
		
		$this->set('censorCategories', Configure::read('CensorCategories'));

		$pageData = $this->InnerPages->singleRecord(19);
		$userData = $this->Users->singleRecord($session->read('LoginUser.id'));
		$this->set('userData',$userData);
		$this->set('pageData',$pageData);
		
		$productTable = TableRegistry::get('Products');
		$filmData = $productTable->find()->where(array('id' => $vID))->first();
		$this->set('filmData',$filmData);

	}
	public function submitYourFilm(){

		$session = $this->request->getSession();
		if(!$session->check('LoginUser')){
			return $this->redirect('/sign-in/');
		}
		$this->viewBuilder()->setLayout('pricing');
		$this->loadModel('InnerPages');
		$this->loadModel('Users');
		$session = $this->request->getSession();
		if($this->request->is('post')){
			$postData = $this->request->getData();
			$generes = '';
			if(isset($postData['genres']) && is_array($postData['genres'])){				
				$generes = implode(",", $postData['genres']);			
			}
			$categoryIds = '';			
			if(isset($postData['category_id']) && is_array($postData['category_id'])){
				$categoryIds = implode(",", $postData['category_id']);		
			}
			$session = $this->request->getSession();
			$products['added_by'] = $session->read('LoginUser.id');
            $products['discount'] = 0;
			$products['hours'] = 0;
			$products['minutes'] = 0;
			$products['status'] = 2;
            $products['video'] = $postData['video'];
			$products['product_name'] = $postData['product_name'];
			$products['director'] = $postData['director'];
			$products['producer'] = $postData['producer'];
			$products['production_year'] = $postData['production_year'];
			$products['language'] = $postData['language'];
			$products['censor_category'] = $postData['censor_category'];
			$products['description'] = $postData['description'];
			$products['trailer_video'] = $postData['trailer_video'];
			$products['keywords'] = $postData['keywords'];
			$products['trailer_video_password'] = $postData['trailer_video_password'];
			$products['video_password'] = $postData['video_password'];
			$products['vertical_banner'] = $postData['vertical_banner'];
			$products['horizontal_banner'] = $postData['horizontal_banner'];
			$products['big_banner'] = $postData['banner'];
            $products['category_id'] = $categoryIds;
			$products['genres'] = $generes;
            $products['slug'] = $this->builtSlug($postData['product_name']);
			$products['big_banner_status'] = 0;
			$products['price'] = 0;
			if(isset($id) && !empty($id)){
				$products['modified'] = time();
			}else{
				$products['created'] = time();
				$products['modified'] = time();

			}
			if(isset($postData['language']) && !empty($postData['language'])){
				$this->loadModel('Languages');
				$languageCount = $this->Languages->conditionalRecordCount(array('title' => $postData['language']));
				if($languageCount == 0){
					$saveLang['title'] = ucwords($postData['language']);
					$this->Languages->createRecord($saveLang);
				}
			}
			$this->loadModel('Products');
			if($record = $this->Products->createRecord($products)){
				$this->Flash->set('Film request post successfully.',array('element' => 'success'));
				return $this->redirect('/my-films/');
			}
		}
		
		$categoryTable = TableRegistry::get('Categories');
		$categoryList = $categoryTable->find('all')->where(array('status' => 1))->order(array('ordering' => 'ASC'));
		$this->set('categoryList',$categoryList);
		
		$genresTable = TableRegistry::get('Genres');
		$genresTableList = $genresTable->find('all')->where(array('status' => 1))->order(array('title' => 'ASC'));
		$this->set('genresTableList',$genresTableList);
		
		$this->set('censorCategories', Configure::read('CensorCategories'));

		$pageData = $this->InnerPages->singleRecord(19);
		$userData = $this->Users->singleRecord($session->read('LoginUser.id'));
		$this->set('userData',$userData);
		$this->set('pageData',$pageData);
		
		$showForm = $this->checkUserSubscribed();
		$this->set('showForm',$showForm);

	}
	
	public function editProfile(){

		$session = $this->request->getSession();
		if(!$session->check('LoginUser')){
			return $this->redirect('/sign-in/');
		}
		$this->viewBuilder()->setLayout('pricing');
		$this->loadModel('InnerPages');
		$this->loadModel('Users');
		$session = $this->request->getSession();
		if($this->request->is('post')){

			$postData = $this->request->getData();
			//print_r($postData); die;
			$setData['id'] = $session->read('LoginUser.id');
			$setData['name'] = $postData['name'];
			$setData['contact'] = $postData['contact'];
			$setData['city'] = $postData['city'];
			$setData['is_film_maker'] = 0;
			if(isset($postData['is_film_maker'])){
				$setData['is_film_maker'] = 1;
			}
			if($postData['profile'] != ""){
				$setData['profile'] = $postData['profile'];
			}
			$record = $this->Users->createRecord($setData);
			
			$session->write('LoginUser.name',$postData['name']);
			$emailAddress = $session->read('LoginUser.email');
			
			$username = $postData['name'];
			$city = $postData['city'];
			$phone = $postData['contact'];
			$profile = $postData['current_profile'];
			$emailTemplateData = '';
			$mailer = new Mailer();
				$mailer
				->setEmailFormat('html')
				->setTo($session->read('LoginUser.email'))
				->setCc('info@cinemasthan.com')
				->setSubject('Cinemasthan Update Profile')
				->setFrom(['info@cinemasthan.com' => 'Cinemasthan'])
				->set(compact('emailTemplateData','username','emailAddress','city','phone','profile'))
				->viewBuilder()
				->setTemplate('update_profile');
				$mailer->deliver();
			
			$this->Flash->set('Profile updated successfully.',array('element' => 'success'));
			return $this->redirect('/edit-profile/');

		}

		$pageData = $this->InnerPages->singleRecord(19);
		$userData = $this->Users->singleRecord($session->read('LoginUser.id'));
		$this->set('userData',$userData);
		$this->set('pageData',$pageData);

	}

	public function changePassword(){

		$session = $this->request->getSession();
		if(!$session->check('LoginUser')){
			return $this->redirect('/sign-in/');
		}
		$this->viewBuilder()->setLayout('pricing');
		$this->loadModel('InnerPages');
		$this->loadModel('Users');
		$session = $this->request->getSession();

		if($this->request->is('post')){
			$postData = $this->request->getData();
			if($postData['new_password'] == $postData['confirm_pass']){
				$setData['id'] = $session->read('LoginUser.id');
				$setData['password'] = $this->encryptData($postData['new_password']);
				$record = $this->Users->createRecord($setData);
				
				$username = $session->read('LoginUser.name');
				$emailTemplateData = '';
				$mailer = new Mailer();
					$mailer
					->setEmailFormat('html')
					->setTo($session->read('LoginUser.email'))
					->setCc('info@cinemasthan.com')
					->setSubject('Cinemasthan Update Password')
					->setFrom(['info@cinemasthan.com' => 'Cinemasthan'])
					->set(compact('emailTemplateData','username'))
					->viewBuilder()
					->setTemplate('cinema_update_pass');
					$mailer->deliver();
				
				$this->Flash->set('Password changed successfully.',array('element' => 'success'));
				return $this->redirect('/my-account/');

			}else{

				$this->Flash->set('Confirm password do not match',array('element' => 'error'));

				return $this->redirect('/change-password/');

			}

		}



		$pageData = $this->InnerPages->singleRecord(19);

		$userData = $this->Users->singleRecord($session->read('LoginUser.id'));

		$this->set('userData',$userData);

		$this->set('pageData',$pageData);

	}

	public function myWatchList(){

		$session = $this->request->getSession();
		if(!$session->check('LoginUser')){
			return $this->redirect('/sign-in/');
		}
		$this->loadModel('InnerPages');
		$pageData = $this->InnerPages->singleRecord(22);
		$this->set('pageData',$pageData);
		$this->loadModel('ProductViews');
		$session = $this->request->getSession();
		$userID = $session->read('LoginUser.id');
		$conditions = array('user_id' => $userID);
		$records = $this->ProductViews->conditionalRecords($conditions);
		$this->set('records',$records);
		$this->loadModel('Products');
		$remainingMovies = $this->Products->fetchRandomRecords(array('status' => 1),40);
		$this->set('remainingMovies',$remainingMovies);

	}
	public function myWishlist(){

		$session = $this->request->getSession();
		if(!$session->check('LoginUser')){
			return $this->redirect('/sign-in/');
		}
		$this->loadModel('InnerPages');
		$pageData = $this->InnerPages->singleRecord(22);
		$this->set('pageData',$pageData);
		$this->loadModel('Wishlists');
		$session = $this->request->getSession();
		$userID = $session->read('LoginUser.id');
		$conditions = array('user_id' => $userID,'wishlist' => 1);
		$records = $this->Wishlists->conditionalRecords($conditions);
		$this->set('records',$records);
		$this->loadModel('Products');
		$remainingMovies = $this->Products->fetchRandomRecords(array('status' => 1),40);
		$this->set('remainingMovies',$remainingMovies);

	}

}

