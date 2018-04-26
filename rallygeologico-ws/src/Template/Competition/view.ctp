<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Competition $competition
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Competition'), ['action' => 'edit', $competition->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Competition'), ['action' => 'delete', $competition->id], ['confirm' => __('Are you sure you want to delete # {0}?', $competition->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Competition'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rally'), ['controller' => 'Rally', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rally'), ['controller' => 'Rally', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Competition Statistics'), ['controller' => 'CompetitionStatistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition Statistic'), ['controller' => 'CompetitionStatistics', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Competition Statistics Site'), ['controller' => 'CompetitionStatisticsSite', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition Statistics Site'), ['controller' => 'CompetitionStatisticsSite', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invitation'), ['controller' => 'Invitation', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invitation'), ['controller' => 'Invitation', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="competition view large-9 medium-8 columns content">
    <h3><?= h($competition->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= h($competition->is_active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Public') ?></th>
            <td><?= h($competition->is_public) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($competition->Name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rally') ?></th>
            <td><?= $competition->has('rally') ? $this->Html->link($competition->rally->name, ['controller' => 'Rally', 'action' => 'view', $competition->rally->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($competition->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Starting Date') ?></th>
            <td><?= h($competition->starting_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Finishing Date') ?></th>
            <td><?= h($competition->finishing_date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Competition Statistics') ?></h4>
        <?php if (!empty($competition->competition_statistics)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Competition Id') ?></th>
                <th scope="col"><?= __('Starting Date') ?></th>
                <th scope="col"><?= __('Finishing Date') ?></th>
                <th scope="col"><?= __('Points') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($competition->competition_statistics as $competitionStatistics): ?>
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
        <?php if (!empty($competition->competition_statistics_site)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Competition Id') ?></th>
                <th scope="col"><?= __('Site Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($competition->competition_statistics_site as $competitionStatisticsSite): ?>
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
    <div class="related">
        <h4><?= __('Related Invitation') ?></h4>
        <?php if (!empty($competition->invitation)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Accepted') ?></th>
                <th scope="col"><?= __('User Id Send') ?></th>
                <th scope="col"><?= __('User Id Receive') ?></th>
                <th scope="col"><?= __('Competition Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($competition->invitation as $invitation): ?>
            <tr>
                <td><?= h($invitation->id) ?></td>
                <td><?= h($invitation->accepted) ?></td>
                <td><?= h($invitation->user_id_send) ?></td>
                <td><?= h($invitation->user_id_receive) ?></td>
                <td><?= h($invitation->competition_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invitation', 'action' => 'view', $invitation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Invitation', 'action' => 'edit', $invitation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Invitation', 'action' => 'delete', $invitation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invitation->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
