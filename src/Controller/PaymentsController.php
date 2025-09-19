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
// in src/Application.php
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Mailer\Mailer;







/**



 * Static content controller



 *



 * This controller will render views from templates/Pages/



 *



 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html



 */
class PaymentsController extends AppController
{
	public function checkPackage(){
		if($this->request->is('Ajax')){
			$id = base64_decode($_REQUEST['id']);
			$this->loadModel('Packages');
			$count = $this->Packages->countRecord($id);
			if($count > 0){
				$session = $this->request->getSession();

				if(!$session->check('LoginUser.id')){

					echo 'GoToSignIn'; die;

				}else{

					echo 'Success'; die;

				}

			}else{

				echo 'InvalidPackage'; die;

			}
		}
	}
	public function paymentResponse(){

		if(isset($_POST['STATUS'])){

			if($_POST['STATUS'] == 'TXN_SUCCESS'){

				$paytmOrderId = $_POST['ORDERID'];
				$explodeData = explode("-",$paytmOrderId);
				$orderID = $explodeData[2];


				$this->loadModel('Orders');
				$updateOrder['id'] = $orderID;
				$updateOrder['payment_status'] = 'Completed';
				$updateOrder['txn_id'] = $_POST['TXNID'];
				$this->Orders->createRecord($updateOrder);

				$this->loadModel('Users');
				$userData = $this->Users->singleRecord($explodeData[1]);

				$session = $this->request->getSession();
				$session->write('LoginUser.id',$userData->id);
				$session->write('LoginUser.email',$userData->email);
				$session->write('LoginUser.name',$userData->name);
				$session->write('LoginUser.contact',$userData->contact);

				$orderData = $this->Orders->singleRecord($orderID);

				

				$updateUser['id'] = $explodeData[1];
				$updateUser['subscription_status'] = 'Paid';
				$updateUser['package_id'] = $orderData->item_id;
				$updateUser['pack_start_date'] = $orderData->pack_start_date;
				$updateUser['pack_end_date'] = $orderData->pack_end_date;
				$this->Users->createRecord($updateUser);

				
				$this->loadModel('Packages');
				$this->loadModel('Products');
				if($orderData->type == 'Rental'){
					$plan = $this->Products->singleRecord($orderData->item_id);
					$planName = $plan->product_name;
				}else{
					$plan = $this->Packages->singleRecord($orderData->item_id);
					$planName = $plan->title;
				}
				
				$explodeUser = explode('@',$userData->email);
				$emailTemplateData = '';
				$username = $explodeUser[0];
				$mailer = new Mailer();
				$mailer
				->setEmailFormat('html')
				->setTo(array($userData->email,'somendra.harsh@gmail.com'))
				->setCc('info@cinemasthan.com')
				->setSubject('Cinemasthan Subscription')
				->setFrom(['info@cinemasthan.com' => 'Cinemasthan'])
				->set(compact('emailTemplateData','username','orderData','planName'))
				->viewBuilder()
				->setTemplate('subscription_invoice');
				$mailer->deliver();
				if($orderData->type == 'Rental'){

					$movieData = $this->Products->singleRecord($orderData->item_id);
					$redirectURL = SITEURL.'movie/rent-movies-24-hrs/'.$movieData->slug.'/';
					return $this->redirect($redirectURL);

				}else{

					return $this->redirect('/payment-success/');

				}

			}else{



				$paytmOrderId = $_POST['ORDERID'];
				$explodeData = explode("-",$paytmOrderId);
				$orderID = $explodeData[2];
				$this->loadModel('Orders');
				$updateOrder['id'] = $orderID;
				$updateOrder['payment_status'] = 'Failed';
				$this->Orders->createRecord($updateOrder);
				
				$this->loadModel('Users');
				$userData = $this->Users->singleRecord($explodeData[1]);
				
				$orderData = $this->Orders->singleRecord($orderID);
				$this->loadModel('Packages');
				$this->loadModel('Products');
				if($orderData->type == 'Rental'){
					$plan = $this->Products->singleRecord($orderData->item_id);
					$planName = $plan->product_name;
				}else{
					$plan = $this->Packages->singleRecord($orderData->item_id);
					$planName = $plan->title;
				}
				$explodeUser = explode('@',$userData->email);
				$emailTemplateData = '';
				$username = $explodeUser[0];
				$emailTemplateData = '';
				$mailer = new Mailer();
				$mailer
				->setEmailFormat('html')
				->setTo(array($userData->email,'somendra.harsh@gmail.com'))
				->setCc('info@cinemasthan.com')
				->setSubject('Cinemasthan Failed Payment')
				->setFrom(['info@cinemasthan.com' => 'Cinemasthan'])
				->set(compact('emailTemplateData','username','orderData','planName'))
				->viewBuilder()
				->setTemplate('failed_subscription');
				$mailer->deliver();

				return $this->redirect('/payment-failed/');



			}



		}else{



			return $this->redirect('/pricing/');



		}



	}



