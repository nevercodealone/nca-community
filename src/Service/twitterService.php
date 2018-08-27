<?php

namespace App\Service;

class twitterService
{
    public function crawlerCommand() {
        return count($this->getActualTweetsFromUsers());
    }

    protected function getActualTweetsFromUsers(): array
    {
        return [
            'erster',
            'zweiter'
        ];
    }
}