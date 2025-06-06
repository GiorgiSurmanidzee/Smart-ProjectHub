<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case PROJECT_MANAGER = 'project manager';
    case TEAM_MEMBER = 'team member';
    case CLIENT = 'client';
}
