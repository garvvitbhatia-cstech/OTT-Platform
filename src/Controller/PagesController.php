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
use Cake\ORM\TableRegistry;
use Cake\Mailer\Mailer;







/**



 * Static content controller



 *



 * This controller will render views from templates/Pages/



 *



 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html



 */



class PagesController extends AppController



{



    /**



     * Displays a view



     *



     * @param string ...$path Path segments.



     * @return \Cake\Http\Response|null



     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.



     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not



     *   be found and in debug mode.



     * @throws \Cake\Http\Exception\NotFoundException When the view file could not



     *   be found and not in debug mode.



     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.



     */



	public function index(){
		$this->loadModel('InnerPages');
		$this->loadModel('Categories');
		$pageData = $this->InnerPages->singleRecord(6);
		$conditions = array('status' => 1);
		$categories = $this->Categories->conditionalRecords($conditions);
		$this->set('categories',$categories);
		$this->set('pageData',$pageData);
		$cateArray = array();
		if($pageData->category_id != ""){
			$cateArray = explode(',',$pageData->category_id);
		}
		$this->set('cateArray',$cateArray);
	}
	public function search(){

		$this->loadModel('InnerPages');
		$this->loadModel('Categories');
		$pageData = $this->InnerPages->singleRecord(6);
		$conditions = array('status' => 1);
		$categories = $this->Categories->conditionalRecords($conditions);
		$this->set('pageData',$pageData);
		$this->set('categories',$categories);
		
		$items = array();
		$searchKey = '';
		if(isset($_GET['producer']) && $_GET['producer'] != ""){
			$searchKey = $_GET['producer'];
			$this->loadModel('Products');
			$conditionsPro = array('status' => 1, 'producer LIKE' => '%'.trim($searchKey).'%');
			$producers = $this->Products->conditionalRecords($conditionsPro);
			
			if($producers->count() > 0){
				foreach($producers as $key => $producer){
					$records[]  = $producer->id;
				}
			}
			$items = array();
			foreach($records as $key => $pID){
				$videoData = $this->Products->singleRecord($pID);
				
				$items[$key] = $videoData;
			}
		}
		if(isset($_GET['director']) && $_GET['director'] != ""){
			$searchKey = $_GET['director'];
			$this->loadModel('Products');
			$conditionsPro = array('status' => 1, 'director LIKE' => '%'.trim($searchKey).'%');
			$producers = $this->Products->conditionalRecords($conditionsPro);
			
			if($producers->count() > 0){
				foreach($producers as $key => $producer){
					$records[]  = $producer->id;
				}
			}
			$items = array();
			foreach($records as $key => $pID){
				$videoData = $this->Products->singleRecord($pID);
				
				$items[$key] = $videoData;
			}
		}
		
		if($this->request->is(['post', 'put'])){
			
			$postData = $this->request->getData();
			$searchKey = $postData['search_key'];
			$records = array();
			$this->loadModel('Products');
			$conditions = array('status' => 1, 'product_name LIKE' => '%'.trim($searchKey).'%');
			$items = $this->Products->conditionalRecords($conditions);
			if($items->count() > 0){
				foreach($items as $key => $item){
					$records[]  = $item->id;
				}
			}
			$conditionsDir = array('status' => 1, 'director LIKE' => '%'.trim($searchKey).'%');
			$directors = $this->Products->conditionalRecords($conditionsDir);
			
			if($directors->count() > 0){
				foreach($directors as $key => $director){
					$records[]  = $director->id;
				}
			}
			
			$conditionsPro = array('status' => 1, 'producer LIKE' => '%'.trim($searchKey).'%');
			$producers = $this->Products->conditionalRecords($conditionsPro);
			
			if($producers->count() > 0){
				foreach($producers as $key => $producer){
					$records[]  = $producer->id;
				}
			}
			
			$conditionsCast = array('status' => 1, 'keywords LIKE' => '%'.trim($searchKey).'%');
			$keywords = $this->Products->conditionalRecords($conditionsCast);
			
			if($keywords->count() > 0){
				foreach($keywords as $key => $keyword){
					$records[]  = $keyword->id;
				}
			}
			$finalArray = array_unique($records);
			
			$searchResult = 'No';
			if(count($finalArray) > 0){
				$searchResult = 'Yes';
			}
			$this->set('searchResult',$searchResult);
			
			$items = array();
			foreach($finalArray as $key => $pID){
				$videoData = $this->Products->singleRecord($pID);
				
				$items[$key] = $videoData;
			}
			
		}
		$this->set('searchKey',$searchKey);
		$this->set('items',$items);

	}



