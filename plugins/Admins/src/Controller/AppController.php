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



use Cake\Controller\Controller;



/**

 * Application Controller

 *

 * Add your application-wide methods in the class below, your controllers

 * will inherit them.

 *

 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller

 */

 

require_once(ROOT . DS  . 'vendor' . DS  . 'BasicFunctions.php');

 

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

		

		$this->loadComponent('SendEmails');

        	

		$this->loadComponent('Flash');	

		

		$this->loadComponent('Auth',[

			'loginAction' => [

				'plugin' => 'Admins',

				'controller' => 'Users',

				'action' => 'login'

			],

			'authError' => 'Did you really think you are allowed to see that?',

			'authenticate' => [

				'Form' => [

					'finder' => 'auth',

					'userModel'=>'Admins.Users',

					'fields' => ['username' => 'email'],

				]

			],

			'storage' => 'Session'

		]);

		

        $this->Auth->allow(array('login','registration','forgotPassword'));		

		$this->set('getUser',$this->getUser());

        /*

         * Enable the following component for recommended CakePHP form protection settings.

         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html

         */

        //$this->loadComponent('FormProtection');	

		

	}

	

	public function isAuthorized($user){

		// By default deny access.

		return false;

	}

	

	function getUser(){

		return $this->Auth->user();

	}

    

	public function generateCartSessionId(){		

		$session = $this->request->getSession();

		if(!$session->check('Cart.session_id')){			

            $randId = $this->generateUniqueId();

			$session->write(['Cart.session_id' => $randId]);

            $sessionId = $session->read('Cart.session_id');

		}else{

            $sessionId = $session->read('Cart.session_id');

		}

		return $sessionId;

	}

	

	function generateUniqueId(){

		$random = mt_rand(111,999).mt_rand(22,88).mt_rand(333,777);

		return substr(str_shuffle(str_repeat($random,ceil(8/strlen($random)))),0,8);

	}

	

	public function generateUniqueIdOld($length = 8) {

        $characters = '0123456789876543210';

        $charactersLength = strlen($characters);

        $randomString = '';

        for ($i = 0;$i < $length;$i++) {

            $randomString.= $characters[rand(0, $charactersLength - 1) ];

        }

        return $randomString;

    }

	

	public function productCode($productName,$productID=NULL){

		$productCode = '';

		preg_match_all("/[0-9A-Za-z\s]/", trim($productName), $output_array);

        $slug = strtolower(preg_replace("/[\s]/", " ", join($output_array[0])));

        $productName = preg_replace("/-{2,}/", " ", $slug);		

		$exp = explode(' ',$productName);		

		foreach($exp AS $val){

			$productCode .= strtoupper(substr($val,0,1));

		}

		$productID = $this->reverse($productID);

		return $productCode.$productID;

	}

	

	public function builtSlug($input_lines){
        preg_match_all("/[0-9A-Za-z\s]/", trim($input_lines), $output_array);
        $slug = strtolower(preg_replace("/[\s]/", "-", join($output_array[0])));
        return preg_replace("/-{2,}/", "-", $slug);
    }

	function reverse($number){  

		/* writes number into string. */  

		$num = (string)$number;  

		/* Reverse the string. */  

		$revstr = strrev($num);  

		/* writes string into int. */  

		$reverse = (int)$revstr;   

		return $reverse;  

	}



    #encryptData

    public function encryptData($value = NULL){

        if(!empty($value)){

            $value = trim(preg_replace('/\s+/', ' ', $value));

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

            //date_default_timezone_set('UTC');

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

}