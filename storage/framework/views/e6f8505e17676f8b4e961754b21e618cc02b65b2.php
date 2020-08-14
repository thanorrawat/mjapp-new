Hello <i><?php echo e($demo->receiver); ?></i>,
<p>This is a demo email for testing purposes! Also, it's the HTML version.</p>
 
<p><u>Demo object values:</u></p>
 
<div>
<p><b>Demo One:</b>&nbsp;<?php echo e($demo->demo_one); ?></p>
<p><b>Demo Two:</b>&nbsp;<?php echo e($demo->demo_two); ?></p>
</div>
 
<p><u>Values passed by With method:</u></p>
 
<div>
<p><b>testVarOne:</b>&nbsp;<?php echo e($testVarOne); ?></p>
<p><b>testVarTwo:</b>&nbsp;<?php echo e($testVarTwo); ?></p>
</div>
 
Thank You,
<br/>
<i><?php echo e($demo->sender); ?></i>