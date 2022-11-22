<?php
/**
 * Class StandByPage.
 *
 * Syand by Page
 *
 * @author Yassel O. I. Souchay <sioy23@gmail.com>
 * @version $Revision: $  $Date: $
 */
class StandByPage extends BingoPage
{
    public function onLoad($params){
        parent::onLoad($params);
//        $this->GameNumber->text=$this->session['GameNumber'];


    }
    /**
     * Enter description here...
     *
     * @param unknown_type $sender
     * @param unknown_type $param
     */
    public function BtnComenzar_OnClick($sender,$param){
        $this->goToPage('Jugar');

    }
}
?>