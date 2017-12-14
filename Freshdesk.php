<?php

/**
 * Freshdesk.com abstraction plugin for Yii2 Framework
 * macklus@debianitas.net
 */

namespace macklus\freshdesk;

use Yii;
use yii\base\BaseObject;
use yii\base\Exception;
use Freshdesk\Api;

class Freshdesk extends BaseObject {

    const NAME = 'freshdesk';
    const VERSION = '1.0.0';

    public $debug = false;
    public $api_key = false;
    public $domain = false;
    private $_api = false;
    private $_configured = false;

    public function ensureConfig() {
        if ($this->_configured) {
            return $this->_api;
        }
        $this->_debug('Check required config options');
        if (!$this->api_key) {
            throw new Exception("Config option missing: api_key");
        }
        if (!$this->domain) {
            throw new Exception("Config option missing: domain");
        }
        $this->_debug("Create Api object");
        $this->_api = new Api($this->api_key, $this->domain);
        $this->_configured = true;
        return $this->_api;
    }

    /**
     * Magic methods
     * We trap all unknow request and run they throught the Freshdesk API
     */
    public function __get($name) {
        $this->_debug('__get ' . $name);
        $this->ensureConfig();
        return $this->_api->{$name};
    }

    public function __call($name, $arguments) {
        $this->_debug('__call ' . $name);
        $api = $this->ensureConfig();
        call_user_func_array(['api', $name], $arguments);
    }

    private function _debug($message) {
        if ($this->debug) {
            Yii::trace($message, 'freshdesk');
        }
    }

}
