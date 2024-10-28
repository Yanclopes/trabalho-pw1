<?php

namespace App\Controller;

use App\Model\Device;

class DeviceController extends BaseController
{
    private readonly ?Device $_Device ;
    private function getDeviceModel(): Device
    {
        if(!isset($this->_Device )){
            $this->_Device  = new Device();
        }
        return $this->_Device ;
    }

    private function deviceIsValid($id): bool{
        $devices = $this->getDeviceModel()->getActiveDevices($id);
        if (!empty($devices) && isset($devices[0]['device_id']) && $devices[0]['device_id'] === $id) {
            return true;
        }
        return false;
    }

    public function validateDevice(){
        $id = $this->getParam('device_id');
        if(!isset($id) || !$this->deviceIsValid(intval($id))) {
            $isInvalidDevice = true;
            require __DIR__ . '/../View/insert-device-id.php';
            return;
        }
        header('Location: /question?device_id='.$id);
    }
}