	public function movieDetails($catSlug,$slug){

		if($catSlug != "" && $slug != ""){
			$this->loadModel('Products');
			$this->loadModel('Categories');
			$this->loadModel('Wishlists');
			$conditions = array('slug' => $slug);
			$movieCount = $this->Products->conditionalRecordCount($conditions);
			$conditions2 = array('slug' => $catSlug);
			$catCount = $this->Categories->conditionalRecordCount($conditions2);
			if($movieCount > 0 && $catCount > 0){
				$isRent = 'No';
				$movieData = $this->Products->conditionalSingleRecord($conditions);
				$this->set('movieData',$movieData);
				
				#for You May Like
				$explodeCategory = explode(',',$movieData->category_id);
				$youMayLikeCateID = $explodeCategory[0];
				if($explodeCategory[0] == 1 && isset($explodeCategory[1])){
					$youMayLikeCateID = $explodeCategory[1];
				}
				
				$youMayLikeCategoryData = $this->Categories->singleRecord($youMayLikeCateID);
				$this->set('youMayLikeCategoryData',$youMayLikeCategoryData);

				
				$rentCount = $this->Categories->conditionalRecordCount(array('slug' => $catSlug, 'rent_label' => 1));
				if($rentCount > 0){$isRent = 'Yes';}
				$this->set('isRent',$isRent);
				$this->set('catSlug',$catSlug);
				$categoryData = $this->Categories->conditionalSingleRecord($conditions2);
				$this->set('categoryData',$categoryData);
				$session = $this->request->getSession();
				$remainingMovies = $this->Products->fetchRecords(array('status' => 1),array('id' => 'DESC'),40);
				$this->set('remainingMovies',$remainingMovies);
				$currentWishStatus = 2;
				if($session->check('LoginUser.id')){
					$conditions2 = array('user_id' => $session->read('LoginUser.id'), 'product_id' => $movieData->id);
					$wishDataCount = $this->Wishlists->conditionalRecordCount($conditions2);
					if($wishDataCount > 0){
						$wishData = $this->Wishlists->conditionalSingleRecord($conditions2);
						$currentWishStatus = $wishData->wishlist;
					}
				}
				$this->set('currentWishStatus',$currentWishStatus);
				

			}else{
				return $this->redirect('/');
			}
		}else{
			return $this->redirect('/');
		}
	}
	public function playMovie($type,$catSlug,$slug){

		if($type == 'trailer' || $type == 'movie'){

			$this->viewBuilder()->setLayout('pricing');
			$this->loadModel('Products');
			$this->loadModel('Categories');

			$conditions = array('slug' => $slug);
			$movieCount = $this->Products->conditionalRecordCount($conditions);
			
			if($movieCount > 0){

				$movieData = $this->Products->conditionalSingleRecord($conditions);
				$this->set('movieData',$movieData);
				
				#for You May Like
				$explodeCategory = explode(',',$movieData->category_id);
				$youMayLikeCateID = $explodeCategory[0];
				if($explodeCategory[0] == 1 && isset($explodeCategory[1])){
					$youMayLikeCateID = $explodeCategory[1];
				}
				
				$youMayLikeCategoryData = $this->Categories->singleRecord($youMayLikeCateID);
				$this->set('youMayLikeCategoryData',$youMayLikeCategoryData);
				
				$this->saveWatchList($movieData->id);
				$categoryIDs = explode(",",$movieData->category_id);
				$categoryData = $this->Categories->singleRecord($categoryIDs[0]);
				$this->set('categoryData',$categoryData);
				$this->set('type',$type);
				$this->set('catSlug',$catSlug);
				$isRent = 'No';
				$rentCount = $this->Categories->conditionalRecordCount(array('slug' => $catSlug, 'rent_label' => 1));
				if($rentCount > 0){$isRent = 'Yes';}
				$this->set('isRent',$isRent);
				$session = $this->request->getSession();
				
				# for movie
				if($session->check('LoginUser.id') && $type == 'movie'){
					$this->loadModel('ProductViews');
					$movieCount = $this->ProductViews->conditionalRecordCount(array('type' => 1, 'product_id' => $movieData->id, 'user_id' => $session->read('LoginUser.id')));
					if($movieCount == 0){
						#update views
						$movieView['product_id'] = $movieData->id;
						$movieView['type'] = 1;
						$movieView['user_id'] = $session->read('LoginUser.id');
						$this->ProductViews->createRecord($movieView);
					}
				}
				# for trailer
				if($session->check('LoginUser.id') && $type == 'trailer'){
					$this->loadModel('ProductViews');
					$trailerCount = $this->ProductViews->conditionalRecordCount(array('type' => 2, 'product_id' => $movieData->id, 'user_id' => $session->read('LoginUser.id')));
					if($trailerCount == 0){
						#update views
						$trailerView['product_id'] = $movieData->id;
						$trailerView['type'] = 2;
						$trailerView['user_id'] = $session->read('LoginUser.id');
						$this->ProductViews->createRecord($trailerView);
					}
				}
				$currentWishStatus = 2;
				if($session->check('LoginUser.id')){
					$this->loadModel('Wishlists');
					$conditions2 = array('user_id' => $session->read('LoginUser.id'), 'product_id' => $movieData->id);
					$wishDataCount = $this->Wishlists->conditionalRecordCount($conditions2);
					if($wishDataCount > 0){
						$wishData = $this->Wishlists->conditionalSingleRecord($conditions2);
						$currentWishStatus = $wishData->wishlist;
					}
				}
				$this->set('currentWishStatus',$currentWishStatus);
				$remainingMovies = $this->Products->fetchRecords(array('status' => 1),array('id' => 'DESC'),40);
				$this->set('remainingMovies',$remainingMovies);

			}else{

				return $this->redirect('/');

			}

		}else{

			return $this->redirect('/');

		}

	}
	
