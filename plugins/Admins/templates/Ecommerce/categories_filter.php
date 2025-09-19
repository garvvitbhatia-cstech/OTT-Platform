<table class="table table-bordered table-hover table-striped">
<thead>
    <tr>
        <th>S.No.</th>
        <th>Category Name</th>
        <th>Category Icon</th>
        <th style="text-align:center;">Status</th>
        <th>Created</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
    if(count($categories) > 0){
        foreach($categories as $key => $category){
        $isExist = $this->Ecommerce->getCategoryExist($category->id);
        $rootCategoryName = '';
        if($category->parent_id > 0){
            $rootCategoryName = $this->Ecommerce->getCategoryNameById($category->parent_id);
        }
    ?>
            <tr>
                <td><?php e($key+1); ?>.</td>
                <td><?php e($rootCategoryName); ?>-><?php e(ucwords(isCheckVal($category->name)));?></td>
                <td>
                <?php
                if($category->icon != ""){
                    $imgPath = WWW_ROOT.'img/categories/'.$category->icon;
                    if(is_file($imgPath) && file_exists($imgPath)){
                        e($this->Html->image('categories/'.$category->icon, array('title'=>$category->name, 'alt'=> $category->name, 'width' => '50' )));
                    }else{
                        e(isCheckVal());
                    }
                }else{
                    e(isCheckVal());
                } ?>
                </td>
                
                <td style="text-align:center;">
                    <?php $status = $category->status == 1 ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times'></i>"; ?>
                    <?php $class = $category->status == 1 ? "success" : "danger"; ?>
                    <a id="statusBtn_<?= $category->id ?>" <?php if($isExist == 0){ ?> onclick="changeStatus('Categories','<?= $this->encryptData($category->id); ?>','<?= $category->status ?>','<?= $category->id; ?>');" <?php } ?> class="btn btn-<?php e($class);?> btn-circle" <?php if($isExist > 0){e('disabled');} ?>><?php e($status);?></a>
                    <input type="hidden" id="current_status<?= $category->id ?>" value="<?= $category->status ?>" />
                </td>
                <td width="20%"><?php e(date("F jS, Y h:i A",$category->created)); ?></td>
                <td><a href="<?php e($this->Url->build(ADMIN_FOLDER.'/edit-category/'.base64_encode($this->encryptData($category->id))));?>" title="Edit" class="btn btn-success">Edit</a>
                <?php if($isExist == 0){ ?>
                <a href="javascript:void(0);" onclick="deleteRecord('Categories','<?php e(base64_encode($this->encryptData($category->id))); ?>','0');" title="Delete" class="btn btn-danger">Delete</a>
                <?php } ?>
                </td>
            </tr>
    <?php
        }
    }else{
    ?>
        <tr>
            <td class="text-center" colspan="10">Records are not found.</td>
        </tr>
    <?php } ?>
</tbody>
<?php if($categories->count() > 0){ ?>
    <tbody>
        <tr>
            <td align="center" colspan="12">
                <ul class="pagination">
                    <?php
                    $this->Paginator->options(array('update' => '#replaceHtml', 'evalScripts' => true, 'escape' => false, 'url' => array_merge(array('controller' => 'Locations', 'action' => 'categoriesFilter'))));?>
                        <?php echo $this->Paginator->first('First'); ?>
                        <?php echo $this->Paginator->numbers(); ?>
                        <?php echo $this->Paginator->last('Last'); ?>
                    </ul>
                </td>
            </tr>
        </tbody>
    <?php } ?>
</table>