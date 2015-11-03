<?php
use common\models\Activity;
?>


	<?php foreach ($timelines as $timeline): ?>
	<li class="first_li" max='<?= $timeline->id ?>'><i class="fa <?= $timeline->type == Activity::TYPE_NEW_PAYMENT ? 'fa-money' : 'fa-user' ?> bg-aqua"></i>
		<div class="timeline-item">
			<span class="time"><i class="fa fa-clock-o"></i> At <?= date('H:i:sa', $timeline->created_time) ?></span>
			<h3 class="timeline-header no-border">
				<a href="<?= \yii\helpers\Url::to([$timeline->getUser()->isClient() ? '/client/view' : '/worker/view', 'id' => $timeline->getUser()->id]) ?>">
					<?= $timeline->getUser()->getFullname() ?>
				</a> <?= $timeline->note ?>
			</h3>
		</div>
	</li>
	<?php endforeach; ?>
	