	public function unsubscribeNow($email){
		
		if($email != ""){
			$email = base64_decode($email);
			
			$this->loadModel('Newsletters');
			$newsEmailExist = $this->Newsletters->conditionalRecordCount(array('email' => $email));
			
			if($newsEmailExist > 0){
				$data = $this->Newsletters->conditionalSingleRecord(array('email' => $email));
				
				$this->Newsletters->deleteRecord($data->id);
			}
			$this->loadModel('InnerPages');
			$pageData = $this->InnerPages->singleRecord(23);
			$this->set('pageData',$pageData);
		}else{
			return $this->redirect('/');
		}
	}

	public function saveWatchList($productID){

		$session = $this->request->getSession();

		if($session->check('LoginUser.id')){

			$userID = $session->read('LoginUser.id');

			$this->loadModel('WatchLists');

			$conditions = array('user_id' => $userID,'product_id' => $productID);

			$recordCount = $this->WatchLists->conditionalRecordCount($conditions);

			if($recordCount > 0){

				$record = $this->WatchLists->conditionalSingleRecord($conditions);

				$setData['id'] = $record->id;

				$setData['created'] = time();

			}else{

				$setData['user_id'] = $userID;

				$setData['product_id'] = $productID;

				$setData['created'] = time();

			}

			$record = $this->WatchLists->createRecord($setData);

		}

		return true;

	}

	public function movies(){



		$this->loadModel('InnerPages');



		$this->loadModel('Categories');



		$pageData = $this->InnerPages->singleRecord(11);



		$cateArray = $categories = array();

		if($pageData->category_id != ""){

			$categories = explode(',',$pageData->category_id);

		}

		foreach($categories as $key => $category){

			$categoryData = $this->Categories->singleRecord($category);

			$cateArray[$key]['id'] = $categoryData->id;

			$cateArray[$key]['name'] = $categoryData->name;

			$cateArray[$key]['slug'] = $categoryData->slug;

			$cateArray[$key]['poster_type'] = $categoryData->poster_type;

			$cateArray[$key]['rent_label'] = $categoryData->rent_label;

			$cateArray[$key]['live_label'] = $categoryData->live_label;

		}

		$this->set('pageData',$pageData);

		$this->set('categories',$cateArray);
		
		$this->loadModel('Products');
		$remainingMovies = $this->Products->fetchRandomRecords(array('status' => 1),40);
		$this->set('remainingMovies',$remainingMovies);



	}



