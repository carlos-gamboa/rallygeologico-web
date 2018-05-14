<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Canton[]|\Cake\Collection\CollectionInterface $canton
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Canton'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Province'), ['controller' => 'Province', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Province'), ['controller' => 'Province', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List District'), ['controller' => 'District', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New District'), ['controller' => 'District', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="canton index large-9 medium-8 columns content">
    <h3><?= __('Canton') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('province_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($canton as $canton): ?>
            <tr>
                <td><?= h($canton->name) ?></td>
                <td><?= $canton->has('province') ? $this->Html->link($canton->province->name, ['controller' => 'Province', 'action' => 'view', $canton->province->name]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $canton->name]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $canton->name]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $canton->name], ['confirm' => __('Are you sure you want to delete # {0}?', $canton->name)]) ?>
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
