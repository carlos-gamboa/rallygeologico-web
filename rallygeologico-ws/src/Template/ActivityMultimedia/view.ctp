<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ActivityMultimedia $activityMultimedia
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Activity Multimedia'), ['action' => 'edit', $activityMultimedia->activity_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Activity Multimedia'), ['action' => 'delete', $activityMultimedia->activity_id], ['confirm' => __('Are you sure you want to delete # {0}?', $activityMultimedia->activity_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Activity Multimedia'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity Multimedia'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activity'), ['controller' => 'Activity', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Multimedia'), ['controller' => 'Multimedia', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Multimedia'), ['controller' => 'Multimedia', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="activityMultimedia view large-9 medium-8 columns content">
    <h3><?= h($activityMultimedia->activity_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Activity') ?></th>
            <td><?= $activityMultimedia->has('activity') ? $this->Html->link($activityMultimedia->activity->id, ['controller' => 'Activity', 'action' => 'view', $activityMultimedia->activity->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Multimedia') ?></th>
            <td><?= $activityMultimedia->has('multimedia') ? $this->Html->link($activityMultimedia->multimedia->id, ['controller' => 'Multimedia', 'action' => 'view', $activityMultimedia->multimedia->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($activityMultimedia->id) ?></td>
        </tr>
    </table>
</div>