	public function musicVideos(){



		$this->loadModel('InnerPages');



		$this->loadModel('Categories');



		$pageData = $this->InnerPages->singleRecord(12);

		

		$cateArray = $categories = array();

		if($pageData->category_id != ""){

			$categories = explode(',',$pageData->category_id);

		}



		foreach($categories as $key => $category){



			$categoryData = $this->Categories->singleRecord($category);



			$cateArray[$key]['id'] = $categoryData->id;



			$cateArray[$key]['name'] = $categoryData->name;



			$cateArray[$key]['slug'] = $categoryData->slug;



			$cateArray[$key]['poster_type'] = $categoryData->poster_type;



			$cateArray[$key]['rent_label'] = $categoryData->rent_label;



			$cateArray[$key]['live_label'] = $categoryData->live_label;



		}



		$this->set('pageData',$pageData);



		$this->set('categories',$cateArray);
		
		$this->loadModel('Products');
		$remainingMovies = $this->Products->fetchRandomRecords(array('status' => 1),40);
		$this->set('remainingMovies',$remainingMovies);



	}



	public function show(){



		$this->loadModel('InnerPages');



		$this->loadModel('Categories');



		$pageData = $this->InnerPages->singleRecord(13);

		

		$cateArray = $categories = array();

		if($pageData->category_id != ""){

			$categories = explode(',',$pageData->category_id);

		}



		foreach($categories as $key => $category){



			$categoryData = $this->Categories->singleRecord($category);



			$cateArray[$key]['id'] = $categoryData->id;



			$cateArray[$key]['name'] = $categoryData->name;



			$cateArray[$key]['slug'] = $categoryData->slug;



			$cateArray[$key]['poster_type'] = $categoryData->poster_type;



			$cateArray[$key]['rent_label'] = $categoryData->rent_label;



			$cateArray[$key]['live_label'] = $categoryData->live_label;



		}





		$this->set('pageData',$pageData);



		$this->set('categories',$cateArray);
		$this->loadModel('Products');
		$remainingMovies = $this->Products->fetchRandomRecords(array('status' => 1),40);
		$this->set('remainingMovies',$remainingMovies);



	}



	public function liveTv(){
		$this->loadModel('InnerPages');
		$this->loadModel('Categories');
		$pageData = $this->InnerPages->singleRecord(14);
		$cateArray = $categories = array();
		if($pageData->category_id != ""){
			$categories = explode(',',$pageData->category_id);
		}
		foreach($categories as $key => $category){

			$categoryData = $this->Categories->singleRecord($category);
			$cateArray[$key]['id'] = $categoryData->id;
			$cateArray[$key]['name'] = $categoryData->name;
			$cateArray[$key]['slug'] = $categoryData->slug;
			$cateArray[$key]['poster_type'] = $categoryData->poster_type;
			$cateArray[$key]['rent_label'] = $categoryData->rent_label;
			$cateArray[$key]['live_label'] = $categoryData->live_label;
		}
		$this->set('pageData',$pageData);
		$this->set('categories',$cateArray);
		$this->loadModel('Products');
		$remainingMovies = $this->Products->fetchRandomRecords(array('status' => 1),40);
		$this->set('remainingMovies',$remainingMovies);
	}



	public function feature(){

		$this->loadModel('InnerPages');
		$this->loadModel('Categories');
		$pageData = $this->InnerPages->singleRecord(15);
		$cateArray = $categories = array();
		if($pageData->category_id != ""){
			$categories = explode(',',$pageData->category_id);
		}
		foreach($categories as $key => $category){

			$categoryData = $this->Categories->singleRecord($category);
			$cateArray[$key]['id'] = $categoryData->id;
			$cateArray[$key]['name'] = $categoryData->name;
			$cateArray[$key]['slug'] = $categoryData->slug;
			$cateArray[$key]['poster_type'] = $categoryData->poster_type;
			$cateArray[$key]['rent_label'] = $categoryData->rent_label;
			$cateArray[$key]['live_label'] = $categoryData->live_label;
		}
		$this->set('pageData',$pageData);
		$this->set('categories',$cateArray);
		$this->loadModel('Products');
		$remainingMovies = $this->Products->fetchRandomRecords(array('status' => 1),40);
		$this->set('remainingMovies',$remainingMovies);
	}



