<?php if($this->Paginator->numbers()!=null): ?>
	<?php if($this->Paginator->numbers()!=null): ?>
	<div class="row">
	   <div class="col-sm-6">
		  <div class="dataTables_info" id="dataTables-example_info" role="alert" aria-live="polite" aria-relevant="all"><?php echo $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}');  ?></div>
	   </div>
	   <div class="col-sm-6">
		  <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
			 <ul class="pagination">
				<?php echo $this->Paginator->first('First', array('tag' => 'li', 'escape' => false), array('class' => 'first', 'tag' => 'li', 'escape' => false)); ?>
				<?php echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a')); ?>
				<?php echo $this->Paginator->last('Last', array('tag' => 'li', 'escape' => false), array('class' => 'last disabled', 'tag' => 'li', 'escape' => false)); ?>
			 </ul>
		  </div>
	   </div>
	</div>
	<?php endif; ?>
<?php endif; ?>