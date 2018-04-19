<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rally $rally
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Rally'), ['action' => 'edit', $rally->RallyId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rally'), ['action' => 'delete', $rally->RallyId], ['confirm' => __('Are you sure you want to delete # {0}?', $rally->RallyId)]) ?> </li>
        <li><?= $this->Html->link(__('List Rally'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rally'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rally view large-9 medium-8 columns content">
    <h3><?= h($rally->RallyId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($rally->Name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ImageUrl') ?></th>
            <td><?= h($rally->ImageUrl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($rally->Description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('RallyId') ?></th>
            <td><?= $this->Number->format($rally->RallyId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PointsAwarded') ?></th>
            <td><?= $this->Number->format($rally->PointsAwarded) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Site') ?></h4>
        <?php if (!empty($rally->site)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('SiteId') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('PointsAwarded') ?></th>
                <th scope="col"><?= __('QrUrl') ?></th>
                <th scope="col"><?= __('Details') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Latitude') ?></th>
                <th scope="col"><?= __('Longitude') ?></th>
                <th scope="col"><?= __('ProvinceName') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rally->site as $site): ?>
            <tr>
                <td><?= h($site->SiteId) ?></td>
                <td><?= h($site->Name) ?></td>
                <td><?= h($site->PointsAwarded) ?></td>
                <td><?= h($site->QrUrl) ?></td>
                <td><?= h($site->Details) ?></td>
                <td><?= h($site->Description) ?></td>
                <td><?= h($site->Latitude) ?></td>
                <td><?= h($site->Longitude) ?></td>
                <td><?= h($site->ProvinceName) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Site', 'action' => 'view', $site->SiteId]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Site', 'action' => 'edit', $site->SiteId]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Site', 'action' => 'delete', $site->SiteId], ['confirm' => __('Are you sure you want to delete # {0}?', $site->SiteId)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
