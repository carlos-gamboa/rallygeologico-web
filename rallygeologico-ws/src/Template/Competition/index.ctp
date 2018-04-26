<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Competition[]|\Cake\Collection\CollectionInterface $competition
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Competition'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rally'), ['controller' => 'Rally', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rally'), ['controller' => 'Rally', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Competition Statistics'), ['controller' => 'CompetitionStatistics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Competition Statistic'), ['controller' => 'CompetitionStatistics', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Competition Statistics Site'), ['controller' => 'CompetitionStatisticsSite', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Competition Statistics Site'), ['controller' => 'CompetitionStatisticsSite', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Invitation'), ['controller' => 'Invitation', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Invitation'), ['controller' => 'Invitation', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="competition index large-9 medium-8 columns content">
    <h3><?= __('Competition') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('starting_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('finishing_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_public') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rally_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($competition as $competition): ?>
            <tr>
                <td><?= $this->Number->format($competition->id) ?></td>
                <td><?= h($competition->is_active) ?></td>
                <td><?= h($competition->starting_date) ?></td>
                <td><?= h($competition->finishing_date) ?></td>
                <td><?= h($competition->is_public) ?></td>
                <td><?= h($competition->Name) ?></td>
                <td><?= $competition->has('rally') ? $this->Html->link($competition->rally->name, ['controller' => 'Rally', 'action' => 'view', $competition->rally->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $competition->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $competition->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $competition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $competition->id)]) ?>
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
