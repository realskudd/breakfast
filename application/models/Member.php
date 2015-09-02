<?php

class Member extends \ActiveRecord\Model
{
    public static $has_many = [
        ['schedules'],
    ];
}