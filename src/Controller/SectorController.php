<?php

namespace App\Controller;

use App\Model\Sector;

class SectorController extends BaseController
{
    private ?Sector $_Sector = null;

    private function getSectorModel(): Sector
    {
        if (!isset($this->_Sector)) {
            $this->_Sector = new Sector();
        }
        return $this->_Sector;
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

    public function list()
    {
        $sectors = $this->getSectorModel()->read();
        require __DIR__ . '/../View/admin-sector.php';
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