	public function short(){



		$this->loadModel('InnerPages');



		$this->loadModel('Categories');



		$pageData = $this->InnerPages->singleRecord(16);

		

		$cateArray = $categories = array();

		if($pageData->category_id != ""){

			$categories = explode(',',$pageData->category_id);

		}



		foreach($categories as $key => $category){



			$categoryData = $this->Categories->singleRecord($category);



			$cateArray[$key]['id'] = $categoryData->id;



			$cateArray[$key]['name'] = $categoryData->name;



			$cateArray[$key]['slug'] = $categoryData->slug;



			$cateArray[$key]['poster_type'] = $categoryData->poster_type;



			$cateArray[$key]['rent_label'] = $categoryData->rent_label;



			$cateArray[$key]['live_label'] = $categoryData->live_label;



		}



		$this->set('pageData',$pageData);



		$this->set('categories',$cateArray);
		$this->loadModel('Products');
		$remainingMovies = $this->Products->fetchRandomRecords(array('status' => 1),40);
		$this->set('remainingMovies',$remainingMovies);



	}



	public function viewAll($cateSlug){



		if($cateSlug != ""){



			$this->loadModel('Categories');



			$conditions = array('status' => 1,'slug' => $cateSlug);



			$count = $this->Categories->conditionalRecordCount($conditions);



			if($count > 0){



				$categoryData = $this->Categories->conditionalSingleRecord($conditions);



				$this->set('categoryData',$categoryData);



			}else{



				return $this->redirect('/');



			}



		}else{



			return $this->redirect('/');



		}



	}

	public function classic(){

		$this->loadModel('InnerPages');
		$this->loadModel('Categories');

		$pageData = $this->InnerPages->singleRecord(17);
		$cateArray = $categories = array();
		if($pageData->category_id != ""){
			$categories = explode(',',$pageData->category_id);
		}

		foreach($categories as $key => $category){

			$categoryData = $this->Categories->singleRecord($category);
			$cateArray[$key]['id'] = $categoryData->id;
			$cateArray[$key]['name'] = $categoryData->name;
			$cateArray[$key]['slug'] = $categoryData->slug;
			$cateArray[$key]['poster_type'] = $categoryData->poster_type;
			$cateArray[$key]['rent_label'] = $categoryData->rent_label;
			$cateArray[$key]['live_label'] = $categoryData->live_label;
		}

		$this->set('pageData',$pageData);
		$this->set('categories',$cateArray);
		
		$this->loadModel('Products');
		$remainingMovies = $this->Products->fetchRandomRecords(array('status' => 1),40);
		$this->set('remainingMovies',$remainingMovies);

	}
	public function aboutUs(){
		$this->viewBuilder()->setLayout('content');
		$this->loadModel('InnerPages');
		$pageData = $this->InnerPages->singleRecord(5);
		$this->set('pageData',$pageData);
	}
	public function privacyPolicy(){
		$this->viewBuilder()->setLayout('content');
		$this->loadModel('InnerPages');
		$pageData = $this->InnerPages->singleRecord(2);
		$this->set('pageData',$pageData);
	}
	public function termsAndConditions(){

		$this->viewBuilder()->setLayout('content');
		$this->loadModel('InnerPages');
		$pageData = $this->InnerPages->singleRecord(1);
		$this->set('pageData',$pageData);
	}
	public function cookies(){
		$this->viewBuilder()->setLayout('content');
		$this->loadModel('InnerPages');
		$pageData = $this->InnerPages->singleRecord(3);
		$this->set('pageData',$pageData);
	}
	public function helpCenter(){
		
		/*$email = new Email('email');
$email->from(['me@example.com' => 'My Site'])
    ->to('you@example.com')
    ->subject('About')
    ->send('My message');*/
		
		$this->viewBuilder()->setLayout('content');
		$this->loadModel('InnerPages');
		$pageData = $this->InnerPages->singleRecord(4);
		$this->set('pageData',$pageData);
	}
	public function searchData(){

		$keyword = strtolower($_REQUEST["term"]);

		if (!$keyword) return;

		$this->loadModel('Products');
		$conditions = array('status' => 1, 'product_name LIKE' => '%'.trim($keyword).'%');
		$items = $this->Products->conditionalRecords($conditions);
		$countRecord = $items->count();
		$html = '[';

		foreach($items as $key => $item):
		$userName = ucwords($item->product_name);
		$userId = $item->id;
		$slug = $item->slug;
		$category = $item->category_id;
		
		$explodeData = explode(',',$category);
		$this->loadModel('Categories');
		$cateSlug = 'cat';
		if(isset($explodeData[0])){
			$cateData = $this->Categories->singleRecord($explodeData[0]);
			$cateSlug = $cateData->slug;
		}
		$html .= '{"id":"'.$userId.'","label":"'.$userName.'","value":"'.$userName.'","slug":"'.$slug.'","cat_slug":"'.$cateSlug.'","type":"Movie"}';
		if(($countRecord -1) != $key){$html .=',';}
		endforeach;
		
		$conditionsDir = array('status' => 1, 'director LIKE' => '%'.trim($keyword).'%');
		$directors = $this->Products->conditionalRecords($conditionsDir);
		$countDirRecord = $directors->count();
		$directorArray = array();
		foreach($directors as $key => $item):
		if(!in_array($item->director,$directorArray)){
			$directorArray[] = $item->director;
			$userName = ucwords($item->director);
			$userId = $item->id;
			$slug = $item->slug;
			$category = $item->category_id;
			
			$explodeData = explode(',',$category);
			$this->loadModel('Categories');
			$cateSlug = 'cat';
			if(isset($explodeData[0])){
				$cateData = $this->Categories->singleRecord($explodeData[0]);
				$cateSlug = $cateData->slug;
			}
			if($countRecord > 0 && $key == 0){$html .=',';}
			
			$html .= '{"id":"'.$userId.'","label":"'.$userName.'","value":"'.$userName.'","slug":"'.$slug.'","cat_slug":"'.$cateSlug.'","type":"Director"}';
			//if(($countDirRecord -1) != $key){$html .=',';}
		}
		endforeach;
		
		/*$conditionsPro = array('status' => 1, 'producer LIKE' => '%'.trim($keyword).'%');
		$producers = $this->Products->conditionalRecords($conditionsPro);
		$countProRecord = $producers->count();
		
		foreach($producers as $key => $item):
		$userName = ucwords($item->producer);
		$userId = $item->id;
		$slug = $item->slug;
		$category = $item->category_id;
		
		$explodeData = explode(',',$category);
		$this->loadModel('Categories');
		$cateSlug = 'cat';
		if(isset($explodeData[0])){
			$cateData = $this->Categories->singleRecord($explodeData[0]);
			$cateSlug = $cateData->slug;
		}

		if(($countRecord > 0 || $countDirRecord > 0) && $key == 0){$html .=',';}
		
		$html .= '{"id":"'.$userId.'","label":"'.$userName.'","value":"'.$userName.'","slug":"'.$slug.'","cat_slug":"'.$cateSlug.'","type":"Producer"}';
		if(($countProRecord -1) != $key){$html .=',';}
		endforeach;*/

		$html .= ']';

		echo($html); die;
	}

