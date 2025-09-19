<table class="table table-bordered table-hover table-striped">
<thead>
    <tr>
        <th>S.No.</th>                                    
        <th>Invoice Id</th>
        <th>Item Name</th>
        <th>Price</th>
        <th>Created</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
    if(count($orders) > 0){
        foreach($orders as $key => $order){
        $itemDetail = $this->Ecommerce->getItemDetails($order->item_id);
    ?>
        <tr>
            <td><?php e($key+$pageNo+1); ?>.</td>
            <td><?php e(isCheckVal($order->invoice_id));?></td>                                        
            <td><?php e(ucwords(isCheckVal($itemDetail->product_name)));?></td>
            <td><?php e(ucwords(isCheckVal($order->price)));?></td>
            <td width="20%"><?php e(date("F jS, Y h:i A",$order->created)); ?></td>
            <td>
            <a href="<?php e($this->Url->build(ADMIN_FOLDER.'/view-order/'.base64_encode($this->encryptData($order->id))));?>" title="View" class="btn btn-primary">View</a>
            </td>
        </tr>
    <?php }
    }else{
    ?>
        <tr>
            <td class="text-center" colspan="6">Records are not found.</td>
        </tr>
    <?php } ?>
</tbody>
<?php if($orders->count() > 0){ ?>
    <tbody>
        <tr>
            <td align="center" colspan="6">
                <ul class="pagination">
                <?php
                $this->Paginator->options(array('update' => '#replaceHtml', 'evalScripts' => true, 'escape' => false, 'url' => array_merge(array('controller' => 'Ecommerce', 'action' => 'ordersFilter'))));?>
                    <?php echo $this->Paginator->first('First'); ?>
                    <?php echo $this->Paginator->numbers(); ?>
                    <?php echo $this->Paginator->last('Last'); ?>
                </ul>
                </td>
            </tr>
        </tbody>
    <?php } ?>
</table>