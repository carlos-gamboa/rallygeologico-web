<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Site $site
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Site'), ['action' => 'edit', $site->SiteId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Site'), ['action' => 'delete', $site->SiteId], ['confirm' => __('Are you sure you want to delete # {0}?', $site->SiteId)]) ?> </li>
        <li><?= $this->Html->link(__('List Site'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Site'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rally'), ['controller' => 'Rally', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rally'), ['controller' => 'Rally', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Term'), ['controller' => 'Term', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Term', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="site view large-9 medium-8 columns content">
    <h3><?= h($site->SiteId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($site->Name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('QrUrl') ?></th>
            <td><?= h($site->QrUrl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Details') ?></th>
            <td><?= h($site->Details) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($site->Description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('ProvinceName') ?></th>
            <td><?= h($site->ProvinceName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('SiteId') ?></th>
            <td><?= $this->Number->format($site->SiteId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('PointsAwarded') ?></th>
            <td><?= $this->Number->format($site->PointsAwarded) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Latitude') ?></th>
            <td><?= $this->Number->format($site->Latitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Longitude') ?></th>
            <td><?= $this->Number->format($site->Longitude) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Rally') ?></h4>
        <?php if (!empty($site->rally)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('RallyId') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('PointsAwarded') ?></th>
                <th scope="col"><?= __('ImageUrl') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($site->rally as $rally): ?>
            <tr>
                <td><?= h($rally->RallyId) ?></td>
                <td><?= h($rally->Name) ?></td>
                <td><?= h($rally->PointsAwarded) ?></td>
                <td><?= h($rally->ImageUrl) ?></td>
                <td><?= h($rally->Description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Rally', 'action' => 'view', $rally->RallyId]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Rally', 'action' => 'edit', $rally->RallyId]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rally', 'action' => 'delete', $rally->RallyId], ['confirm' => __('Are you sure you want to delete # {0}?', $rally->RallyId)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Term') ?></h4>
        <?php if (!empty($site->term)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('TermID') ?></th>
                <th scope="col"><?= __('ImageUrl') ?></th>
                <th scope="col"><?= __('VideoUrl') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($site->term as $term): ?>
            <tr>
                <td><?= h($term->TermID) ?></td>
                <td><?= h($term->ImageUrl) ?></td>
                <td><?= h($term->VideoUrl) ?></td>
                <td><?= h($term->Name) ?></td>
                <td><?= h($term->Description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Term', 'action' => 'view', $term->TermID]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Term', 'action' => 'edit', $term->TermID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Term', 'action' => 'delete', $term->TermID], ['confirm' => __('Are you sure you want to delete # {0}?', $term->TermID)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
