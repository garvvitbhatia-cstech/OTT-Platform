<?php

namespace Admins\Controller;

use Admins\Controller\AppController;

use Cake\Core\Configure;

use Cake\Network\Exception\ForbiddenException;

use Cake\Network\Exception\NotFoundException;

use Cake\View\Exception\MissingTemplateException;

use Cake\ORM\TableRegistry;

use Cake\Http\Response;

use Cake\Core\Exception\Exception;

require_once (ROOT.DS.'vendor'.DS.'ImageResize'.DS.'ImageResize.php');

use Eventviva\ImageResize;

use Eventviva\ImageResizeException;
use Cake\Mailer\Mailer;



class EcommerceController extends AppController {

	

	#categories page

    public function generes(){

        $this->set('title_for_layout', 'Genres');

        $this->loadModel('Admins.Genres');

        $conditions = array();

        $postData = $this->request->getQuery();

        if(!empty($postData)){

            if(isset($postData['title']) && $postData['title'] != ''){

                $conditions['title like'] = '%'.$postData['title'].'%';

            }

            if(isset($postData['status']) && $postData['status'] != ''){

                $conditions['status'] = $postData['status'];

            }

        }

        $this->paginate['order'] = array('title' => 'asc');

        $this->paginate['limit'] = Configure::read('Paginate.limit');

        $this->paginate['conditions'] = $conditions;

        // Paginate the ORM table.

        $this->set('genres', $this->paginate('Genres'));

        $this->set('setStatus', Configure::read('status'));

        $this->set('session', $this->getUser());

    }
	public function newsletterFooter(){	
		$this->set('title_for_layout', 'Newsletter Footer');
		$this->loadModel('Admins.Settings');
		$session = $this->getUser();
		$setting = $this->Settings->findById(1)->firstOrFail();
		$postData = $this->request->getData();		
		if($this->request->is(['post','put'])){
			$user = $this->Settings->patchEntity($setting,$postData, ['validate'=>'updatesiteconfig']);
			if($this->Settings->save($user)){
				$this->Flash->success(__('Newsletter detail has been updated successfully.'));
				return $this->redirect(['action' => 'newsletterFooter']);
			}
			$this->Flash->error(__('Unable to update the site-configuration details.'));
		}
		$this->set('session',$session);
		$this->set('setting',$setting);
	}
	#categories page
    public function newsletterEmail(){

        $this->set('title_for_layout', 'Newsletters');
        $this->loadModel('Admins.NewsletterEmails');
        $conditions = array();
        $postData = $this->request->getQuery();
        if(!empty($postData)){
            if(isset($postData['email']) && $postData['email'] != ''){
                $conditions['email like'] = '%'.$postData['email'].'%';
            }
            if(isset($postData['type']) && $postData['type'] != ''){
                $conditions['type'] = $postData['type'];
            }
			if(isset($postData['top_banner_type']) && $postData['top_banner_type'] != ''){
                $conditions['top_banner_type'] = $postData['top_banner_type'];
            }
			if(isset($postData['current_status']) && $postData['current_status'] != ''){
                $conditions['current_status'] = $postData['current_status'];
            }
        }
        $this->paginate['order'] = array('id' => 'desc');
        $this->paginate['limit'] = Configure::read('Paginate.limit');
        $this->paginate['conditions'] = $conditions;
        // Paginate the ORM table.
        $this->set('newsletters', $this->paginate('NewsletterEmails'));
		$status = array(
			'Video' => 'Premier Video',
			'Random' => 'Random-Weekly News'
		);
        $this->set('setStatus', $status);
		$bannerType = array(
			'LMB' => 'Premier Video Banner ',
			'UCB' => 'Use Custom Banner'
		);
        $this->set('bannerType', $bannerType);
		$emailStatus = array(
			'Pending' => 'Pending',
			'InProcess' => 'InProcess',
			'Completed' => 'Completed'
		);
        $this->set('emailStatus', $emailStatus);
		
        $this->set('session', $this->getUser());

    }