	public function paymentProcess($orderID){



		if($orderID != "" && is_numeric($orderID)){



			$this->sessionNotExist();



			header("Pragma: no-cache");

			header("Cache-Control: no-cache");



			header("Expires: 0");







			define('PAYTM_ENVIRONMENT', 'PROD'); // PROD

			define('PAYTM_MERCHANT_KEY', 'y@i@kkkl1cgOKZVb'); //Change this constant's value with Merchant key downloaded from portal

			define('PAYTM_MERCHANT_MID', 'LlbdkS42037660680929'); //Change this constant's value with MID (Merchant ID) received from Paytm

			define('PAYTM_MERCHANT_WEBSITE', 'DEFAULT'); //Change this constant's value with Website name received from Paytm



			$PAYTM_DOMAIN = "pguat.paytm.com";

			if (PAYTM_ENVIRONMENT == 'PROD') {

				$PAYTM_DOMAIN = 'secure.paytm.in';

			}



			define('PAYTM_REFUND_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/REFUND');

			define('PAYTM_STATUS_QUERY_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/TXNSTATUS');

			define('PAYTM_STATUS_QUERY_NEW_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/getTxnStatus');

			define('PAYTM_TXN_URL', 'https://'.$PAYTM_DOMAIN.'/oltp-web/processTransaction');



			//require_once $_SERVER['DOCUMENT_ROOT'].'/development/cinemasthan/vendor/paytm/encdec_paytm.php';

			require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/paytm/encdec_paytm.php';



			$checkSum = "";

			$paramList = array();



			$this->loadModel('Orders');

			$orderData = $this->Orders->singleRecord($orderID);



			$ORDER_ID = "ORD-".$orderData->user_id."-".$orderID;

			$CUST_ID = "CUST-".$orderData->user_id;

			$INDUSTRY_TYPE_ID = "Retail";

			$CHANNEL_ID = "WEB";

			$TXN_AMOUNT = $orderData->total;



			$paramList["MID"] = PAYTM_MERCHANT_MID;

			$paramList["ORDER_ID"] = $ORDER_ID;

			$paramList["CUST_ID"] = $CUST_ID;

			$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;

			$paramList["CHANNEL_ID"] = $CHANNEL_ID;

			$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;

			$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;

			$paramList["CALLBACK_URL"] = SITEURL."payment-response/";



			$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

			$this->set('checkSum',$checkSum);

			$this->set('paramList',$paramList);



		}else{



			return $this->redirect('/');



		}



	}

	public function createRental($movieID){



		$session = $this->request->getSession();

		if(!$session->check('LoginUser.id')){

			return $this->redirect('/sign-in/');

		}

		$movieID = base64_decode($movieID);

		if($movieID != "" && $movieID > 0){

			$this->loadModel('Products');

			$this->loadModel('Users');

			$this->loadModel('Orders');

			$movieData = $this->Products->conditionalSingleRecord(array('id' => $movieID));

			$price = $movieData->price;

			$endTime = strtotime(date("Y-m-d H:i:s", strtotime('+24 hours')));

			$userData = $this->Users->singleRecord($session->read('LoginUser.id'));

			$setData['invoice_id'] = rand(10001,99999);

			$setData['type'] = 'Rental';

			$setData['user_id'] = $userData->id;

			$setData['item_id'] = $movieID;

			$setData['price'] = $price;

			$setData['discount'] = 0;

			$setData['total'] = $price;

			$setData['pack_start_date'] = time();

			$setData['pack_end_date'] = $endTime;

			$setData['order_day'] = date('d');

			$setData['order_month'] = date('m');

			$setData['order_year'] = date('Y');

			$setData['customer_name'] = $userData->name;

			$setData['customer_email'] = $userData->email;

			$setData['customer_contact'] = $userData->contact;

			$setData['created'] = time();

			$orderID = $this->Orders->createRecord($setData);

			return $this->redirect('/payment-process/'.$orderID);



		}else{

			return $this->redirect('/');

		}

	}

