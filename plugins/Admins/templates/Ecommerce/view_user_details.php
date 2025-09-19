<td colspan="10">

    <div class="row">
    
        <div class="col-md-12 col-lg-12 col-xs-12" style="padding-left:30px;">
            
            <h4 class="heading-top">User Details:</h4>
         	<?php if($userDetails->count() > 0){ ?>
      
            	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                       <tr>
                          <th>S. No.</th>  
                          <th>Name</th>  
                          <th>Email</th>  
                          <th>Contact</th> 
                          <th>Video Duration</th> 
                          <th>Watch Time</th>                              
                       </tr>
                    </thead>
                    <tbody>
            <?php			
				foreach($userDetails as $key => $user){
				$result = $this->User->getSingleRecord($user->user_id);
				$duration = $this->Ecommerce->setTimeFormating($user->duration);
			?>     
                           
               <tr class="odd gradeX">                    
                  <td><?php echo $key+1; ?></td>                  
                  <td><?php echo ucwords(isCheckVal($result->name)); ?></td>                  
                  <td><?php echo ucwords(isCheckVal($result->email)); ?></td>
                  <td><?php echo ucwords(isCheckVal($result->contact)); ?></td>
                  <td><?php echo $videoDetails->hours.'H:'.$videoDetails->minutes.'M'; ?></td>
                  <td><?php echo $duration; ?></td>
               </tr>                
            <?php } echo '</tbody>
                     </table></div>'; } ?>            
            
       
            
    </div>
    
</td>
   
<style>
	.heading-top {
		text-decoration: none;
		font-size: 18px;
		background-color: #00b0e4;
		padding: 8px 0 8px 8px;
		color: #fff;
		margin-top: 8px;
	}
	.heading_text_style {
		display: inline-block;
		font-size: 16px;
		width: 20%;
		padding: 0 0 0 10px;

	}
	.name_style {
		width: 60%;
		display: inline-block;
		padding-left: 15px;
		font-size: 14px;
	}
</style>

<?php die; ?>