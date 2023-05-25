<?php

namespace App\Config;

enum UserTypeEnum: int
{
    case Manager = 1;
    case Player = 2;
}