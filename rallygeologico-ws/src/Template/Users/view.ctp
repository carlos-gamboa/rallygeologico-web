<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Competition Statistics'), ['controller' => 'CompetitionStatistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition Statistic'), ['controller' => 'CompetitionStatistics', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Competition Statistics Site'), ['controller' => 'CompetitionStatisticsSite', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition Statistics Site'), ['controller' => 'CompetitionStatisticsSite', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Facebook Id') ?></th>
            <td><?= h($user->facebook_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Photo Url') ?></th>
            <td><?= h($user->photo_url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Admin') ?></th>
            <td><?= h($user->is_admin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Competition Statistics') ?></h4>
        <?php if (!empty($user->competition_statistics)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Competition Id') ?></th>
                <th scope="col"><?= __('Starting Date') ?></th>
                <th scope="col"><?= __('Finishing Date') ?></th>
                <th scope="col"><?= __('Points') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->competition_statistics as $competitionStatistics): ?>
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
        <h4><?= __('Related Competition Statistics Site') ?></h4>
        <?php if (!empty($user->competition_statistics_site)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Competition Id') ?></th>
                <th scope="col"><?= __('Site Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->competition_statistics_site as $competitionStatisticsSite): ?>
            <tr>
                <td><?= h($competitionStatisticsSite->user_id) ?></td>
                <td><?= h($competitionStatisticsSite->competition_id) ?></td>
                <td><?= h($competitionStatisticsSite->site_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CompetitionStatisticsSite', 'action' => 'view', $competitionStatisticsSite->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CompetitionStatisticsSite', 'action' => 'edit', $competitionStatisticsSite->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CompetitionStatisticsSite', 'action' => 'delete', $competitionStatisticsSite->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $competitionStatisticsSite->user_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
