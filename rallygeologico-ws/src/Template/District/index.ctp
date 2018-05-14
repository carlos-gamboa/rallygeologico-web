<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\District[]|\Cake\Collection\CollectionInterface $district
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New District'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Canton'), ['controller' => 'Canton', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Canton'), ['controller' => 'Canton', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="district index large-9 medium-8 columns content">
    <h3><?= __('District') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('canton_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($district as $district): ?>
            <tr>
                <td><?= h($district->name) ?></td>
                <td><?= $district->has('canton') ? $this->Html->link($district->canton->name, ['controller' => 'Canton', 'action' => 'view', $district->canton->name]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $district->name]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $district->name]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $district->name], ['confirm' => __('Are you sure you want to delete # {0}?', $district->name)]) ?>
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
