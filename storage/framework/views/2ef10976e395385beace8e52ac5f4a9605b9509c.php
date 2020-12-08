

    <style>

/*****************globals*************/


img {
  max-width: 100%; }

.preview {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }
  @media  screen and (max-width: 996px) {
    .preview {
      margin-bottom: 20px; } }

.preview-pic {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.preview-thumbnail.nav-tabs {
  border: none;
  margin-top: 15px; }
  .preview-thumbnail.nav-tabs li {
    width: 18%;
    margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
      max-width: 100%;
      display: block; }
    .preview-thumbnail.nav-tabs li a {
      padding: 0;
      margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
      margin-right: 0; }

.tab-content {
  overflow: hidden; }
  .tab-content img {
    width: 100%;
    -webkit-animation-name: opacity;
            animation-name: opacity;
    -webkit-animation-duration: .3s;
            animation-duration: .3s; }

/* .card {
  margin-top: 50px;
  background: #eee;
  padding: 3em;
  line-height: 1.5em; } */

@media  screen and (min-width: 997px) {
  .wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex; } }

.details {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }

.colors {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.product-title, .price, .sizes, .colors {
  text-transform: UPPERCASE;
  font-weight: bold; }

.checked, .price span {
  color: #ff9f1a; }

.product-title, .rating, .product-description, .price, .vote, .sizes {
  margin-bottom: 15px; }

.product-title {
  margin-top: 0; }

.size {
  margin-right: 10px; }
  .size:first-of-type {
    margin-left: 40px; }

.color {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
  height: 2em;
  width: 2em;
  border-radius: 2px; }
  .color:first-of-type {
    margin-left: 20px; }

.add-to-cart, .like {
  background: #ff9f1a;
  padding: 1.2em 1.5em;
  border: none;
  text-transform: UPPERCASE;
  font-weight: bold;
  color: #fff;
  -webkit-transition: background .3s ease;
          transition: background .3s ease; }
  .add-to-cart:hover, .like:hover {
    background: #b36800;
    color: #fff; }

.not-available {
  text-align: center;
  line-height: 2em; }
  .not-available:before {
    font-family: fontawesome;
    content: "\f00d";
    color: #fff; }

.orange {
  background: #ff9f1a; }

  .textorange {
  color: #ff9f1a; }

.green {
  background: #85ad00; }
  .textgreen {
  color: #85ad00; }
  .textred {
  color: #ff0000; }

.blue {
  background: #0076ad; }

  .textblue {
  color: #0076ad; }

.tooltip-inner {
  padding: 1.3em; }

  .details h4{
    font-size: 1rem;
  }
  .details h4 span{
    font-weight: 400;
  }

@-webkit-keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes  opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

/*# sourceMappingURL=style.css.map */

    </style>


<html>


				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">

                            <?php for($i = 0; $i < count($images); $i++): ?>
                             <div class="tab-pane <?php if($i==0){ echo "active";} $n=$i+1; ?>" id="pic-<?php echo e($n); ?>"><img src="<?php echo e(url("public/images/product")."/".$images[$i]); ?>" /></div>
                        <?php endfor; ?>
						 
					
						</div>
                        <ul class="preview-thumbnail nav nav-tabs">
                            <?php for($i = 0; $i < count($images); $i++): ?>

                            <li class="<?php if($i==0){ echo "active";} $n=$i+1; ?>"><a data-target="#pic-<?php echo e($n); ?>" data-toggle="tab"><img src="<?php echo e(url("public/images/product")."/".$images[$i]); ?>" /></a></li>

                        <?php endfor; ?>
						  
						</ul>
						
					</div>
					<div class="details col-md-6">
						<h3 class="product-title"><?php echo e($product->name); ?></h3>
                        
                        <div class="product-description">
                            <?php echo $product->product_details; ?>

                            </div>
                           

<h4>CODE : <span><?php echo e($product->code); ?></span></h4>
<h4><?php echo e(__('file.category')); ?> : <span><?php echo e($product->category['name']); ?></span></h4>
<h4><?php echo e(__('file.Type')); ?> : <span><?php echo e($product->category['cate_type']); ?></span></h4>
<h4>Min price : <span class="textorange"><?php echo e($product->price); ?></span></h4>
<h4>Stock : <span class="<?php if($product->qty>0){ echo "textgreen";}else{ echo "textred"; } ?>"><?php echo e($product->qty); ?></span></h4>
<h4><?php echo e(__('file.Unit')); ?> : <span><?php echo e($product->unit['unit_name']); ?></span></h4>



						<div class="action">
							<button class="add-to-cart btn btn-default" type="button" data-code="<?php echo e($product->code); ?>" data-price="<?php echo e($product->price); ?>" data-stock="<?php echo e($product->qty); ?>" data-productid="<?php echo e($product->id); ?>" data-addqty="1">add to cart</button>
	
						</div>
					</div>
                </div>
                
        

                </html>