<?php

namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\I18n\FrozenTime;

class CompetitionCommand extends Command
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Competition');
    }

    public function execute(Arguments $args, ConsoleIo $io)
    {
        $date = FrozenTime::now();
        $this->Competition->updateAll(
            [
                'is_active' => 0,
            ],
            [
                'is_active' => 1,
                'finishing_date <' => $date
            ]
        );
        $io->out("DB cleared.");
    }
}