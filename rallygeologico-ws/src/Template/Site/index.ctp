<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Site[]|\Cake\Collection\CollectionInterface $site
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Site'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List District'), ['controller' => 'District', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New District'), ['controller' => 'District', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Competition Statistics'), ['controller' => 'CompetitionStatistics', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Competition Statistic'), ['controller' => 'CompetitionStatistics', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Rally'), ['controller' => 'Rally', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rally'), ['controller' => 'Rally', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Term'), ['controller' => 'Term', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Term', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="site index large-9 medium-8 columns content">
    <h3><?= __('Site') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('points_awarded') ?></th>
                <th scope="col"><?= $this->Paginator->sort('qr_url') ?></th>
                <th scope="col"><?= $this->Paginator->sort('details') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('latitude') ?></th>
                <th scope="col"><?= $this->Paginator->sort('longitude') ?></th>
                <th scope="col"><?= $this->Paginator->sort('district_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($site as $site): ?>
            <tr>
                <td><?= $this->Number->format($site->id) ?></td>
                <td><?= h($site->name) ?></td>
                <td><?= $this->Number->format($site->points_awarded) ?></td>
                <td><?= h($site->qr_url) ?></td>
                <td><?= h($site->details) ?></td>
                <td><?= h($site->description) ?></td>
                <td><?= $this->Number->format($site->latitude) ?></td>
                <td><?= $this->Number->format($site->longitude) ?></td>
                <td><?= $site->has('district') ? $this->Html->link($site->district->name, ['controller' => 'District', 'action' => 'view', $site->district->name]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $site->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $site->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $site->id], ['confirm' => __('Are you sure you want to delete # {0}?', $site->id)]) ?>
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
