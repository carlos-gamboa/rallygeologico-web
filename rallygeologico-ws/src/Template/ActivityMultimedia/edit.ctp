<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ActivityMultimedia $activityMultimedia
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $activityMultimedia->activity_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $activityMultimedia->activity_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Activity Multimedia'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Activity'), ['controller' => 'Activity', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Multimedia'), ['controller' => 'Multimedia', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Multimedia'), ['controller' => 'Multimedia', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="activityMultimedia form large-9 medium-8 columns content">
    <?= $this->Form->create($activityMultimedia) ?>
    <fieldset>
        <legend><?= __('Edit Activity Multimedia') ?></legend>
        <?php
            echo $this->Form->control('id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
