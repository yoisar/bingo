<?php
/**
 * Class Home.
 *
 * Home
 *
 * @author Yassel O. I. Souchay <sioy23@gmail.com>
 * @version $Revision: $  $Date: $
 */
class Home extends BingoPage
{
	public function onLoad($param){
		parent::onLoad($param);
		$this->updateDataSource($this->ListaDeJuegos,Juego::finder()->findAll("numeros_sorteados=0"));

	}
	/**
     * Enter description here...
     *
     * @param unknown_type $sender
     * @param unknown_type $param
     */
	public function btnJugar_OnClick($sender,$param){		
		//
		$this->session['gameNumber']=$this->ListaDeJuegos->SelectedValue;
		//
		$this->setGameNumber($this->ListaDeJuegos->SelectedValue);
		$this->goToPage('StandByPage');
	}
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $sender
	 * @param unknown_type $param
	 */
	public function lnkResetBingo_OnClick($sender,$param){
		//
		$this->sqlmap()->update('inicializa_juegos');
		//
		Tarjeta::finder()->deleteAll();
		$this->response->redirect('index.php');
	}

}
?>