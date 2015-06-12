<?php $this->beginContent('/layouts/main'); ?>
<div id="content">
    <?php
    $this->widget('bootstrap.widgets.TbMenu', array(
        'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
        'items' => $this->menu,
    ));
    ?>
    <?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>