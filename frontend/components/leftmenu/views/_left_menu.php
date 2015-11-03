<?php

use yii\widgets\Menu;
?>

<div class="box box-solid box-warning left-item">
	<div class="box-header with-border">
		<h3 class="box-title">Menu</h3>
		<div class="box-tools">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body no-padding">
		<?php
		echo Menu::widget([
			'items'   => [
				['label' => 'Dashboard', 'url' => ['client/dashboard']]
			],
			'options' => [
				'class' => 'nav nav-pills nav-stacked',
				'id'    => 'left-menu',
			],
		]);
		?>
	</div><!-- /.box-body -->
</div>