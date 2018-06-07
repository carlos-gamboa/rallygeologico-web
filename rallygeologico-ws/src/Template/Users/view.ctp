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
        <li><?= $this->Html->link(__('List Competition'), ['controller' => 'Competition', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition'), ['controller' => 'Competition', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invitation Send'), ['controller' => 'Invitation', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invitation Send'), ['controller' => 'Invitation', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Invitation Receive'), ['controller' => 'Invitation', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invitation Receive'), ['controller' => 'Invitation', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Competition Statistics'), ['controller' => 'CompetitionStatistics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition Statistic'), ['controller' => 'CompetitionStatistics', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Api Id') ?></th>
            <td><?= h($user->api_id) ?></td>
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
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Admin') ?></th>
            <td><?= $this->Number->format($user->is_admin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Login Api') ?></th>
            <td><?= $this->Number->format($user->login_api) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password Needs Change') ?></th>
            <td><?= $this->Number->format($user->password_needs_change) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Competition') ?></h4>
        <?php if (!empty($user->competition)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Starting Date') ?></th>
                <th scope="col"><?= __('Finishing Date') ?></th>
                <th scope="col"><?= __('Is Public') ?></th>
                <th scope="col"><?= __('Admin Id') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Rally Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->competition as $competition): ?>
            <tr>
                <td><?= h($competition->id) ?></td>
                <td><?= h($competition->is_active) ?></td>
                <td><?= h($competition->starting_date) ?></td>
                <td><?= h($competition->finishing_date) ?></td>
                <td><?= h($competition->is_public) ?></td>
                <td><?= h($competition->admin_id) ?></td>
                <td><?= h($competition->description) ?></td>
                <td><?= h($competition->name) ?></td>
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
    <div class="related">
        <h4><?= __('Related Invitation') ?></h4>
        <?php if (!empty($user->invitation_send)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Accepted') ?></th>
                <th scope="col"><?= __('Rejected') ?></th>
                <th scope="col"><?= __('User Id Send') ?></th>
                <th scope="col"><?= __('User Id Receive') ?></th>
                <th scope="col"><?= __('Competition Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->invitation_send as $invitationSend): ?>
            <tr>
                <td><?= h($invitationSend->id) ?></td>
                <td><?= h($invitationSend->accepted) ?></td>
                <td><?= h($invitationSend->rejected) ?></td>
                <td><?= h($invitationSend->user_id_send) ?></td>
                <td><?= h($invitationSend->user_id_receive) ?></td>
                <td><?= h($invitationSend->competition_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invitation', 'action' => 'view', $invitationSend->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Invitation', 'action' => 'edit', $invitationSend->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Invitation', 'action' => 'delete', $invitationSend->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invitationSend->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Invitation') ?></h4>
        <?php if (!empty($user->invitation_receive)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Accepted') ?></th>
                <th scope="col"><?= __('Rejected') ?></th>
                <th scope="col"><?= __('User Id Send') ?></th>
                <th scope="col"><?= __('User Id Receive') ?></th>
                <th scope="col"><?= __('Competition Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->invitation_receive as $invitationReceive): ?>
            <tr>
                <td><?= h($invitationReceive->id) ?></td>
                <td><?= h($invitationReceive->accepted) ?></td>
                <td><?= h($invitationReceive->rejected) ?></td>
                <td><?= h($invitationReceive->user_id_send) ?></td>
                <td><?= h($invitationReceive->user_id_receive) ?></td>
                <td><?= h($invitationReceive->competition_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Invitation', 'action' => 'view', $invitationReceive->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Invitation', 'action' => 'edit', $invitationReceive->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Invitation', 'action' => 'delete', $invitationReceive->id], ['confirm' => __('Are you sure you want to delete # {0}?', $invitationReceive->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Competition Statistics') ?></h4>
        <?php if (!empty($user->competition_statistics)): ?>
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
            <?php foreach ($user->competition_statistics as $competitionStatistics): ?>
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
</div>
