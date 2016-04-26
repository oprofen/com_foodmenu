<?php
defined('_JEXEC') or die;
?>
<div class="col-xs-12 <?php echo $this->pageclass_sfx; ?>" style="backgroun-image:">
    
<div class="page-header">
			<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
</div>
  <div class="col-xs-12 col-sm-10 col-sm-offset-1">
<div class="panel-group" id="accordionMenu" role="tablist" aria-multiselectable="true">
    <?php 
    $count_array = 0;
    foreach ($this->items as $item) : ?>
    
  <div class="panel panel-warning<?php if($item->description) :?>">
      <div class="panel-heading">
           <h4 class="panel-title">
      <a data-toggle="collapse" data-parent="#accordionMenu" href="#<?php echo $item->title; ?>">
        <?php echo $item->title; ?>&nbsp;<?php if($item->price) {echo '$'.$item->price;} ?>
      </a>
        </h4>
          </div>
       <div id="<?php echo $item->title; ?>" class="panel-collapse collapse <?php if(!$count_array){echo 'in'; $count_array++;}?>">
      
           <div class="panel-body">
        <?php if($item->image) {echo '<img style="width:30%" src="' . $item->image . '" class="img-rounded">';} ?><?php echo $item->description; ?>
      </div>
        </div>
           
         
        <?php else :?> accordion-empty">
      <?php echo $item->title; ?>&nbsp;<?php if($item->price) {echo '$'.$item->price;} ?>
        <?php endif; ?>
    
    
  </div>
    <?php    endforeach;    ?>
</div>
    </div>
 </div>
