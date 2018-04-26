<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\District $district
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit District'), ['action' => 'edit', $district->name]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete District'), ['action' => 'delete', $district->name], ['confirm' => __('Are you sure you want to delete # {0}?', $district->name)]) ?> </li>
        <li><?= $this->Html->link(__('List District'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New District'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Canton'), ['controller' => 'Canton', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Canton'), ['controller' => 'Canton', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="district view large-9 medium-8 columns content">
    <h3><?= h($district->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($district->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Canton') ?></th>
            <td><?= $district->has('canton') ? $this->Html->link($district->canton->name, ['controller' => 'Canton', 'action' => 'view', $district->canton->name]) : '' ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Site') ?></h4>
        <?php if (!empty($district->site)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Points Awarded') ?></th>
                <th scope="col"><?= __('Qr Url') ?></th>
                <th scope="col"><?= __('Details') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Latitude') ?></th>
                <th scope="col"><?= __('Longitude') ?></th>
                <th scope="col"><?= __('District Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($district->site as $site): ?>
            <tr>
                <td><?= h($site->id) ?></td>
                <td><?= h($site->name) ?></td>
                <td><?= h($site->points_awarded) ?></td>
                <td><?= h($site->qr_url) ?></td>
                <td><?= h($site->details) ?></td>
                <td><?= h($site->description) ?></td>
                <td><?= h($site->latitude) ?></td>
                <td><?= h($site->longitude) ?></td>
                <td><?= h($site->district_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Site', 'action' => 'view', $site->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Site', 'action' => 'edit', $site->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Site', 'action' => 'delete', $site->id], ['confirm' => __('Are you sure you want to delete # {0}?', $site->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
