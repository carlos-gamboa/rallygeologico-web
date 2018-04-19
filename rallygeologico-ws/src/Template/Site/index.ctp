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
                <th scope="col"><?= $this->Paginator->sort('SiteId') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('PointsAwarded') ?></th>
                <th scope="col"><?= $this->Paginator->sort('QrUrl') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Details') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Latitude') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Longitude') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ProvinceName') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($site as $site): ?>
            <tr>
                <td><?= $this->Number->format($site->SiteId) ?></td>
                <td><?= h($site->Name) ?></td>
                <td><?= $this->Number->format($site->PointsAwarded) ?></td>
                <td><?= h($site->QrUrl) ?></td>
                <td><?= h($site->Details) ?></td>
                <td><?= h($site->Description) ?></td>
                <td><?= $this->Number->format($site->Latitude) ?></td>
                <td><?= $this->Number->format($site->Longitude) ?></td>
                <td><?= h($site->ProvinceName) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $site->SiteId]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $site->SiteId]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $site->SiteId], ['confirm' => __('Are you sure you want to delete # {0}?', $site->SiteId)]) ?>
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
