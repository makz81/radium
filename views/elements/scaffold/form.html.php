<?php
$binding = $this->form->binding();
$model = $binding->model();
$tabs = $model::renderLayout();
$schema = $binding->schema();
$fields = $schema->names();
$meta = array('status', 'type', 'name', 'slug', 'notes', 'config_id', '_id');
$skip = isset($skip)
	? $skip
	: array('created', 'updated', 'deleted');
$readonly = isset($readonly)
	? $readonly
	: array();
if (!empty($tabs)) {
	echo $this->_render('element', '/scaffold/form.tabs', compact('tabs', 'fields', 'skip', 'readonly'));
	return;
}
?>
<div class="row">

	<div class="col-md-4">
		<h3><?= $this->scaffold->human ?> meta</h3>
		<div class="well">
			<div class="form-group">
				<?= $this->scaffold->render('form.meta', compact('skip', 'readonly')); ?>
			</div>
		</div>
	</div>

	<div class="col-md-8">
		<h3><?= $this->scaffold->human ?> details</h3>
		<div class="well">
			<div class="form-group">
				<?php $fields = $schema->names(); $skip = array_merge($skip, $meta); ?>
				<?= $this->scaffold->render('form.fields', compact('fields', 'skip', 'readonly')); ?>
			</div>
		</div>
	</div>

</div>