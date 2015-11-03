<div class="box box-solid box-warning left-item">
	<div class="box-header with-border">
		<h3 class="box-title">Account Information</h3>
		<div class="box-tools">
			<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li><a style="color:#000">Email: <?= Yii::$app->user->identity->email; ?></a></li>
		</ul>
	</div><!-- /.box-body -->
</div>