<?php
namespace volt\api;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use volt\exception\PluginIdentificationException;

class MonitoredWebsiteData extends WebsiteData{

    final public function __construct($name = false){
        $this->name = IdentificationController::identify($name);
        parent::__construct();
    }
    public function offsetExists($offset){
        parent::offsetExists($offset); // TODO: Change the autogenerated stub
    }

    public function offsetGet($offset){
        $res = parent::offsetGet($offset);
        $this->getVolt()->getMonitoredDataStore()->addRead($this->name, $offset, $res);
        return $res;
    }

    public function offsetSet($offset, $value){
        parent::offsetSet($offset, $value);
        $this->getVolt()->getMonitoredDataStore()->addWrite($this->name, $offset, $value);
    }

    public function offsetUnset($offset){
        parent::offsetUnset($offset); // TODO: Change the autogenerated stub
        $this->getVolt()->getMonitoredDataStore()->addWrite($this->name, $offset, null);
    }
}