<?php

namespace Lexasan\Slack;


/**
 * Class Attachment
 *
 * @package Lexasan\Slack
 */
class Attachment
{
    protected $_data = [];

    const COLOR_RED = '#d11717';
    const COLOR_YELLOW = '#ffc700';
    const COLOR_GREEN = '#0b8e25';

    function __construct($options = [])
    {
        $this->setData($options);
        return $this;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->_data = (array)$data;
        return $this;
    }
    public function getData()
    {
        return $this->_data;
    }

    public function setColor($val)
    {
        $this->_data['color'] = $val;
        return $this;
    }

    public function setText($val)
    {
        $this->_data['text'] = $val;
        return $this;
    }

    public function setAuthorName($val)
    {
        $this->_data['author_name'] = $val;
        return $this;
    }

    /**
     * @param array $fields
     * @example [{"title": "Priority","value": "High","short": false}, ...]
     *
     * @return $this
     */
    public function setFields($fields = [])
    {
        $this->_data['fields'] = $fields;
        return $this;
    }

    /**
     * @example {"title": "Priority","value": "High","short": false}
     * @param array $field
     *
     * @return $this
     */
    public function addField($field)
    {
        $this->_data['fields'][] = $field;
        return $this;
    }

    /**
     * @example [{"title": "Priority","value": "High","short": false}, ...]
     * @return mixed|null
     */
    public function getFields()
    {
        if (isset($this->_data['fields'])) {
            return $this->_data['fields'];
        }
        return null;
    }

}