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

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */

class AjaxsController extends AppController

{	

	public function getPackData(){

		if($this->request->is('Ajax')){
			$this->loadModel('Packages');
			$record = $this->Packages->singleRecord($_REQUEST['id']);
			$this->set('record',$record);
		}
	}

	public function checkCouponCode(){

		if($this->request->is('Ajax')){

			$couponCode = $_REQUEST['couponCode'];

			$packageID = base64_decode($_REQUEST['pck']);

			$currentDate = time();

			$this->loadModel('CouponCodes');

			$this->loadModel('Packages');

			$packData = $this->Packages->singleRecord($packageID);

			$packPrice = $packData->price;

			$conditions = array('package' => $packageID, 'title' => $couponCode,'expiry_date >=' => $currentDate, 'status' => 1);

			$couponCodeCount = $this->CouponCodes->conditionalRecordCount($conditions);

			if($couponCodeCount > 0){

				$couponCodeData = $this->CouponCodes->conditionalSingleRecord($conditions);

				if($couponCodeData->type == 'Amount'){

					$discountAmt = $couponCodeData->value;

					$amount = round($packPrice - $couponCodeData->value);

					$finalAmt = $amount <= 0 ? 0 : $amount;

					$msg = "Success! ".$couponCodeData->value." INR OFF";

				}else{

					$amount = round(($packPrice * $couponCodeData->value)/100);

					$discountAmt = $amount;

					$finalAmt = $packPrice - $amount;

					$msg = "Success! ".$couponCodeData->value."% OFF";

				}

				$session = $this->request->getSession();

				$session->write('CouponCode',$couponCode);

				$result = array('status' => 'Success','final_amt' => number_format($finalAmt,2).' INR','discount_amt' => '-'.number_format($discountAmt,2).' INR', 'msg' => $msg);

			}else{

				$result = array('status' => 'Error','final_amt' => $packPrice.' INR','discount_amt' => '0.00 INR','msg' => '<span style="color:#f00;">Error! Invalid Coupon Code</span>');

			}

			echo json_encode($result); die;

		}

	}
	public function savePlayerTime(){
		if($this->request->is('Ajax')){
			$session = $this->request->getSession();
			$type = $_REQUEST['type'] == 'trailer' ? 2 : 1;
			$this->loadModel('ProductViews');
			$record = $this->ProductViews->conditionalSingleRecord(array('type' => $type, 'product_id' => $_REQUEST['moview_id'], 'user_id' => $session->read('LoginUser.id')));
			$movieView['id'] = $record->id;
			$movieView['duration'] = $_REQUEST['currentTime'];
			$this->ProductViews->createRecord($movieView);
			echo 'Success'; die;
		}
	}
	public function setWishlist(){

		if($this->request->is('Ajax')){

			$this->loadModel('Wishlists');

			$session = $this->request->getSession();

			$wishStatus = 1;

			if($_REQUEST['wishlistData'] == 1){

				$wishStatus = 2;

			}

			$productId = $_REQUEST['productId'];

			$useId = $session->read('LoginUser.id');

			$conditions2 = array('user_id' => $useId, 'product_id' => $productId);

			$wishDataCount = $this->Wishlists->conditionalRecordCount($conditions2);

			if($wishDataCount > 0){

				$wishData = $this->Wishlists->conditionalSingleRecord($conditions2);

				$setData['id'] = $wishData->id;

			}

			$setData['user_id'] = $useId;

			$setData['product_id'] = $productId;

			$setData['wishlist'] = $wishStatus;

			$record = $this->Wishlists->createRecord($setData);

		}

		echo 'Success'; die;

	}
	public function testNewsletterEmail(){
		if(isset($_REQUEST['email']) && $_REQUEST['email'] != ""){
			if(filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
				$email = $_REQUEST['email'];
				$type = $_REQUEST['type'];
				$videoID = $_REQUEST['videoID'];
				$rowID = $_REQUEST['rowID'];
				
				$this->loadModel('Settings');
				$this->loadModel('NewsletterEmails');
				$setting = $this->Settings->singleRecord(1);
				$newsletterData = $this->NewsletterEmails->singleRecord($rowID);
				
				
				$this->loadModel('InnerPages');
				$this->loadModel('Products');
				$this->loadModel('Categories');
				$homePageData = $this->InnerPages->singleRecord(6);
				$cateArray = array();
				if($homePageData->category_id != ""){
					$cateArray = explode(',',$homePageData->category_id);
				}
				$movieDetails = $this->Products->singleRecord($newsletterData->product_id);
				$cateIDExplode = explode(',',$movieDetails->category_id);
				$categoryDetails = $this->Categories->singleRecord($cateIDExplode[0]);
				$conditions = array('status' => 1);
				$categories = $this->Categories->conditionalRecords($conditions);
				
				$explodeEmail = explode('@',$email);
				$username = '';
				if(isset($explodeEmail[0]) && $explodeEmail[0] != ''){
					$username = $explodeEmail[0];
				}
				
				if($newsletterData->top_banner_type == 'LMB'){
					if($newsletterData->home_elements == 1){
						$subject = 'Hello '.$username.', '.$movieDetails->product_name.', recently added on Cinemasthan';
					}else{
						$subject = 'Hello '.$username.', "'.$movieDetails->product_name.'" is now Available for you';
					}
				}else{
					if($newsletterData->home_elements == 1){
						$subject = 'Hello '.$username.', recently added on Cinemasthan';
					}else{
						$subject = 'Hello '.$username.', '.$newsletterData->title;
					}
				}
				
				$mailer = new Mailer();
				$mailer
				->setEmailFormat('html')
				->setTo($email)
				->setCc('info@cinemasthan.com')
				->setSubject($subject)
				->setFrom(['info@cinemasthan.com' => 'Cinemasthan'])
				->set(compact('setting','newsletterData','movieDetails','categoryDetails','homePageData','cateArray','categories','email','username'))
				->viewBuilder()
				->setTemplate('newsletter');
				$mailer->deliver();
		
				echo 'Email Send Successfully'; die;
				
			}else{
				echo 'Invalid Email Address'; die;
			}
		}else{
			echo 'Error'; die;
		}
	}
	public function saveHelpCenter(){

		if(isset($_REQUEST['email']) && isset($_REQUEST['mobile']) && isset($_REQUEST['name']) && $_REQUEST['email'] != "" && $_REQUEST['mobile'] != "" && $_REQUEST['name'] != ""){

			if(filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {

				$this->loadModel('HelpCenters');
				$session = $this->request->getSession();
				
				if($session->check('LoginUser.id') && $session->read('LoginUser.name') != ""){
					$setData['name'] = $session->read('LoginUser.name');
				}else{
					$setData['name'] = $_REQUEST['name']; 
				}
				if($session->check('LoginUser.id') && $session->read('LoginUser.email') != ""){
					$setData['email'] = $session->read('LoginUser.email');
				}else{
					$setData['email'] = $_REQUEST['email']; 
				}
				if($session->check('LoginUser.id') && $session->read('LoginUser.contact') != ""){
					$setData['mobile'] = $session->read('LoginUser.contact');
				}else{
					$setData['mobile'] = $_REQUEST['mobile']; 
				}
				if($session->check('LoginUser.id')){
					$setData['status'] = 1;
				}else{
					$setData['status'] = 2;
				}
				$setData['subject'] = $_REQUEST['what_can_help']; 
				$setData['description'] = $_REQUEST['description'];
				$setData['created'] = time();
				$record = $this->HelpCenters->createRecord($setData);
				
				$emailTemplateData = '';
				$username = $setData['name'];
				
				$email = $setData['email'];
				$contact = $setData['mobile'];
				$subject = $setData['subject'];
				$message = $setData['description'];

				$mailer = new Mailer();

				$mailer
				->setEmailFormat('html')
				->setTo(array($setData['email'],'somendra.harsh@gmail.com'))
				->setCc('info@cinemasthan.com')
				->setSubject('Cinemasthan Help Center')
				->setFrom(['info@cinemasthan.com' => 'Cinemasthan'])
				->set(compact('emailTemplateData','username','email','contact','subject','message'))
				->viewBuilder()
				->setTemplate('help_center');
				$mailer->deliver();
						
				$this->Flash->set('Email send successfully',array('element' => 'success'));
				return $this->redirect('/help-center/');

			}else{
				$this->Flash->set('Email address is invalid',array('element' => 'error'));
				return $this->redirect('/help-center/');
			}

		}else{

			$this->Flash->set('Internal server error',array('element' => 'error'));

			return $this->redirect('/help-center/');

		}

	}
	public function loginWithFacebook(){ 

		if(isset($_REQUEST['email']) && $_REQUEST['email'] != ""){
			$this->loadModel('Users');
			$emailExist = $this->Users->conditionalRecordCount(array('email' => $_REQUEST['email']));
			if($emailExist == 0){
				$password = rand(10001,99999);
				$explodeEmail = explode('@',$_REQUEST['email']);
				$setData['type'] = 'User'; 
				$setData['username'] = $explodeEmail[0]; 
				$setData['email'] = $_REQUEST['email']; 
				$setData['contact'] = '';
				$setData['password'] = $this->encryptData($password); 
				$setData['last_login'] = time();
				$setData['created'] = time();
				$record = $this->Users->createRecord($setData);
				
				#save newsletter
				$this->loadModel('Newsletters');
				$newsEmailExist = $this->Newsletters->conditionalRecordCount(array('email' => $_REQUEST['email']));
				if($newsEmailExist == 0){
					$setNewsData['email'] = strtolower($_REQUEST['email']);
					$record2 = $this->Newsletters->createRecord($setNewsData);
				}
				
				$session = $this->request->getSession();
				
				$session->write('LoginUser.id',$record);
				$session->write('LoginUser.email',$_REQUEST['email']);
				$session->write('LoginUser.contact','');
				
				$this->loadModel('HelpCenters');
				$helpCenterEmails = $this->HelpCenters->conditionalRecordFetch(array('email' => $_REQUEST['email']));
				foreach($helpCenterEmails as $key => $helpCenterEmail){
					$setHelp['id'] = $helpCenterEmail->id;
					$setHelp['status'] = 1;
					$this->HelpCenters->createRecord($setHelp);
				}
				
				$username = $explodeEmail[0];
				$emailSubject = 'Cinemasthan Registration';
				$emailTemplateData = '';
				$emailAddress = $_REQUEST['email'];
				$phone = 'Not Available';
				$mailer = new Mailer();
				$mailer
				->setEmailFormat('html')
				->setTo(array($_REQUEST['email'],'somendra.harsh@gmail.com'))
				->setSubject($emailSubject)
				->setCc('info@cinemasthan.com')
				->setFrom(['info@cinemasthan.com' => 'Cinemasthan'])
				->set(compact('emailTemplateData','username','emailAddress','phone','password'))
				->viewBuilder()
				->setTemplate('user_register');
				$mailer->deliver();
				if($_REQUEST['type'] == 'facebook'){
					echo 'Success'; die;
				}else{
					return $this->redirect('/');
				}
			}else{
				$userData = $this->Users->conditionalSingleRecord(array('email' => $_REQUEST['email']));
				if($userData->status == 1){

					$session = $this->request->getSession();
					$session->write('LoginUser.id',$userData->id);
					$session->write('LoginUser.email',$userData->email);
					$session->write('LoginUser.name',$userData->name);
					$session->write('LoginUser.contact',$userData->contact);
					
					if($_REQUEST['type'] == 'facebook'){
						echo 'Success'; die;
					}else{
						return $this->redirect('/');
					}
				
				}else{
					if($_REQUEST['type'] == 'facebook'){
					echo 'Inactive'; die;
					}else{
						return $this->redirect('/');
					}
				
				}
			}
		}else{
			if($_REQUEST['type'] == 'facebook'){
			echo 'Error'; die;
			}else{
				return $this->redirect('/');
			}
		}
	}
	public function userRegister(){

		if(isset($_REQUEST['email_address']) && isset($_REQUEST['phone']) && isset($_REQUEST['password']) && $_REQUEST['email_address'] != "" && $_REQUEST['phone'] != "" && $_REQUEST['password'] != ""){

			if(filter_var($_REQUEST['email_address'], FILTER_VALIDATE_EMAIL)) {

				$this->loadModel('Users');

				$emailExist = $this->Users->conditionalRecordCount(array('email' => $_REQUEST['email_address']));

				if($emailExist == 0){

					$explodeEmail = explode('@',$_REQUEST['email_address']);

					$setData['type'] = 'User'; 
					$setData['username'] = $explodeEmail[0]; 
					$setData['name'] = $_REQUEST['name']; 
					$setData['email'] = $_REQUEST['email_address']; 
					$setData['contact'] = $_REQUEST['phone']; 
					$setData['password'] = $this->encryptData($_REQUEST['password']); 
					if(isset($_REQUEST['is_film_maker'])){
						$setData['is_film_maker'] = 1;
					}
					$setData['last_login'] = time();
					$setData['created'] = time();

					$record = $this->Users->createRecord($setData);
					
					#save newsletter
					$this->loadModel('Newsletters');
					$newsEmailExist = $this->Newsletters->conditionalRecordCount(array('email' => $_REQUEST['email_address']));
					if($newsEmailExist == 0){
						$setNewsData['email'] = strtolower($_REQUEST['email_address']);
						$record2 = $this->Newsletters->createRecord($setNewsData);
					}

					if($record > 0){

						$session = $this->request->getSession();

						$session->write('LoginUser.id',$record);
						$session->write('LoginUser.email',$_REQUEST['email_address']);
						$session->write('LoginUser.contact',$_REQUEST['phone']);
						
						$this->loadModel('HelpCenters');
						$helpCenterEmails = $this->HelpCenters->conditionalRecordFetch(array('email' => $_REQUEST['email_address']));
						foreach($helpCenterEmails as $key => $helpCenterEmail){
							$setHelp['id'] = $helpCenterEmail->id;
							$setHelp['status'] = 1;
							$this->HelpCenters->createRecord($setHelp);
						}

						$username = $explodeEmail[0];
						$emailSubject = 'Cinemasthan Registration';
						$emailTemplateData = '';
						$emailAddress = $_REQUEST['email_address'];
						$phone = $_REQUEST['phone']; 
						$password = $_REQUEST['password'];
						$mailer = new Mailer();
						$mailer
						->setEmailFormat('html')
						->setTo(array($_REQUEST['email_address'],'somendra.harsh@gmail.com'))
						->setSubject($emailSubject)
						->setCc('info@cinemasthan.com')
						->setFrom(['info@cinemasthan.com' => 'Cinemasthan'])
						->set(compact('emailTemplateData','username','emailAddress','phone','password'))
						->viewBuilder()
						->setTemplate('user_register');
						$mailer->deliver();

						

					}

					return $this->redirect('/');

				}else{

					$this->Flash->set('Email address already exist',array('element' => 'error'));

					return $this->redirect('/sign-up/');

				}

			}else{

				$this->Flash->set('Email address is invalid',array('element' => 'error'));

				return $this->redirect('/sign-up/');

			}

		}else{

			$this->Flash->set('Internal server error',array('element' => 'error'));

			return $this->redirect('/sign-up/');

		}

	}

	public function userLogin(){

		if(isset($_REQUEST['email_address']) && isset($_REQUEST['password']) && $_REQUEST['email_address'] != "" && $_REQUEST['password'] != ""){

			if(filter_var($_REQUEST['email_address'], FILTER_VALIDATE_EMAIL)) {

				$email = $_REQUEST['email_address'];

				$password = $this->encryptData($_REQUEST['password']);

				$this->loadModel('Users');

				$conditions = array('email' => $email, 'password' => $password, 'type' => 'User');

				$userExist = $this->Users->conditionalRecordCount($conditions);

				if($userExist > 0){

					$userData = $this->Users->conditionalSingleRecord($conditions);

					if($userData->status == 1){
						
						#save newsletter
						$this->loadModel('Newsletters');
						$newsEmailExist = $this->Newsletters->conditionalRecordCount(array('email' => $email));
						if($newsEmailExist == 0){
							$setNewsData['email'] = strtolower($email);
							$record2 = $this->Newsletters->createRecord($setNewsData);
						}

						$session = $this->request->getSession();

						$session->write('LoginUser.id',$userData->id);
						$session->write('LoginUser.email',$userData->email);
						$session->write('LoginUser.name',$userData->name);
						$session->write('LoginUser.contact',$userData->contact);

						return $this->redirect('/');

					}else{

						$this->Flash->set('Your account is inactive',array('element' => 'error'));

						return $this->redirect('/sign-in/');

					}

				}else{

					$this->Flash->set('Username and password are incorrect',array('element' => 'error'));

					return $this->redirect('/sign-in/');

				}

			}else{

				$this->Flash->set('Email address is invalid',array('element' => 'error'));

				return $this->redirect('/sign-in/');

			}

		}else{

			$this->Flash->set('Internal server error',array('element' => 'error'));

			return $this->redirect('/sign-in/');

		}

	}

	public function logout(){

		$session = $this->request->getSession();

		$session->delete('LoginUser');

		//$this->Flash->set('Logout successfully',array('element' => 'success'));

		return $this->redirect('/');

	}
	public function saveNewsletter(){
		if(isset($_REQUEST['newsEmail']) && $_REQUEST['newsEmail'] != ""){
			if(filter_var($_REQUEST['newsEmail'], FILTER_VALIDATE_EMAIL)) {
				#save newsletter
				$this->loadModel('Newsletters');
				$newsEmailExist = $this->Newsletters->conditionalRecordCount(array('email' => $_REQUEST['newsEmail']));
				if($newsEmailExist == 0){
					$setNewsData['email'] = strtolower($_REQUEST['newsEmail']);
					$record2 = $this->Newsletters->createRecord($setNewsData);
					#send email
					$email = $_REQUEST['newsEmail'];
					$subject = 'Welcome in Cinemasthan';
					$explodeEmail = explode('@',$email);
					$username = '';
					if(isset($explodeEmail[0]) && $explodeEmail[0] != ''){
						$username = $explodeEmail[0];
					}
					$this->loadModel('Settings');
					$setting = $this->Settings->singleRecord(1);
					
					$mailer = new Mailer();
					$mailer
					->setEmailFormat('html')
					->setTo($email)
					->setCc('info@cinemasthan.com')
					->setSubject($subject)
					->setFrom(['info@cinemasthan.com' => 'Cinemasthan'])
					->set(compact('email','setting','username'))
					->viewBuilder()
					->setTemplate('newsletter_signup');
					$mailer->deliver();
					echo 'Success'; die;
				}else{
					echo 'Already'; die;
				}
			}else{
				echo 'Error1'; die;
			}
		}else{
			echo 'Error'; die;
		}
	}

	public function forgotPassword(){

		if(isset($_REQUEST['email_address']) && $_REQUEST['email_address'] != ""){

			if(filter_var($_REQUEST['email_address'], FILTER_VALIDATE_EMAIL)) {

				$email = $_REQUEST['email_address'];

				$this->loadModel('Users');

				$conditions = array('email' => $email,'type' => 'User');

				$userExist = $this->Users->conditionalRecordCount($conditions);

				if($userExist > 0){

					$userData = $this->Users->conditionalSingleRecord($conditions);

					$explodeEmail = explode('@',$_REQUEST['email_address']);

					$emailAddress = $_REQUEST['email_address'];

					$password = $this->decryptData($userData->password);

					$username = $explodeEmail[0];

					$emailSubject = 'Cinemasthan Forgot Password';

					$emailTemplateData = '';

					$mailer = new Mailer();

					$mailer
					->setEmailFormat('html')
					->setTo(array($_REQUEST['email_address'],'somendra.harsh@gmail.com'))
					->setSubject($emailSubject)
					->setCc('info@cinemasthan.com')
					->setFrom(['info@cinemasthan.com' => 'Cinemasthan'])
					->set(compact('emailTemplateData','username','password','emailAddress'))
					->viewBuilder()
					->setTemplate('user_forgot_password');
					$mailer->deliver();

					

					$this->Flash->set('Email send successfully',array('element' => 'success'));

					return $this->redirect('/forgot-password/');

				}else{

					$this->Flash->set('Email address is not registered',array('element' => 'error'));

					return $this->redirect('/forgot-password/');

				}

			}else{

				$this->Flash->set('Email address is invalid',array('element' => 'error'));

				return $this->redirect('/forgot-password/');

			}

		}else{

			$this->Flash->set('Internal server error',array('element' => 'error'));

			return $this->redirect('/forgot-password/');

		}

	}

}