	public function createOrder($package){



		$this->sessionNotExist();

		$session = $this->request->getSession();

		$package = base64_decode($package);

		if($package != "" && $package > 0){



			$this->loadModel('Packages');

			$this->loadModel('Users');

			$this->loadModel('Orders');

			$currentDate = time();

			$conditions = array('type' => 'Subscription','pack_start_date <=' => $currentDate, 'pack_end_date >= ' => $currentDate, 'payment_status' => 'Completed', 'user_id' => $session->read('LoginUser.id'));

			$count = $this->Packages->countRecord($package);

			$orderCount = $this->Orders->conditionalRecordCount($conditions);

			if($count > 0 && $orderCount == 0){



				$packData = $this->Packages->singleRecord($package);

				$userData = $this->Users->singleRecord($session->read('LoginUser.id'));

				if($packData->type == 'Monthly'){

					$endDate=strtotime(date('d-m-Y', strtotime('+30 days')));

				}else if($packData->type == 'Quarterly'){

					$endDate=strtotime(date('d-m-Y', strtotime('+90 days')));

				}else if($packData->type == 'Annual'){

					$endDate=strtotime(date('d-m-Y', strtotime('+365 days')));

				}

				$packPrice = $packData->price;

				$discountAmt = 0;

				$totalPrice = $packData->price;

				$setData['payment_status'] = 'Pending';

				if($session->check('CouponCode')){

					$checkCouponCode = $this->CheckCouponCode($session->read('CouponCode'),$packPrice);

					if($checkCouponCode['status'] == 'Success'){

						$packPrice = $packData->price;

						$discountAmt = $checkCouponCode['discount_amt'];

						$totalPrice = $checkCouponCode['final_amt'];

						if($totalPrice == 0){

							$setData['payment_status'] = 'Completed';

						}

					}

				}



				$setData['invoice_id'] = rand(10001,99999);

				$setData['user_id'] = $userData->id;

				$setData['item_id'] = $packData->id;

				$setData['price'] = $packPrice;

				$setData['discount'] = $discountAmt;

				$setData['total'] = $totalPrice;

				$setData['pack_start_date'] = time();

				$setData['pack_end_date'] = $endDate;

				$setData['order_day'] = date('d');

				$setData['order_month'] = date('m');

				$setData['order_year'] = date('Y');

				$setData['customer_name'] = $userData->name;

				$setData['customer_email'] = $userData->email;

				$setData['customer_contact'] = $userData->contact;

				$setData['created'] = time();

				$orderID = $this->Orders->createRecord($setData);

				if($totalPrice > 0){

					return $this->redirect('/payment-process/'.$orderID);

				}else{

					return $this->redirect('/payment-success/');

				}

			}else{

				return $this->redirect('/already-subscribed/');

			}

		}else{

			return $this->redirect('/');

		}

	}

	public function CheckCouponCode($couponCode,$packPrice){

		$this->loadModel('CouponCodes');

		$currentDate = time();

		$conditions = array('title' => $couponCode,'expiry_date >=' => $currentDate, 'status' => 1);

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

				$result = array('status' => 'Success','final_amt' =>$finalAmt,'discount_amt' => $discountAmt, 'msg' => $msg);

		}else{

			$result = array('status' => 'Error','final_amt' => $packPrice,'discount_amt' => 0,'msg' => 'Error! Invalid Coupon Code');

		}

		return $result;

	}

	public function paymentSuccess(){
		$this->loadModel('InnerPages');
		$this->loadModel('Categories');
		$pageData = $this->InnerPages->singleRecord(20);
		$this->set('pageData',$pageData);
	}

	public function paymentFailed(){



		$this->loadModel('InnerPages');

		$this->loadModel('Categories');

		$pageData = $this->InnerPages->singleRecord(21);

		$this->set('pageData',$pageData);



	}

	public function alreadySubscribed(){



		$this->loadModel('InnerPages');

		$this->loadModel('Categories');

		$pageData = $this->InnerPages->singleRecord(20);

		$this->set('pageData',$pageData);



	}



}

