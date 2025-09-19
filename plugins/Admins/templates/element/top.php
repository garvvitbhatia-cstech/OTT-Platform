<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
   <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <?= $this->Html->link('Admin', ['controller'=>'Users', 'action'=>'index'],['class'=>'navbar-brand']); ?>
   </div>
   <div style="color: white;
      padding: 15px 50px 5px 50px;
      float: right;
      font-size: 16px;"> &nbsp; <button class="btn btn-danger" data-toggle="modal" data-target="#modelLogout">Logout</button></div>
</nav>

<div class="modal fade in" id="modelLogout" tabindex="-1" role="dialog" aria-labelledby="modelLogoutLabel" aria-hidden="false" style="display: none;">
<div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #287ebc;margin: 0 0 5px;border: none;padding: 10px 15px;text-align: center;">
                <h4 class="modal-title" id="modelLogoutLabel" style="color: #fff;">ALERT!</h4>
            </div>
            <div class="modal-body text-center">
            	Are you sure want to logout?
            </div>
            <div class="modal-footer text-center">                
                <?= $this->Html->link('Yes', ['controller'=>'Users','action' => 'logout'],['class'=>'btn btn-primary']); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade in" id="Error500" tabindex="-1" role="dialog" aria-labelledby="modelLogoutLabel" aria-hidden="false" style="display: none;">
<div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #287ebc;margin: 0 0 5px;border: none;padding: 10px 15px;text-align: center;">
                <h4 class="modal-title" id="modelLogoutLabel" style="color: #fff;">ALERT!</h4>
            </div>
            <div class="modal-body text-center" id="errorMsgPopUp">
            	Something went wrong. Please try again.
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>