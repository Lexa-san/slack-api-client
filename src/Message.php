<?php

namespace Lexasan\Slack;

/**
 * Class Message
 *
 * @package Lexasan\Slack
 */
class Message
{

    protected $_channel;
    protected $_username;
    protected $_text;
    protected $_iconEmoji;
    /* @var Attachment */
    protected $_attachment;

    /**
     * Message constructor.
     *
     * @param array $options
     *
     * @example
     *      new Message([
     *          'channel' => '#devs',
     *          'username' => 'Werter',
     *          'text' => 'Hello world',
     *          'icon_emoji' => ':robot_face:',
     *      ])
     */
    function __construct($options = [])
    {
        $options = (array)$options;
        if (count($options)) {
            if (isset($options['channel'])) {
                $this->setChannel($options['channel']);
            }
            if (isset($options['username'])) {
                $this->setUsername($options['username']);
            }
            if (isset($options['text'])) {
                $this->setText($options['text']);
            }
        }
    }

    /**
     * @param string $val
     *
     * @return $this
     */
    public function setChannel($val)
    {
        $this->_channel = $val;
        return $this;
    }

    /**
     * @see setChannel()
     */
    public function to($val)
    {
        return $this->setChannel($val);
    }

    public function getChannel()
    {
        return $this->_channel;
    }

    /**
     * @param string $val
     *
     * @return $this
     */
    public function setUsername($val)
    {
        $this->_username = $val;
        return $this;
    }

    /**
     * @see setUsername()
     */
    public function from($val)
    {
        return $this->setUsername($val);
    }

    public function getUsername()
    {
        return $this->_username;
    }

    public function setText($val)
    {
        $this->_text = $val;
        return $this;
    }

    public function say($val)
    {
        return $this->setText($val);
    }

    public function getText()
    {
        return $this->_text;
    }

    public function setIconEmoji($val)
    {
        $this->_iconEmoji = $val;
        return $this;
    }

    public function getIconEmoji()
    {
        return $this->_iconEmoji;
    }

    /**
     * @param Attachment $attachment
     */
    public function setAttachment(Attachment $attachment)
    {
        $this->_attachment = $attachment;
        return $this;
    }

    /**
     * @return Attachment
     */
    public function getAttachment()
    {
        return $this->_attachment;
    }


}