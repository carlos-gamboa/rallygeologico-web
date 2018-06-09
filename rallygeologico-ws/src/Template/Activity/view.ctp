<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activity $activity
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Activity'), ['action' => 'edit', $activity->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Activity'), ['action' => 'delete', $activity->id], ['confirm' => __('Are you sure you want to delete # {0}?', $activity->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Activity'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Activity'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Site'), ['controller' => 'Site', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Site'), ['controller' => 'Site', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Options'), ['controller' => 'Options', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Option'), ['controller' => 'Options', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Multimedia'), ['controller' => 'Multimedia', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Multimedia'), ['controller' => 'Multimedia', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Competition Statistics'), ['controller' => 'CompetitionStatistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition Statistic'), ['controller' => 'CompetitionStatistics', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="activity view large-9 medium-8 columns content">
    <h3><?= h($activity->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Site') ?></th>
            <td><?= $activity->has('site') ? $this->Html->link($activity->site->name, ['controller' => 'Site', 'action' => 'view', $activity->site->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($activity->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($activity->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($activity->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Activity Type') ?></th>
            <td><?= $this->Number->format($activity->activity_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Points Awarded') ?></th>
            <td><?= $this->Number->format($activity->points_awarded) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Multimedia') ?></h4>
        <?php if (!empty($activity->multimedia)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Media Type') ?></th>
                <th scope="col"><?= __('Media Url') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($activity->multimedia as $multimedia): ?>
            <tr>
                <td><?= h($multimedia->id) ?></td>
                <td><?= h($multimedia->media_type) ?></td>
                <td><?= h($multimedia->media_url) ?></td>
                <td><?= h($multimedia->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Multimedia', 'action' => 'view', $multimedia->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Multimedia', 'action' => 'edit', $multimedia->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Multimedia', 'action' => 'delete', $multimedia->id], ['confirm' => __('Are you sure you want to delete # {0}?', $multimedia->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Competition Statistics') ?></h4>
        <?php if (!empty($activity->competition_statistics)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Competition Id') ?></th>
                <th scope="col"><?= __('Starting Date') ?></th>
                <th scope="col"><?= __('Finishing Date') ?></th>
                <th scope="col"><?= __('Points') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($activity->competition_statistics as $competitionStatistics): ?>
            <tr>
                <td><?= h($competitionStatistics->id) ?></td>
                <td><?= h($competitionStatistics->user_id) ?></td>
                <td><?= h($competitionStatistics->competition_id) ?></td>
                <td><?= h($competitionStatistics->starting_date) ?></td>
                <td><?= h($competitionStatistics->finishing_date) ?></td>
                <td><?= h($competitionStatistics->points) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CompetitionStatistics', 'action' => 'view', $competitionStatistics->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CompetitionStatistics', 'action' => 'edit', $competitionStatistics->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CompetitionStatistics', 'action' => 'delete', $competitionStatistics->id], ['confirm' => __('Are you sure you want to delete # {0}?', $competitionStatistics->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Options') ?></h4>
        <?php if (!empty($activity->options)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Activity Id') ?></th>
                <th scope="col"><?= __('Is Correct') ?></th>
                <th scope="col"><?= __('Option Text') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($activity->options as $options): ?>
            <tr>
                <td><?= h($options->id) ?></td>
                <td><?= h($options->activity_id) ?></td>
                <td><?= h($options->is_correct) ?></td>
                <td><?= h($options->option_text) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Options', 'action' => 'view', $options->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Options', 'action' => 'edit', $options->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Options', 'action' => 'delete', $options->id], ['confirm' => __('Are you sure you want to delete # {0}?', $options->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
