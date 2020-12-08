<ul class="cbp_tmtimeline">
    <?php $__currentLoopData = $ordertimeline; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timeline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li>
  
        <time class="cbp_tmtime" datetime="<?php echo e($timeline->timelinedate); ?>"><span>      <?php echo e(date('H:i', strtotime($timeline->timelinedate))); ?></span> <span>      <?php echo e(date('j F, Y', strtotime($timeline->timelinedate))); ?></span></time>
        <div class="cbp_tmicon" style="background:<?php echo e($timeline->color); ?>;color:#fff"><i class="fas fa-<?php echo e($timeline->icon); ?>"></i></div>
        <div class="cbp_tmlabel"><h2><?php echo e($timeline->timeline_remark); ?></h2>
            <?php if(!empty($timeline->remark)): ?>
            <?php
                $timelinetxt = unserialize($timeline->remark);
            ?>
            <?php endif; ?>
        
            <div class="timelinetext"><?php echo e($timelinetxt['message']); ?></div>
            <div class="timelinefile"> <a target="_blank" href="<?php echo e(url('public/documents/orders',$timeline->order_id)); ?>/<?php echo e($timelinetxt['pdf']); ?>">
                <img src="<?php echo e(asset('assets/images/pdf.png')); ?>" alt=""></a></div>
        </div>
    </li>   
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>