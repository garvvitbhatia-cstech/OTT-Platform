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

use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
    }
	public function builtSlug($input_lines){
        preg_match_all("/[0-9A-Za-z\s]/", trim($input_lines), $output_array);
        $slug = strtolower(preg_replace("/[\s]/", "-", join($output_array[0])));
        return preg_replace("/-{2,}/", "-", $slug);
    }
	#encryptData
    public function encryptData($value = NULL){
        if(!empty($value)){
            $value = trim(preg_replace('/\s+/', ' ',strval($value)));
            //date_default_timezone_set('UTC');
            $encryptionMethod = "AES-256-CBC";
            $secret = "MembbyVidoeS12020PKSEncryption19";  //must be 32 char length
            $iv = substr($secret, 0, 16);
            $encryptedText = openssl_encrypt($value, $encryptionMethod, $secret,0,$iv);
            $result = "";
            if($encryptedText != ""){
                $result = trim($encryptedText);
            }
            return $result;
        }else{
            return $value;
        }
    }
    #decryptData
    public function decryptData($value = NULL){
        if(!empty($value)){
           // date_default_timezone_set('UTC');
            $encryptionMethod = "AES-256-CBC";
            $secret = "MembbyVidoeS12020PKSEncryption19";  //must be 32 char length
            $iv = substr($secret, 0, 16);
            $decryptedText = openssl_decrypt($value, $encryptionMethod, $secret,0,$iv);
            $result = "";
            if($decryptedText != ""){
                $result = trim($decryptedText);
            }
            return $result;
        }else{
            return $value;
        }
    }
	#session check
    public function sessionNotExist(){
		$session = $this->request->getSession();
		if(!$session->check('LoginUser')){
			return $this->redirect('/sign-in/');
		}
	}
	#session check
	public function sessionExist(){
		$session = $this->request->getSession();
		if($session->check('LoginUser')){
			return $this->redirect('/');
		}
	}
	public function checkUserSubscribed(){
		$showForm = 'No';
		$session = $this->request->getSession();
		$currentDate = time();
		$conditions = array('type' => 'Subscription','pack_start_date <=' => $currentDate, 'pack_end_date >= ' => $currentDate, 'payment_status' => 'Completed', 'user_id' => $session->read('LoginUser.id'));
		$orderTable = TableRegistry::get('Orders');
		$orderCount = $orderTable->find()->where($conditions)->count();
		if($orderCount > 0){
			$showForm = 'Yes';
		}
		return $showForm;
	}
}
