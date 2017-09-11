<?php

namespace Lexasan\Slack;

/**
 * Class Client
 *
 * @package Lexasan\Slack
 */
class Client
{

    protected $_webhook;
    protected $_channel = '#dev';
    protected $_username = 'robot Werter';
    protected $_linkNames = true;
    protected $_iconEmoji = ':robot_face:';

    protected $_ch = null;

    /**
     * Client constructor.
     *
     * @param array $options
     *
     * @example
     *      new Client([
     *          'webhook' => <url>,
     *          'channel' => '#devs',
     *          'username' => 'Werter',
     *          'link_names' => true,
     *          'icon_emoji' => ':robot_face:',
     *      ])
     */
    public function __construct($options = [])
    {
        $options = (array)$options;
        if (count($options)) {
            if (isset($options['webhook'])) {
                $this->setWebhook($options['webhook']);
            }
            if (isset($options['channel'])) {
                $this->setChannel($options['channel']);
            }
            if (isset($options['username'])) {
                $this->setUsername($options['username']);
            }
            if (isset($options['link_names'])) {
                $this->setLinkNames($options['link_names']);
            }
            if (isset($options['icon_emoji'])) {
                $this->setIconEmoji($options['icon_emoji']);
            }
        }

    }

    public function connect()
    {
        $this->_ch = curl_init();
        if (!$this->_ch) {
            return $this->_ch;
        }

        curl_setopt($this->_ch, CURLOPT_URL, $this->getWebhook());
        curl_setopt($this->_ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->_ch, CURLOPT_POST, true);
        curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->_ch, CURLOPT_HEADER, false);
        curl_setopt($this->_ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);

        return $this->_ch;
    }

    public function disconnect()
    {
        if ($this->_ch) {
            curl_close($this->_ch);
        }
        return $this;
    }

    public function setWebhook($val)
    {
        $this->_webhook = $val;
        return $this;
    }

    public function getWebhook()
    {
        return $this->_webhook;
    }

    /**
     * @param string $val
     *
     * @return Client
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
     * @param bool $val
     */
    public function setLinkNames($val)
    {
        $this->_linkNames = (bool)$val;
        return $this;
    }

    /**
     * @return bool
     */
    public function getLinkNames()
    {
        return (bool)$this->_linkNames;
    }

    public function send(Message $msg)
    {
        if (!$this->_ch && !$this->connect()) {
            return false;
        }

        $msgArr = [];

        $msgArr['channel'] = $msg->getChannel() ? $msg->getChannel() : $this->getChannel();
        $msgArr['username'] = $msg->getUsername() ? $msg->getUsername() : $this->getUsername();
        $msgArr['icon_emoji'] = $msg->getIconEmoji() ? $msg->getIconEmoji() : $this->getIconEmoji();
        $msgArr['link_names'] = $this->getLinkNames();

        if ($txt = $msg->getText()) {
            $msgArr['text'] = $txt;
        }

        if ($attach = $msg->getAttachment()) {
            $msgArr['attachments'] = [
                $attach->getData()
            ];
        }

        curl_setopt($this->_ch, CURLOPT_POSTFIELDS, json_encode($msgArr));
        $res = curl_exec($this->_ch);

        return $res;
    }

}