	#categories page
    public function newsletters(){

        $this->set('title_for_layout', 'Newsletters');
        $this->loadModel('Admins.Newsletters');
        $conditions = array();
        $postData = $this->request->getQuery();
        if(!empty($postData)){
            if(isset($postData['email']) && $postData['email'] != ''){
                $conditions['email like'] = '%'.$postData['email'].'%';
            }
            if(isset($postData['status']) && $postData['status'] != ''){
                $conditions['status'] = $postData['status'];
            }
        }
        $this->paginate['order'] = array('id' => 'desc');
        $this->paginate['limit'] = Configure::read('Paginate.limit');
        $this->paginate['conditions'] = $conditions;
        // Paginate the ORM table.
        $this->set('newsletters', $this->paginate('Newsletters'));
        $this->set('setStatus', Configure::read('status'));
        $this->set('session', $this->getUser());

    }
    #edit Category

    public function addGenre($id = NULL){

        #check User Auth

        $this->set('title_for_layout', 'Add Genre');

        $this->loadModel('Admins.Genres');

        $genre = $this->Genres->newEmptyEntity();

        if(isset($id) && !empty($id)){

            $this->set('title_for_layout', 'Edit Genre');

            $genre = $this->Genres->findById($id)->firstOrFail();

            if(!isset($genre->id) && empty($genre->id)){

                $genre = $this->Genres->newEmptyEntity();

            }

        }

        if($this->request->is(['post', 'put'])){

            $postData = $this->request->getData();

            $genre = $this->Genres->patchEntity($genre, $this->request->getData());

            if($record = $this->Genres->save($genre)){

                $this->Flash->success(__('The genere detail has been saved successfully.'));

                return $this->redirect(['action' => 'addGenre', $record->id]);

            }

            $this->Flash->error(__('Unable to update the genere.'));

        }

        $this->set('session', $this->getUser());

		$this->set('genre', $genre);

    }
	public function viewEmailTemplate($type,$id,$rowID){
		if($type != "" && $id != '' && $rowID != ''){
			$this->set('title_for_layout', 'Email Template');
			$this->set('session', $this->getUser());
			$this->set('type', $type);
			$this->loadModel('Admins.Settings');
			$setting = $this->Settings->findById(1)->firstOrFail();
			$this->set('setting', $setting);
			$this->loadModel('Admins.NewsletterEmails');
			$newsletterData = $this->NewsletterEmails->findById($rowID)->firstOrFail();
			$this->set('newsletterData', $newsletterData);
			
				$innerPageTable = TableRegistry::get('Admins.InnerPages');
        		$homePageData = $innerPageTable->find()->where(array('id'=>6))->first();
				
				$cateArray = array();
				if($homePageData->category_id != ""){
					$cateArray = explode(',',$homePageData->category_id);
				}
				$this->set('cateArray',$cateArray);
			
				$moviewTable = TableRegistry::get('Admins.Products');
        		$latestMoview = $moviewTable->find()->where(array('id' =>$newsletterData->product_id))->first();
				$this->set('movieDetails', $latestMoview);
				$cateIDExplode = explode(',',$latestMoview->category_id);
				$this->loadModel('Admins.Categories');
				$categoryDetails = $this->Categories->findById($cateIDExplode[0])->firstOrFail();
				$this->set('categoryDetails', $categoryDetails);
				$categoryTable = TableRegistry::get('Admins.Categories');
				$categories = $categoryTable->find()->where(array('status' => 1))->order(array('ordering' => 'ASC'))->all();
				$this->set('categories',$categories);

			
			
		}else{
			return $this->redirect('/');
		}
	}
	public function addNewsletterEmail($id = NULL){

        #check User Auth
        $this->set('title_for_layout', 'Add Newsletter');
        $this->loadModel('Admins.NewsletterEmails');
        $news = $this->NewsletterEmails->newEmptyEntity();
        if(isset($id) && !empty($id)){
            $this->set('title_for_layout', 'Edit Genre');
            $news = $this->NewsletterEmails->findById($id)->firstOrFail();
            if(!isset($news->id) && empty($news->id)){
                $news = $this->NewsletterEmails->newEmptyEntity();
            }

        }
        if($this->request->is(['post', 'put'])){
            $postData = $this->request->getData();

            $news = $this->NewsletterEmails->patchEntity($news, $this->request->getData());
			$news['created'] = time();
			$news['modified'] = time();
			$news['status'] = 2;
			$news['page_no'] = 1;
			$news['current_status'] = 'Pending';
			
			if($postData['top_banner_name'] != ''){
				$news['top_banner'] = $postData['top_banner_name'];
			}else{
				$news['top_banner'] = $postData['old_top_banner'];
			}
			if($postData['middle_banner_name'] != ''){
				$news['middle_banner'] = $postData['middle_banner_name'];
			}else{
				$news['middle_banner'] = $postData['old_middle_banner'];
			}
			
            if($record = $this->NewsletterEmails->save($news)){
                $this->Flash->success(__('The genere detail has been saved successfully.'));
                return $this->redirect(['action' => 'newsletterEmail']);
            }
            $this->Flash->error(__('Unable to update the genere.'));
        }
		$this->loadModel('Admins.Products');
		$movies = $this->Products->find('all')->where(array('status' => 1))->order(array('id' => 'DESC'))->toArray();
        $this->set('session', $this->getUser());
		$this->set('news', $news);
		$this->set('movies', $movies);
    }
	public function editNewsletter($id = NULL){#check User Auth
        $this->set('title_for_layout', 'Edit Newsletter');
        $this->loadModel('Admins.Newsletters');
        $news = $this->Newsletters->newEmptyEntity();
        if(isset($id) && !empty($id)){
            $this->set('title_for_layout', 'Edit Newsletter');
            $news = $this->Newsletters->findById($id)->firstOrFail();
            if(!isset($news->id) && empty($news->id)){
                $news = $this->Newsletters->newEmptyEntity();
            }

        }
        if($this->request->is(['post', 'put'])){
            $postData = $this->request->getData();
            $news = $this->Newsletters->patchEntity($news, $this->request->getData());
            if($record = $this->Newsletters->save($news)){
                $this->Flash->success(__('Newsletter user has been updated successfully.'));
                return $this->redirect(['action' => 'newsletters']);
            }
        }
        $this->set('session', $this->getUser());
		$this->set('news', $news);
		
	}
	public function addNewsletter($id = NULL){

        #check User Auth
        $this->set('title_for_layout', 'Add Newsletter');
        $this->loadModel('Admins.Newsletters');
        $news = $this->Newsletters->newEmptyEntity();
        if(isset($id) && !empty($id)){
            $this->set('title_for_layout', 'Edit Genre');
            $news = $this->Newsletters->findById($id)->firstOrFail();
            if(!isset($news->id) && empty($news->id)){
                $news = $this->Newsletters->newEmptyEntity();
            }

        }
        if($this->request->is(['post', 'put'])){
            $postData = $this->request->getData();
			$expdata = explode(',',$postData['email']);
			if(is_array($expdata)){
				foreach($expdata as $key => $email){
					if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$existData = $this->Newsletters->findByEmail($email)->first();
						if(!isset($existData->id)){
							$news = $this->Newsletters->newEmptyEntity();
							$news['email'] = $email;
							$news['created'] = time();
							$news['modified'] = time();
							$this->Newsletters->save($news);
							$this->sendNesletterEmail($email);
						}
					}
				}
			}
			$this->Flash->success(__('Newsletter users has been saved successfully.'));
            return $this->redirect(['action' => 'newsletters']);
        }
        $this->set('session', $this->getUser());
		$this->set('news', $news);
    }
	public function sendNesletterEmail($email){
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
		return true;
	}
    #categories page

    public function orders(){

		$this->set('title_for_layout', 'Orders');

        #check User Auth

        $session = $this->getUser();

        #get content data

        $table = TableRegistry::get('Admins.Orders');

        # Conditions...

        $conditions = array();

		$postData = $this->request->getQuery();

        if(!empty($postData)){

            if(isset($postData['customer_email']) && $postData['customer_email'] != ''){

                $conditions['customer_email like'] = '%' . $postData['customer_email'] . '%';

            }

			if(isset($postData['customer_contact']) && $postData['customer_contact'] != ''){

                $conditions['customer_contact like'] = '%' . $postData['customer_contact'] . '%';

            }

			if(isset($postData['payment_status']) && $postData['payment_status'] != ''){

                $conditions['payment_status like'] = '%' . $postData['payment_status'] . '%';

            }

        }

		$conditions['conditions'] = $conditions;

        $conditions['order'] = array('id' => 'DESC');

        $conditions['limit'] = Configure::read('Paginate.limit');

        #get record data

        $this->paginate = $conditions;

        $orders = $this->paginate($table);

        $this->set(compact('orders', 'session'));

    }

	    

    #edit Static Content

    public function viewOrder($viewID = NULL){

        #check User Auth

        $this->checkValidSession();

        $this->viewBuilder()->setLayout(ADMIN_DASHBOARD_LAYOUT);

        $table = TableRegistry::get('Admins.Orders');

        $editID = $this->decryptData(base64_decode($viewID));

        $existOrder = $table->find()->where(array(ID => $editID))->first();

        $this->set('order', $existOrder);

    }



    #categories page

    public function categories(){

        $this->set('title_for_layout', 'Categories');

        $this->loadModel('Admins.Categories');

        $conditions = array();

        $postData = $this->request->getQuery();

        if(!empty($postData)){

            if(isset($postData['name']) && $postData['name'] != ''){

                $conditions['name like'] = '%'.$postData['name'].'%';

            }

            if(isset($postData['status']) && $postData['status'] != ''){

                $conditions['status'] = $postData['status'];

            }

        }

        $this->paginate['order'] = array('ordering' => 'asc');

        $this->paginate['limit'] = Configure::read('Paginate.limit');

        $this->paginate['conditions'] = $conditions;

        // Paginate the ORM table.

        $this->set('categories', $this->paginate('Categories'));

        $this->set('setStatus', Configure::read('status'));

        $this->set('session', $this->getUser());

    }



    #edit Category

    public function addCategory($id = NULL){

        #check User Auth

        $this->set('title_for_layout', 'Add Category');

        $this->loadModel('Admins.Categories');

        $categories = $this->Categories->newEmptyEntity();

        if(isset($id) && !empty($id)){

            $this->set('title_for_layout', 'Edit Category');

            //$id = base64_decode($id);

            $categories = $this->Categories->findById($id)->firstOrFail();

            if(!isset($categories->id) && empty($categories->id)){

                $categories = $this->Categories->newEmptyEntity();

            }

        }

        if($this->request->is(['post', 'put'])){

            $postData = $this->request->getData();

            $category = $this->Categories->patchEntity($categories, $this->request->getData());

            if(!isset($categories->id) && empty($categories->id)){

                $query = $this->Categories->find();

                $findOrder = $query->select(array('max_order' => $query->func()->max('ordering')))->first();

                if($findOrder->max_order == ''){

                    $category['ordering'] = 1;

                } else {

                    $category['ordering'] = ($findOrder->max_order + 1);

                }

            }

            if(isset($category['old_image']) && !empty($category['old_image']) && $category['old_image'] != $category['icon']){

                if(file_exists(Configure::read('Data.RelativePath').'categories/'.$category['old_image'])){

                    unlink(Configure::read('Data.RelativePath').'categories/'.$category['old_image']);

                }

            }

            if(isset($category['uploadVideoFile']) && !empty($category['uploadVideoFile'])){

                $category['video'] = $category['uploadVideoFile'];

            }

            if(isset($postData['rent_label']) && $postData['rent_label'] == 1){

                $category['rent_label'] = 1;

            } else {

                $category['rent_label'] = 2;

            }

            if(isset($postData['live_label']) && $postData['live_label'] == 1){

                $category['live_label'] = 1;

            } else {

                $category['live_label'] = 2;

            }

            if($postData['poster_type'] != ''){

                $category['poster_type'] = $postData['poster_type'];

            }

            $category['slug'] = $this->builtSlug($postData['name']);

            if($record = $this->Categories->save($category)){

                $this->Flash->success(__('The category detail has been saved successfully.'));

                return $this->redirect(['action' => 'addCategory', $record->id]);

            }

            $this->Flash->error(__('Unable to update the category.'));

        }

        $this->set('CategoryList', $this->getCategoryList());

        $this->set('categories', $categories);

        $this->set('session', $this->getUser());

    }



    public function viewCategoryDetails(){

        $this->viewBuilder()->layout = false;

        $this->autoRender = false;

        if($this->request->is('Ajax')){

            $this->loadModel('Admins.Categories');

            $postData = $this->request->getData();

            if(!empty($postData)){

                $id = $postData['categoryId'];

                $this->set(array('categoryDetail' => $this->Categories->findById($id)->firstOrFail()));

                $this->render('view_category_details');

            }

        }

    }

	public function viewTrailerUserDetails(){

        $this->viewBuilder()->layout = false;
        $this->autoRender = false;

        if($this->request->is('Ajax')){
            $this->loadModel('Admins.ProductViews');
			$this->loadModel('Admins.Products');
            $postData = $this->request->getData();
            if(!empty($postData)){
                $id = $postData['user_id'];
                $this->set(array('userDetails' => $this->ProductViews->find()->where(array('type' => 2,'product_id' => $id))->all()));
				$this->set(array('videoDetails' => $this->Products->find()->where(array('id' => $id))->first()));
                $this->render('view_user_details');
            }

        }

    }

	public function viewUserDetails(){

        $this->viewBuilder()->layout = false;
        $this->autoRender = false;

        if($this->request->is('Ajax')){
            $this->loadModel('Admins.ProductViews');
			$this->loadModel('Admins.Products');
            $postData = $this->request->getData();
            if(!empty($postData)){
                $id = $postData['user_id'];
                $this->set(array('userDetails' => $this->ProductViews->find()->where(array('type' => 1,'product_id' => $id))->all()));
				$this->set(array('videoDetails' => $this->Products->find()->where(array('id' => $id))->first()));
                $this->render('view_user_details');
            }

        }

    }

    #states page

    public function products(){
		
		

        $this->set('title_for_layout', 'Products');

        $this->loadModel('Admins.Products');
        $this->loadModel('Admins.Categories');

        $conditions = array();
        $postData = $this->request->getQuery();
        if(!empty($postData)){

            if(isset($postData['name']) && $postData['name'] != ''){
                $conditions['product_name like'] = '%'.$postData['name'].'%';
            }

            if(isset($postData['status']) && $postData['status'] != ''){
                $conditions['status'] = $postData['status'];
            }

        }

        $this->paginate['order'] = array('id' => 'DESC');
        $this->paginate['limit'] = Configure::read('Paginate.limit');
        $this->paginate['conditions'] = $conditions;
        $this->set('products', $this->paginate('Products'));
        $this->set('setStatus', Configure::read('status'));
        $this->set('session', $this->getUser());
        $this->set('allCategoryList', $this->Categories->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status =' => 1]));

    }

	public function assignVideo($id = NULL){

        #check User Auth
        $this->set('title_for_layout', 'Assign Video');
		
		$this->loadModel('Admins.Products');
		$videoDetails = $this->Products->find()->where(array('id' => $id))->first();
		$this->set('videoDetails', $videoDetails);

        if($this->request->is(['post', 'put'])){
			$postData = $this->request->getData();
			if($postData['email'] != ""){
				if(strtolower($postData['email']) == 'admin'){
					$assignID = 0;
				}else{
					$this->loadModel('Admins.Users');
					$userData = $this->Users->find()->where(array('email' => $postData['email']))->first();
					if(isset($userData->id)){
						$assignID = $userData->id;
						
						$userTable = TableRegistry::get('Users');
						
						$saveUserData['id'] = $userData->id;
						$saveUserData['is_film_maker'] = 1;
						$tableEntity = $userTable->newEntity(array_map('trim',preg_replace('/\s+/', ' ', $saveUserData)));
						$userTable->save($tableEntity);
					}
				}
				$videoTable = TableRegistry::get('Products');
				$saveVideoData['id'] = $id;
				$saveVideoData['added_by'] = $assignID;
				$tableEntity2 = $videoTable->newEntity(array_map('trim',preg_replace('/\s+/', ' ', $saveVideoData)));
				$videoTable->save($tableEntity2);
				
				return $this->redirect(['action' => 'products']);
			}
		}
        $this->set('session', $this->getUser());

    }

    public function addProduct($id = NULL){

        $this->set('title_for_layout', 'Add Media');
        $this->loadModel('Admins.Products');
        $this->loadModel('Admins.ProductImages');
		$this->loadModel('Admins.Genres');
		$this->loadModel('Admins.Banners');
		$this->loadModel('Admins.Languages');
		$this->loadModel('Admins.Categories');

        $products = $this->Products->newEmptyEntity();

        if(isset($id) && !empty($id)){

            $this->set('title_for_layout', 'Edit Media');

            //$id = base64_decode($id);

            $products = $this->Products->findById($id)->firstOrFail();

            if(!isset($products->id) && empty($products->id)){

                $products = $this->Products->newEmptyEntity();

            }

            $editID = $id;

            #get row data

            $editData = $this->Products->find()->where(array('id' => $editID))->first();

            if(isset($editData->id) && !empty($editData->id)){

                $productImages = $this->ProductImages->find('all')->where(array('product_id' => $editID))->order(array('ordering' => 'ASC'));

                if($productImages->count() > 0){

                    $i = 1;

                    foreach ($productImages as $product):

                        $query = $this->ProductImages->query();

                        $query->update()->set(['ordering' => $i, 'image_alt' => ucwords($editData->product_name).' '.$i, 'image_title' => ucwords($editData->product_name).' '.$i])->where(['id' => $product->id])->execute();

                        $i++;

                    endforeach;

                }

                $this->set('productImages', $productImages);

            } else {

                return $this->redirect(['action' => 'products/']);

            }

        }

		

        if($this->request->is(['post', 'put'])){

			$postData = $this->request->getData();				
			
			$generes = '';
			
			if(isset($postData['genres']) && is_array($postData['genres'])){				
			
			$generes = implode(",", $postData['genres']);			
			
			}
			$categoryIds = '';			
			
			if(isset($postData['category_id']) && is_array($postData['category_id'])){				

				$categoryIds = implode(",", $postData['category_id']);		
			
			}
			
            $products = $this->Products->patchEntity($products, $this->request->getData());
            $products['discount'] = 0;
            $products['video'] = $postData['video'];
            $products['category_id'] = $categoryIds;
			$products['genres'] = $generes;
            $products['slug'] = $this->builtSlug($postData['product_name']);
			$products['big_banner_status'] = $postData['big_banner_status'];
			$products['price'] = $postData['price'];
			if(isset($id) && !empty($id)){
				$products['modified'] = time();
			}else{
				$products['created'] = time();
				$products['modified'] = time();

			}
			if(isset($postData['language']) && !empty($postData['language'])){

				$languageCount = $this->Languages->find()->where(array('title' => $postData['language']))->count();

				if($languageCount == 0){

					$languages = $this->Languages->newEmptyEntity();

					$saveLang = $this->Languages->patchEntity($languages,$this->request->getData());

					$saveLang['title'] = ucwords($postData['language']);

					$this->Languages->save($saveLang);

				}

			}

            if($record = $this->Products->save($products)){

				

				if($products['big_banner_status'] == 1 && $postData['big_banner'] != ""){

					$bannerCount = $this->Banners->find()->where(array('type' => 'Media','product_id' => $record->id))->count();

					if($bannerCount == 0){

						$query = $this->Banners->find();

						$findOrder = $query->select(array('max_order' => $query->func()->max('ordering')))->first();

						if($findOrder->max_order == ''){

							$banner['ordering'] = 1;

						} else {

							$banner['ordering'] = ($findOrder->max_order + 1);

						}

						

					}else{

						$bannerData = $this->Banners->find()->where(array('type' => 'Media','product_id' => $record->id))->first();

						$banner['id'] = $bannerData->id;

						

					}

					$bannerURL = '';

					if(isset($postData['category_id'][0])){

						$categoryData = $this->Categories->find()->where(array('id' => $postData['category_id'][0]))->first();

						$bannerURL = SITEURL.'movie/'.$categoryData->slug.'/'.$products['slug'].'/';

					}

					$banner['title'] = $products['product_name'];

					$banner['type'] = 'Media';

					$banner['banner'] = $products['big_banner'];

					$banner['url'] = $bannerURL;

					$banner['created'] = time();

					$banner['product_id'] = $record->id;

					$banner['status'] = 1;

					$bnnerTable = TableRegistry::get('Banners');

					$tableEntity = $bnnerTable->newEntity($banner);

					$bnnerTable->save($tableEntity);

				}else{

					$bannerCount = $this->Banners->find()->where(array('type' => 'Media','product_id' => $record->id))->count();

					if($bannerCount > 0){

						$bannerData = $this->Banners->find()->where(array('type' => 'Media','product_id' => $record->id))->first();

						$banner['id'] = $bannerData->id;

						$banner['status'] = 2;

						$bnnerTable = TableRegistry::get('Banners');

						$tableEntity = $bnnerTable->newEntity($banner);

						$bnnerTable->save($tableEntity);

					}

				}

				

                if(isset($postData['ordering']) && !empty($postData['ordering'])){

                    foreach ($postData['ordering'] as $keys => $vals):

                        $queryUpd = $this->ProductImages->query();

                        $queryUpd->update()->set(['ordering' => $vals])->where(['id' => $postData['orderingEditId'][$keys]])->execute();

                    endforeach;

                }

                $this->Flash->success(__('The media detail has been saved successfully.'));

                return $this->redirect(['action' => 'addProduct', $record->id]);

            }

            $this->Flash->error(__('Unable to update the product.'));

        }

		$genres = $this->Genres->find('all')->where(array('status' => 1))->order(array('title' => 'ASC'))->toArray();
		$genresArray = array();
		foreach($genres as $key => $genre){
			$genresArray[$genre->title] = $genre->title;
		}
		
        $this->set('CategoryList', $this->getCategoryList());
        $this->set('products', $products);
        $this->set('session', $this->getUser());
        $this->set('robotTags', Configure::read('RobotTags'));
		$this->set('censorCategories', Configure::read('CensorCategories'));
		$this->set('genres', $genresArray);

    }



    public function addTrailer($id = NULL){

        $this->set('title_for_layout', 'Add Media');

        $this->loadModel('Admins.Products');

        $this->loadModel('Admins.ProductImages');

        $products = $this->Products->newEmptyEntity();

        if(isset($id) && !empty($id)){

            $this->set('title_for_layout', 'Edit Media');

            //$id = base64_decode($id);

            $products = $this->Products->findById($id)->firstOrFail();

            if(!isset($products->id) && empty($products->id)){

                $products = $this->Products->newEmptyEntity();

            }

            $editID = $id;

        }

        if($this->request->is(['post', 'put'])){

            $postData = $this->request->getData();

            $products = $this->Products->patchEntity($products, $this->request->getData());

            $products['trailer_video'] = $postData['trailer_video'];

            if($record = $this->Products->save($products)){

                $this->Flash->success(__('The trailer uploaded successfully.'));

                return $this->redirect(['action' => 'addTrailer', $record->id]);

            }

            $this->Flash->error(__('Unable to update the product.'));

        }

        $this->set('CategoryList', $this->getCategoryList());

        $this->set('products', $products);

        $this->set('session', $this->getUser());

        $this->set('robotTags', Configure::read('RobotTags'));

    }



    public function deleteProductImage(){

        $this->viewBuilder()->setLayout('false');

        if($this->request->is('Ajax')){

            $postData = $this->request->getData();

            if(!empty($postData)){

                $rowId = $postData['rowId'];

                $this->loadModel('Admins.ProductImages');

                $deleteRecord = $this->ProductImages->find()->where(array('id' => $rowId))->first();

                $imageName = $deleteRecord->image_name;

                if(file_exists(WWW_ROOT.'img/products/'.$imageName)){

                    unlink(WWW_ROOT.'img/products/'.$imageName);

                }

                $record = $this->ProductImages->get($rowId);

                $this->ProductImages->delete($record);

            }

        }

        exit;

    }



    public function uploadProductImages(){

        $this->viewBuilder()->setLayout('false');

        if($this->request->is('Ajax')){

            if(!empty($_FILES)){

                $this->loadModel('Admins.ProductImages');

                $msg = "Error";

                $fileName = $_FILES['file']['name']; //Get the image

                $file_full = WWW_ROOT.'img/products/'; //Image storage path

                $file_temp_name = $_FILES['file']['tmp_name'];

                $pathInfo = pathinfo(basename($fileName));

                $ext = $pathInfo['extension'];

                $checkImage = getimagesize($file_temp_name);

                if($checkImage !== false){

                    $new_file_name = date('d_m_Y_H_i_'.mt_rand(111, 999).'_a.').$ext;

                    if(move_uploaded_file($file_temp_name, $file_full.$new_file_name)){

                        #### rezize image #######

                        $image = new ImageResize($file_full.$new_file_name);

                        $image->crop(500, 500);

                        $image->save($file_full.$new_file_name);

                        ######## end ############

                        $query = $this->ProductImages->findByProductId($_REQUEST['pid']);

                        //$record= $query->select(array('max_order' => $query->func()->max('ordering')))->first();

                        //if($record['max_order'] == ''){$record['max_order'] = 1;}

                        $saveData['product_id'] = $_REQUEST['pid'];

                        $saveData['image_name'] = $new_file_name;

                        $saveData['ordering'] = 0;

                        $tableEntity = $this->ProductImages->newEntity($saveData);

                        $this->ProductImages->save($tableEntity);

                        $msg = "Success";

                    }

                }

            }

            echo json_encode(array('msg' => $msg));

        }

        exit;

    }



    public function viewProductDetails(){

        $this->viewBuilder()->layout = false;

        $this->autoRender = false;

        if($this->request->is('Ajax')){

            $this->loadModel('Admins.Products');

            $this->loadModel('Admins.ProductImages');

            $postData = $this->request->getData();

            if(!empty($postData)){

                $id = $postData['productId'];

                $this->set(array('productDetail' => $this->Products->findById($id)->firstOrFail()));

                $this->set(array('productImages' => $this->ProductImages->find('all')->where(['product_id' => $id])->order(['ordering' => 'ASC'])));

                $this->render('view_product_details');

            }

        }

    }



    public function uploadIntroVideo(){

        if(!file_exists(WWW_ROOT.'img/categories/')){

            mkdir(WWW_ROOT.'img/categories/', 0777);

        }

        $dir_name = $_GET['dir_name'];

        $tmp_name = $_FILES['fileToUpload']['tmp_name'];

        $orig_file_size = filesize($tmp_name);

        $pathInfo = pathinfo(basename($_REQUEST['filename']));

        $ext = $pathInfo['extension'];

        $newFileName = $dir_name.".".$ext;

        $target_path = WWW_ROOT.'img/categories/'.$newFileName;

        $complete = $target_path;

        $com = fopen($complete, "ab");

        error_log($target_path);

        $in = fopen($tmp_name, "rb");

        if($in){

            while ($buff = fread($in, 2097152)){

                fwrite($com, $buff);

            }

        }

        fclose($in);

        fclose($com);

        unset($target_path, $tmp_name, $size, $name, $com, $newFileName);

        flush();

        die;

    }



    public function uploadIntroVideoProduct(){

        if(!file_exists(WWW_ROOT.'img/products/')){

            mkdir(WWW_ROOT.'img/products/', 0777);

        }

        $dir_name = $_GET['dir_name'];

        $tmp_name = $_FILES['fileToUpload']['tmp_name'];

        $orig_file_size = filesize($tmp_name);

        $pathInfo = pathinfo(basename($_REQUEST['filename']));

        $ext = $pathInfo['extension'];

        $newFileName = $dir_name.".".$ext;

        $target_path = WWW_ROOT.'img/products/'.$newFileName;

        $complete = $target_path;

        $com = fopen($complete, "ab");

        error_log($target_path);

        $in = fopen($tmp_name, "rb");

        if($in){

            while ($buff = fread($in, 2097152)){

                fwrite($com, $buff);

            }

        }

        fclose($in);

        fclose($com);

        unset($target_path, $tmp_name, $size, $name, $com, $newFileName);

        flush();

        die;

    }



    #checkLoginSession

    function checkValidSession(){

        $session = $this->request->getSession();

        $nextPageUrl = $_SERVER["REQUEST_URI"];

        $session->write('nextPageUrl', $nextPageUrl);

        if(!$session->check(AUTHADMINID)){

            return $this->redirect(ADMIN_FOLDER);

        }

    }



    #checkLoginSession

    function checkLoginSession(){

        $session = $this->request->getSession();

        if(!empty($session->read(AUTHADMINID))){

            return $this->redirect(ADMIN_FOLDER.'dashboard/');

        }

    }



    function getCategoryList(){

        $this->loadModel('Admins.Categories');

        return $this->Categories->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['status =' => 1, 'parent_id' => 0]);

    }

}

?>