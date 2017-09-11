<?php

namespace Lexasan\Slack;

/**
 * Class Error
 *
 * @package Lexasan\Slack
 */
class Error extends Message
{
    protected $_channel = '#bugs';
    protected $_iconEmoji = ':shit:';
    protected $_username = 'mr. Warning';
}