<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompetitionStatisticsSite $competitionStatisticsSite
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Competition Statistics Site'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="competitionStatisticsSite form large-9 medium-8 columns content">
    <?= $this->Form->create($competitionStatisticsSite) ?>
    <fieldset>
        <legend><?= __('Add Competition Statistics Site') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
