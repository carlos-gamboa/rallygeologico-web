<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Term $term
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Term'), ['action' => 'edit', $term->TermID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Term'), ['action' => 'delete', $term->TermID], ['confirm' => __('Are you sure you want to delete # {0}?', $term->TermID)]) ?> </li>
        <li><?= $this->Html->link(__('List Term'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Term'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="term view large-9 medium-8 columns content">
    <h3><?= h($term->TermID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('ImageUrl') ?></th>
            <td><?= h($term->ImageUrl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('VideoUrl') ?></th>
            <td><?= h($term->VideoUrl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($term->Name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($term->Description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('TermID') ?></th>
            <td><?= $this->Number->format($term->TermID) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Site') ?></h4>
        <?php if (!empty($term->site)): ?>
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
            <?php foreach ($term->site as $site): ?>
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
