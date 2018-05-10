<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Option[]|\Cake\Collection\CollectionInterface $options
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Option'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Activity'), ['controller' => 'Activity', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="options index large-9 medium-8 columns content">
    <h3><?= __('Options') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('activity_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_correct') ?></th>
                <th scope="col"><?= $this->Paginator->sort('option_text') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($options as $option): ?>
            <tr>
                <td><?= $this->Number->format($option->id) ?></td>
                <td><?= $option->has('activity') ? $this->Html->link($option->activity->id, ['controller' => 'Activity', 'action' => 'view', $option->activity->id]) : '' ?></td>
                <td><?= h($option->is_correct) ?></td>
                <td><?= h($option->option_text) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $option->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $option->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $option->id], ['confirm' => __('Are you sure you want to delete # {0}?', $option->id)]) ?>
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
