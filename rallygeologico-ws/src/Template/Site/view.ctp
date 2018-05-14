<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Site $site
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Site'), ['action' => 'edit', $site->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Site'), ['action' => 'delete', $site->id], ['confirm' => __('Are you sure you want to delete # {0}?', $site->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Site'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Site'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List District'), ['controller' => 'District', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New District'), ['controller' => 'District', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Competition Statistics'), ['controller' => 'CompetitionStatistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition Statistic'), ['controller' => 'CompetitionStatistics', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rally'), ['controller' => 'Rally', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rally'), ['controller' => 'Rally', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Term'), ['controller' => 'Term', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Term', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="site view large-9 medium-8 columns content">
    <h3><?= h($site->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($site->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Qr Url') ?></th>
            <td><?= h($site->qr_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Details') ?></th>
            <td><?= h($site->details) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($site->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('District') ?></th>
            <td><?= $site->has('district') ? $this->Html->link($site->district->name, ['controller' => 'District', 'action' => 'view', $site->district->name]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($site->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Points Awarded') ?></th>
            <td><?= $this->Number->format($site->points_awarded) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Latitude') ?></th>
            <td><?= $this->Number->format($site->latitude) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Longitude') ?></th>
            <td><?= $this->Number->format($site->longitude) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Competition Statistics') ?></h4>
        <?php if (!empty($site->competition_statistics)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Competition Id') ?></th>
                <th scope="col"><?= __('Starting Date') ?></th>
                <th scope="col"><?= __('Finishing Date') ?></th>
                <th scope="col"><?= __('Points') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($site->competition_statistics as $competitionStatistics): ?>
            <tr>
                <td><?= h($competitionStatistics->user_id) ?></td>
                <td><?= h($competitionStatistics->competition_id) ?></td>
                <td><?= h($competitionStatistics->starting_date) ?></td>
                <td><?= h($competitionStatistics->finishing_date) ?></td>
                <td><?= h($competitionStatistics->points) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CompetitionStatistics', 'action' => 'view', $competitionStatistics->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CompetitionStatistics', 'action' => 'edit', $competitionStatistics->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CompetitionStatistics', 'action' => 'delete', $competitionStatistics->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $competitionStatistics->user_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Rally') ?></h4>
        <?php if (!empty($site->rally)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Points Awarded') ?></th>
                <th scope="col"><?= __('Image Url') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($site->rally as $rally): ?>
            <tr>
                <td><?= h($rally->id) ?></td>
                <td><?= h($rally->name) ?></td>
                <td><?= h($rally->points_awarded) ?></td>
                <td><?= h($rally->image_url) ?></td>
                <td><?= h($rally->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Rally', 'action' => 'view', $rally->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Rally', 'action' => 'edit', $rally->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Rally', 'action' => 'delete', $rally->id], ['confirm' => __('Are you sure you want to delete # {0}?', $rally->id)]) ?>
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
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Image Url') ?></th>
                <th scope="col"><?= __('Video Url') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($site->term as $term): ?>
            <tr>
                <td><?= h($term->id) ?></td>
                <td><?= h($term->image_url) ?></td>
                <td><?= h($term->video_url) ?></td>
                <td><?= h($term->name) ?></td>
                <td><?= h($term->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Term', 'action' => 'view', $term->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Term', 'action' => 'edit', $term->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Term', 'action' => 'delete', $term->id], ['confirm' => __('Are you sure you want to delete # {0}?', $term->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
