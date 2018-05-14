<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Rally $rally
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Rally'), ['action' => 'edit', $rally->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rally'), ['action' => 'delete', $rally->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rally->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rally'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rally'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Competition'), ['controller' => 'Competition', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition'), ['controller' => 'Competition', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rally view large-9 medium-8 columns content">
    <h3><?= h($rally->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($rally->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image Url') ?></th>
            <td><?= h($rally->image_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($rally->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($rally->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Points Awarded') ?></th>
            <td><?= $this->Number->format($rally->points_awarded) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Site') ?></h4>
        <?php if (!empty($rally->site)): ?>
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
            <?php foreach ($rally->site as $site): ?>
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
    <div class="related">
        <h4><?= __('Related Competition') ?></h4>
        <?php if (!empty($rally->competition)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Starting Date') ?></th>
                <th scope="col"><?= __('Finishing Date') ?></th>
                <th scope="col"><?= __('Is Public') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Rally Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($rally->competition as $competition): ?>
            <tr>
                <td><?= h($competition->id) ?></td>
                <td><?= h($competition->is_active) ?></td>
                <td><?= h($competition->starting_date) ?></td>
                <td><?= h($competition->finishing_date) ?></td>
                <td><?= h($competition->is_public) ?></td>
                <td><?= h($competition->Name) ?></td>
                <td><?= h($competition->rally_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Competition', 'action' => 'view', $competition->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Competition', 'action' => 'edit', $competition->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Competition', 'action' => 'delete', $competition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $competition->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
