<?php

/**
 * Class BingoPage.
 *
 * Bingo base page
 *
 * @author Yassel O. I. Souchay <sioy23@gmail.com>
 * @version $Revision: $  $Date: $
 */
class BingoPage extends TPage
{

    /**
     *
     * @return Bingo instancia de Bingo Defaults to null.
     */
    public function getBingo()
    {
        return $this->getControlState('Bingo', null);
    }

    /**
     *
     * @param
     *            Bingo instancia de Bingo
     */
    public function setBingo($value)
    {
        $this->setControlState('Bingo', $value, null);
    }

    /**
     * Actualiza el DataSource de una instancia de tipo BaseDataList
     *
     * @param TBaseDataList $dataList            
     * @param array $data            
     */
    public function updateDataSource(&$DataGrid, $data, $currentPageIndex = 0)
    {
        $DataGrid->DataSource = $data;
        $DataGrid->dataBind();
    }

    /**
     * Enter description here...
     */
    public function onLoad($param)
    {
        parent::onLoad($param);
        $this->setBingo($this->Application->getModule('bingo'));
        $this->Bingo->setVisiblesNumbers(array());
    }

    /**
     * Enter description here...
     *
     * @param String $page            
     */
    protected function goToPage($page)
    {
        $this->Response->redirect($this->Service->constructUrl($page));
    }

    /**
     * Enter description here...
     *
     * @return TSqlMapGateway
     */
    public function sqlmap()
    {
        return $this->Application->Modules['my-sqlmap']->Client;
    }

    /**
     *
     * @return integer numero de juego actual Defaults to 1.
     */
    public function getGameNumber()
    {
        return $this->getControlState('GameNumber', 1);
    }

    /**
     *
     * @param
     *            integer numero de juego actual
     */
    public function setGameNumber($value)
    {
        $this->setControlState('GameNumber', TPropertyValue::ensureInteger($value), 1);
    }
}
?>