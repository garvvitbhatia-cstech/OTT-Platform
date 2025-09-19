<table class="table table-bordered table-hover table-striped">

<thead>

    <tr>

        <th>S.No.</th>                                    

        <th>Title</th>
        <th>Uploaded By</th>

        <th>Category Name</th>

        <th>Product Price</th>

        <th style="text-align:center;">Status</th>

        <th>Created</th>

        <th>Action</th>

    </tr>

</thead>

<tbody>

    <?php

    if(count($products) > 0){

        foreach($products as $key => $product){

        $isExistProduct = 0;//$this->State->getCityExist($product->id);

        $categoryName = $this->Ecommerce->getCategoryNameById($product->category_id);

    ?>

        <tr>

            <td><?php e($key+1); ?>.</td>

            <td><?php e(isCheckVal($product->product_name));?></td>
            
            <td>
			  <?php 
              if($val->added_by > 0){
                  $userData = $this->User->getSingleRecord($val->added_by);
                  echo '<b>Name: </b>'.$userData->name;
                  echo '<br>';
                  echo '<b>Email: </b>'.$userData->email;
              }else{
                 echo 'Admin'; 
              }
              ?>
              </td>

            <td><?php e(ucwords(isCheckVal($categoryName)));?></td>

            <td><?php e(isCheckVal($product->price));?></td>

            <td style="text-align:center;">

                <?php $status = $product->status == 1 ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times'></i>"; ?>

                <?php $class = $product->status == 1 ? "success" : "danger"; ?>

                <a id="statusBtn_<?= $product->id ?>" <?php if($isExistProduct == 0){ ?> onclick="changeStatus('Products','<?= $this->encryptData($product->id); ?>','<?= $product->status ?>','<?= $product->id; ?>');" <?php } ?> class="btn btn-<?php e($class);?> btn-circle" <?php if($isExistProduct > 0){e('disabled');} ?>><?php e($status);?></a>

                <input type="hidden" id="current_status<?= $product->id ?>" value="<?= $product->status ?>" />

            </td>

            <td width="20%"><?php e(date("F jS, Y h:i A",$product->created)); ?></td>

            <td>

            <a href="<?php e($this->Url->build(ADMIN_FOLDER.'/edit-product/'.base64_encode($this->encryptData($product->id))));?>" title="Edit" class="btn btn-success">Edit</a>

            <a href="javascript:void(0);" onclick="deleteRecord('Products','<?php e(base64_encode($this->encryptData($product->id))); ?>','0');" title="Delete" class="btn btn-danger">Delete</a>

            </td>

        </tr>

    <?php }

    }else{

    ?>

        <tr>

            <td class="text-center" colspan="9">Records are not found.</td>

        </tr>

    <?php } ?>

</tbody>

<?php if($products->count() > 0){ ?>

    <tbody>

        <tr>

            <td align="center" colspan="12">

                <ul class="pagination">

                <?php

                $this->Paginator->options(array('update' => '#replaceHtml', 'evalScripts' => true, 'escape' => false, 'url' => array_merge(array('controller' => 'Ecommerce', 'action' => 'productsFilter'))));?>

                    <?php echo $this->Paginator->first('First'); ?>

                    <?php echo $this->Paginator->numbers(); ?>

                    <?php echo $this->Paginator->last('Last'); ?>

                </ul>

                </td>

            </tr>

        </tbody>

    <?php } ?>

</table>