<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Multimedia $multimedia
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Multimedia'), ['action' => 'edit', $multimedia->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Multimedia'), ['action' => 'delete', $multimedia->id], ['confirm' => __('Are you sure you want to delete # {0}?', $multimedia->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Multimedia'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Multimedia'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Activity'), ['controller' => 'Activity', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['controller' => 'Activity', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Term'), ['controller' => 'Term', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Term'), ['controller' => 'Term', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="multimedia view large-9 medium-8 columns content">
    <h3><?= h($multimedia->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Media Url') ?></th>
            <td><?= h($multimedia->media_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($multimedia->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($multimedia->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Media Type') ?></th>
            <td><?= $this->Number->format($multimedia->media_type) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Activity') ?></h4>
        <?php if (!empty($multimedia->activity)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Site Id') ?></th>
                <th scope="col"><?= __('Activity Type') ?></th>
                <th scope="col"><?= __('Points Awarded') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($multimedia->activity as $activity): ?>
            <tr>
                <td><?= h($activity->id) ?></td>
                <td><?= h($activity->site_id) ?></td>
                <td><?= h($activity->activity_type) ?></td>
                <td><?= h($activity->points_awarded) ?></td>
                <td><?= h($activity->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Activity', 'action' => 'view', $activity->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Activity', 'action' => 'edit', $activity->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Activity', 'action' => 'delete', $activity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activity->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Term') ?></h4>
        <?php if (!empty($multimedia->term)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($multimedia->term as $term): ?>
            <tr>
                <td><?= h($term->id) ?></td>
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
