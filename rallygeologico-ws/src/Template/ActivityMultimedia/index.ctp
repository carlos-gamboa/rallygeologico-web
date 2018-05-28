<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ActivityMultimedia[]|\Cake\Collection\CollectionInterface $activityMultimedia
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Activity Multimedia'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Activity'), ['controller' => 'Activity', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Multimedia'), ['controller' => 'Multimedia', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Multimedia'), ['controller' => 'Multimedia', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="activityMultimedia index large-9 medium-8 columns content">
    <h3><?= __('Activity Multimedia') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('activity_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('multimedia_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activityMultimedia as $activityMultimedia): ?>
            <tr>
                <td><?= $activityMultimedia->has('activity') ? $this->Html->link($activityMultimedia->activity->id, ['controller' => 'Activity', 'action' => 'view', $activityMultimedia->activity->id]) : '' ?></td>
                <td><?= $activityMultimedia->has('multimedia') ? $this->Html->link($activityMultimedia->multimedia->id, ['controller' => 'Multimedia', 'action' => 'view', $activityMultimedia->multimedia->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $activityMultimedia->activity_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $activityMultimedia->activity_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $activityMultimedia->activity_id], ['confirm' => __('Are you sure you want to delete # {0}?', $activityMultimedia->activity_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
