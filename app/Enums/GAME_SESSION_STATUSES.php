<?php

namespace App\Enums;

enum GAME_SESSION_STATUSES: string
{
    case STARTED = 'started';
    case IN_PROGRESS = 'in_progress';
    case FINISHED = 'finished';
}
