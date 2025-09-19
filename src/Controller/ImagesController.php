<?php

declare(strict_types = 1);

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

use App\Controller\AppController;

use Cake\Core\Configure;

use Cake\Http\Exception\ForbiddenException;

use Cake\Http\Exception\NotFoundException;

use Cake\Http\Response;

use Cake\View\Exception\MissingTemplateException;

require_once (ROOT . DS . 'vendor' . DS . 'ImageResize' . DS . 'ImageResize.php');

use Eventviva\ImageResize;

use Eventviva\ImageResizeException;

/**

 * Static content controller

 *

 * This controller will render views from templates/Pages/

 *

 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html

 */

class ImagesController extends AppController {

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

    public function saveImages(){

        $this->viewBuilder()->layout = false;

        $this->autoRender = false;

        if($this->request->is('Ajax')){

            $file = $_FILES;

            $msg = [];

            if(!empty($file) && isset($_REQUEST['model']) && !empty($_REQUEST['model'])){


                if($_REQUEST['model'] == 'Users'){

                    $fileName = $file['UserProfile']['name']; //Get the image

                    $file_full = Configure::read('Data.RelativePath') . 'user/'; //Image storage path

                    $file_temp_name = $file['UserProfile']['tmp_name'];

                    $pathInfo = pathinfo(basename($fileName));

                    $ext = $pathInfo['extension'];

                    $checkImage = getimagesize($file_temp_name);

                    if($checkImage !== false){

                        $new_file_name = date('d_m_Y_H_i_' . mt_rand(11, 99) . '_a.') . $ext;

                        if(isset($_REQUEST['oldImage']) && !empty($_REQUEST['oldImage'])){

                            $old_file_name = $_REQUEST['oldImage'];
							if(file_exists($file_full . $old_file_name)){
                            	@unlink($file_full . $old_file_name);
							}

                        }

                        if(move_uploaded_file($file_temp_name, $file_full . $new_file_name)){

                            #### resize image #######

                            $image = new ImageResize($file_full . $new_file_name);

                            $image->crop(128, 128);

                            $image->save($file_full . $new_file_name);

                            ######## end ############

                            $msg['msg'] = "Success";

                            $msg['path'] = SITEURL . 'img/user/' . $new_file_name;

                            $msg['name'] = $new_file_name;

                        } else {

                            $msg['msg'] = "Error";

                        }

                    } else {

                        $msg['msg'] = "Error";

                    }

                }
				if($_REQUEST['model'] == 'Banners' || $_REQUEST['model'] == 'FooterApps'){
                    $fileName = $file['Banners']['name']; //Get the image
                    $file_full = Configure::read('Data.RelativePath') . 'banners/'; //Image storage path
                    $file_temp_name = $file['Banners']['tmp_name'];
                    $pathInfo = pathinfo(basename($fileName));
                    $ext = $pathInfo['extension'];
                    $checkImage = getimagesize($file_temp_name);
                    if($checkImage !== false){
                        $new_file_name = date('d_m_Y_H_i_' . mt_rand(11, 99) . '_a.') . $ext;
                        if(isset($_REQUEST['oldImage']) && !empty($_REQUEST['oldImage'])){
                            $old_file_name = $_REQUEST['oldImage'];
							if(file_exists($file_full . $old_file_name)){
								@unlink($file_full . $old_file_name);
							}
                        }
                        if(move_uploaded_file($file_temp_name, $file_full . $new_file_name)){
                            $msg['msg'] = "Success";
                            $msg['path'] = SITEURL . 'img/banners/' . $new_file_name;
                            $msg['name'] = $new_file_name;
                        } else {
                            $msg['msg'] = "Error";
                        }
                    } else {
                        $msg['msg'] = "Error";
                    }
                }

            }

            echo json_encode(array('data' => $msg));

        }

        exit;

    }

}

