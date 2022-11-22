<?php
/**
 * Class Juego.
 *
 * Juego
 *
 * @author Yassel O. I. Souchay <sioy23@gmail.com>
 * @version $Revision: $  $Date: $
 */
class Jugar extends BingoPage
{
	/**
     * @return integer  Defaults to 0.
     */
	public function getLastNumber()
	{
		return $this->getControlState('LastNumber',0);
	}

	/**
     * @param integer
     */
	public function setLastNumber($value)
	{
		$this->setControlState('LastNumber',TPropertyValue::ensureInteger($value),0);
	}
	/**
     * Enter description here...
     *
     * @param unknown_type $params
     */
	public function onLoad($params){

		if (!$this->IsPostBack) {
			//
			parent::onLoad($params);
			//
			$this->setGameNumber($this->session['gameNumber']);
			$this->CurrentNumber->text='&nbsp;?';
			//Inicializar el juego
			$this->getBingo()->createNumbersTable($this->getGameNumber());
		}
	}
	/**
     * Enter description here...
     *
     * @param unknown_type $sender
     * @param unknown_type $param
     */
	public function sacarNumero($sender,$param){
		//
		$this->CurrentNumber->text=$this->getBingo()->pickupNumber($this->getGameNumber());
		$this->refreshCard($this->getGameNumber());
		$this->setLastNumber($this->CurrentNumber->text);
		//
		$this->NumerosSorteados->text=$this->getBingo()->totalVisible($this->getGameNumber());
	}
	/**
     * Enter description here...
     *
     * @param unknown_type $sender
     * @param unknown_type $param
     */
	public function BtnTerminarJuego_OnClick($sender,$param){
		//
		if ($this->getLastNumber()!=0) {
			$this->DatosGanador->visible=true;
			$this->PnlTarjeta->visible=false;
			$this->BtnSacarNumero->visible=false;
			$this->BtnTerminarJuego->Visible=false;
			$this->PnlBola->Visible=false;
			$this->getBingo()->endGame($this->getGameNumber(),$this->getLastNumber());
			$this->updateDataSource($this->LisaTipoJuego,JuegoTipo::finder()->findAll());
		}else {
			$this->response->redirect('index.php');
		}
	}
	/**
     * Enter description here...
     *
     * @param unknown_type $sender
     * @param unknown_type $param
     */
	public function insertWinner($sender,$param){
		if ($this->IsValid) {
			$t= new JuegoTerminado;
			$t->idjuego=$this->getGameNumber();
			$t->idjuego_tipo=$this->LisaTipoJuego->SelectedValue;
			$t->cantidad=$this->cantidad->text;
			$t->date=date("Y-m-d H:i:s");
			$t->save();
			//            $this->loadWinnerList($sender,$param);
		}
	}
	/**
     * Enter description here...
     *
     * @param unknown_type $sender
     * @param unknown_type $param
     */
	public function loadWinnerList($sender,$param){
		$crit=new TActiveRecordCriteria;
		$crit->condition="idjuego={$this->getGameNumber()} group by idjuego_tipo";
		$this->updateDataSource($this->WinnerList,JuegoTerminado::finder()->findAll($crit));

	}
	/**
     * Enter description here...
     *
     */
	public function finishGame($sender,$param){
		$this->getBingo()->saveGame($this->getGameNumber());
		$this->goToPage('Home');

	}
	/**
     * Enter description here...
     *
     * @param unknown_type $sender
     * @param unknown_type $param
     */
	public function deleteWinner($sender,$param){
		$w= JuegoTerminado::finder()->find("id=".$sender->DataKeys[$param->Item->ItemIndex]);
		$w->delete();
		$this->loadWinnerList($sender,$param);
	}
	/**
     * Enter description here...
     *
     */
	public function refreshCard($idgame){
		//Actualizar tabla para probar
		$this->updateDataSource($this->Tarjeta,$this->getBingo()->retrieveNumbersTable($idgame));

	}
}
?>