	public function getData(){

		$this->loadModel('Users');

		$conditions = array('status' => 1);

		$users = $this->Users->conditionalAllRecord($conditions);

		echo '<pre>'; print_r($users);die;

	}

	public function getLanguage(){



		$keyword = strtolower($_REQUEST["term"]);



		if (!$keyword) return;



		$this->loadModel('Languages');



		$conditions = array('title LIKE' => '%'.trim($keyword).'%');



		$items = $this->Languages->conditionalRecords($conditions);



		$countRecord = $items->count();



		$html = '[';



		foreach($items as $key => $item):



		$userName = ucwords($item->title);



		$userId = $item->id;



		$html .= '{"id":"'.$userId.'","label":"'.$userName.'","value":"'.$userName.'"}';



		if(($countRecord -1) != $key){



			$html .=',';



		}



		endforeach;



		$html .= ']';



		echo($html); die;



	}
	public function sendEmails($emailDataID,$pageNo){
		$this->loadModel('Settings');
		$this->loadModel('NewsletterEmails');
		$setting = $this->Settings->singleRecord(1);
		$newsletterData = $this->NewsletterEmails->singleRecord($emailDataID);
		
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
		
		$conditions3 = array('status' => 1);
		$users = $this->Newsletters->conditionalAllRecordPaging($conditions3,10,$pageNo);
		foreach($users as $key => $user){
			if(filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
				
				$this->loadModel('Users');
				$userCondition = array('email' => $user->email,'type' => 'User');
				$userExistCount = $this->Users->conditionalRecordCount($userCondition);
				if($userExistCount > 0){
					$userData = $this->Users->conditionalSingleRecord($userCondition);
					if($userData->name != ''){
						$username = $userData->name;
					}else{
						$username = $userData->username;
					}
				}else{
					$explodeEmail = explode('@',$user->email);
					$username = '';
					if(isset($explodeEmail[0]) && $explodeEmail[0] != ''){
						$username = $explodeEmail[0];
					}
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
				$email = $user->email;
				$mailer = new Mailer();
				$mailer
				->setEmailFormat('html')
				->setTo($user->email)
				->setCc('info@cinemasthan.com')
				->setSubject($subject)
				->setFrom(['info@cinemasthan.com' => 'Cinemasthan'])
				->set(compact('setting','newsletterData','movieDetails','categoryDetails','homePageData','cateArray','categories','email','username'))
				->viewBuilder()
				->setTemplate('newsletter');
				$mailer->deliver();
			}
		}
		return true;
	}
	public function sendNewsletters(){
		
		$this->loadModel('Settings');
		$setting = $this->Settings->singleRecord(1);
		if($setting->is_cron_active == 1){
			$this->loadModel('NewsletterEmails');
			$this->loadModel('Newsletters');
			$conditions = array('status' => 1,'current_status' => 'InProcess');
			$checkInprocess = $this->NewsletterEmails->conditionalRecordCount($conditions);
			if($checkInprocess > 0){
				$inProcessData = $this->NewsletterEmails->conditionalSingleRecordArray($conditions);
				$limit = 10;
				$conditions3 = array('status' => 1);
				$users = $this->Newsletters->conditionalAllRecordPaging($conditions3,$limit,$inProcessData['page_no']);
				if(count($users) > 0){
					#send email code
					$this->sendEmails($inProcessData['id'],$inProcessData['page_no']);
					$nextPage = $inProcessData['page_no']+1;
					$nextUsers = $this->Newsletters->conditionalAllRecordPaging($conditions3,$limit,$nextPage);
					if(count($nextUsers) > 0){
						$setNewsData['id'] = $inProcessData['id'];
						$setNewsData['current_status'] = 'InProcess';
						$setNewsData['page_no'] = $nextPage;
						$record2 = $this->NewsletterEmails->createRecord($setNewsData);
						echo $inProcessData['id']; die;
					}else{
						$setNewsData['id'] = $inProcessData['id'];
						$setNewsData['current_status'] = 'Completed';
						$setNewsData['status'] = 2;
						$record2 = $this->NewsletterEmails->createRecord($setNewsData);
						echo 'Completed'; die;
					}
				}else{
					$setNewsData['id'] = $inProcessData['id'];
					$setNewsData['current_status'] = 'Completed';
					$setNewsData['status'] = 2;
					$record2 = $this->NewsletterEmails->createRecord($setNewsData);
					echo 'Completed'; die;
				}
				
			}else{
				$conditions2 = array('status' => 1);
				$checkPending = $this->NewsletterEmails->conditionalRecordCount($conditions2);
				
				if($checkPending > 0){
					$pendingData = $this->NewsletterEmails->conditionalSingleRecordArray($conditions2);
					$limit = 10;
					$conditions3 = array('status' => 1);
					$users = $this->Newsletters->conditionalAllRecordPaging($conditions3,$limit,1);
					if(count($users) > 0){
						#send email code
						$this->sendEmails($pendingData['id'],1);
						$nextUsers = $this->Newsletters->conditionalAllRecordPaging($conditions3,$limit,2);
						if(count($nextUsers) > 0){
							$setNewsData['id'] = $pendingData['id'];
							$setNewsData['current_status'] = 'InProcess';
							$setNewsData['page_no'] = 2;
							$record2 = $this->NewsletterEmails->createRecord($setNewsData);
							echo $pendingData['id']; die;
						}else{
							$setNewsData['id'] = $pendingData['id'];
							$setNewsData['current_status'] = 'Completed';
							$setNewsData['status'] = 2;
							$record2 = $this->NewsletterEmails->createRecord($setNewsData);
							echo 'Completed'; die;
						}
					}else{
						$setNewsData['id'] = $pendingData['id'];
						$setNewsData['current_status'] = 'Completed';
						$setNewsData['status'] = 2;
						$record2 = $this->NewsletterEmails->createRecord($setNewsData);
						echo 'Completed'; die;
					}
				}else{echo 'Success'; die;}
			}
		}else{
			echo 'Success'; die;
		}
		
	}



}



