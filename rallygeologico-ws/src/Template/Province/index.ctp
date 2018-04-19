<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Province[]|\Cake\Collection\CollectionInterface $province
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Province'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="province index large-9 medium-8 columns content">
    <h3><?= __('Province') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CantonName') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($province as $province): ?>
            <tr>
                <td><?= h($province->Name) ?></td>
                <td><?= h($province->CantonName) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $province->Name]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $province->Name]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $province->Name], ['confirm' => __('Are you sure you want to delete # {0}?', $province->Name)]) ?>
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
