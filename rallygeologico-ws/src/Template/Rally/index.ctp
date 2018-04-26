<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rally[]|\Cake\Collection\CollectionInterface $rally
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Rally'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Competition'), ['controller' => 'Competition', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Competition'), ['controller' => 'Competition', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rally index large-9 medium-8 columns content">
    <h3><?= __('Rally') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('points_awarded') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image_url') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rally as $rally): ?>
            <tr>
                <td><?= $this->Number->format($rally->id) ?></td>
                <td><?= h($rally->name) ?></td>
                <td><?= $this->Number->format($rally->points_awarded) ?></td>
                <td><?= h($rally->image_url) ?></td>
                <td><?= h($rally->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rally->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rally->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rally->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rally->id)]) ?>
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
