<?php

namespace App\Controller;

use App\Model\Device;
use App\Model\Sector;

class DeviceController extends BaseController
{
    private readonly ?Device $_Device;
    private ?Sector $_Sector;

    private function getDeviceModel(): Device
    {
        if(!isset($this->_Device )){
            $this->_Device  = new Device();
        }
        return $this->_Device ;
    }
    private function getSectorModel(): Sector
    {
        if (!isset($this->_Sector)) {
            $this->_Sector = new Sector();
        }
        return $this->_Sector;
    }

    public function list()
    {
        $devices = $this->getDeviceModel()->read();
        $sectors = $this->getSectorModel()->read();
        require __DIR__ . '/../View/admin-device.php';
    }

    private function deviceIsValid($id): bool{
        $devices = $this->getDeviceModel()->getActiveDevices($id);
        if (!empty($devices) && isset($devices[0]['device_id']) && $devices[0]['device_id'] === $id) {
            return true;
        }
        return false;
    }

    public function selectDevice()
    {
        $devices = $this->getDeviceModel()->getActiveDevices();
        require __DIR__ . '/../View/insert-device-id.php';
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

    public function create()
    {

        $sector_name = $this->getParam('name', null);
        $sector_description = $this->getParam('description',null);

        if (empty($sector_name) || $sector_description === null) {
            throw new \InvalidArgumentException("Nome do setor e descricao são obrigatórios.");
        }
        $this->getSectorModel()->create($sector_name, $sector_description);

        try {
            $this->getSectorModel()->create($sector_name, $sector_description);
            header('Location: /admin/sector');
        } catch (\Exception $e) {
            throw new \Exception("Erro ao criar o setor.");
        }
        header('Location: /admin/sectors');
    }

    public function update()
    {
        $id = $this->getParam('id');
        $sector_name = $this->getParam('name', null);
        $sector_description = $this->getParam('description', null);

        try {
            $this->getSectorModel()->update($id, $sector_name, $sector_description);
            header('Location: /admin/sectors');
        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar o setor.");
        }
        header('Location: /admin/sectors');
    }

    public function delete()
    {
        $id = $this->getParam('sector_id');

        try {
            $this->getSectorModel()->delete($id);
            header('Location: /admin/sectors');
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir o setor.");
        }
    }
}