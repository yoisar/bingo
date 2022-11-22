<?php

/**
 * Class Bingo.
 *
 * Bingo core
 *
 * @author Yassel O. I. Souchay <sioy23@gmail.com>
 * @version $Revision: $  $Date: $
 */
class Bingo extends TModule
{

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
     * @return mixed numeros visibles Defaults to null.
     */
    public function getVisiblesNumbers()
    {
        /*
         * if (empty($this->session['visiblesNumbers'])) {
         * return $this->session['visiblesNumbers']=array();
         * }
         */
        return $this->session['visiblesNumbers'];
    }

    /**
     *
     * @param
     *            mixed numeros visibles
     */
    public function setVisiblesNumbers($value)
    {
        $this->session['visiblesNumbers'] = $value;
    }

    /**
     * Enter description here...
     *
     * @param unknown_type $numero            
     */
    private function addNumber($numero)
    {
        if ($this->session->contains("visiblesNumbers")) {
            $temp = $this->session['visiblesNumbers'];
            $temp[count($temp)] = $numero;
        } else {
            $temp[] = $numero;
        }
        
        $this->session['visiblesNumbers'] = $temp;
        
        print_r($temp);
    }

    /**
     * Arma tabla de numeros pero invisibles
     */
    public function createNumbersTable($idjuego)
    {
        //
        $total = $this->cardGenerated($idjuego);
        //
        if ($total == 0) {
            //
            $numero = 1;
            //
            for ($row = 1; $row <= 10; $row ++) {
                //
                for ($col = 0; $col <= 9; $col ++) {
                    //
                    $this->insertCardNumber($idjuego, $col + 1, $row, (($col) * 10) + $numero);
                }
                $numero ++;
            }
        }
    }

    /**
     * Devuelve verdadero
     * si ya esta la tarjeta generada
     *
     * @param unknown_type $id            
     * @return unknown
     */
    private function cardGenerated($id)
    {
        $count = $this->sqlmap()->queryForList('total_distribuidos', $id);
        return $count[0]['total'];
    }

    /**
     * Agregar un numero a la tarjeta
     *
     * @param unknown_type $col            
     * @param unknown_type $row            
     * @param unknown_type $numero            
     */
    private function insertCardNumber($idjuego, $col, $row, $numero)
    {
        $tarjeta = new Tarjeta();
        $tarjeta->visible = false;
        $tarjeta->setIdjuego(intval($idjuego));
        
        $tarjeta->columna = $col;
        $tarjeta->fila = $row;
        $tarjeta->touch = date('Y-m-d H:i:s');
        
        $tarjeta->numero = $numero;
        $tarjeta->save();
    }

    /**
     * Cambia el estado de un numero a visible
     *
     * @param unknown_type $numero            
     */
    private function changeToVisible($numero, $idjuego)
    {
        $tarjeta = Tarjeta::finder()->find("numero=$numero and idjuego=$idjuego and visible=0");
        if ($tarjeta instanceof Tarjeta) {
            $tarjeta->visible = 1;
            $tarjeta->save();
        }
    }

    /**
     * Enter description here...
     *
     * @param integer $gameNumber
     *            nmero del juego
     * @param integer $idJuego
     *            identificador del juego en la Base de datos
     */
    public function startGame($idJuego)
    {
        $this->createNumbersTable($idJuego);
    }

    /**
     * Enter description here...
     */
    public function endGame($idJuego, $lastNumber = 0)
    {
        if ($lastNumber != 0) {
            $t = Tarjeta::finder()->find("idjuego='$idJuego' and numero=$lastNumber");
            $t->final = 1;
            $t->save();
        }
    }

    /**
     * Funcion que saca los numeros
     */
    public function pickupNumber($idJuego)
    {
        // Si el total visible es menor que 90
        if ($this->totalVisible($idJuego) < 90) {
            $dList = new TList();
            // obtener solamente los numeros con estado NO visible
            $dList->copyFrom(Tarjeta::finder()->finAll("idjuego=$idJuego and visible=0"));
            // obtener el total
            $total = count($dList);
            // inicializar num
            $numero = rand(1, 90);
            // si hay mas de 0 registros devueltos
            if (count($total) > 0) {
                //
                $estaVisible = $this->visibleNumber($numero, $idJuego);
                // mientras el numero sea mayor que 90
                while ($estaVisible && $this->totalVisible($idJuego) < 90) {
                    /* OBTENER VALORES ALEATRORIOS */
                    $numero = rand(1, 90);
                    //
                    $estaVisible = $this->visibleNumber($numero, $idJuego);
                }
                // cabiar estado del numero a visible
                $this->changeToVisible($numero, $idJuego);
                return $numero;
            } else {
                return 0;
            }
        }
    }

    /**
     * Enter description here...
     *
     * @param unknown_type $idgame            
     */
    public function restart($idgame)
    {}

    /**
     * Enter description here...
     */
    public function totalVisible($idJuego)
    {
        return Tarjeta::finder()->count("idjuego=$idJuego and visible=1");
    }

    /**
     */
    private function visibleNumber($numero, $idJuego)
    {
        $t = Tarjeta::finder()->find("idjuego=$idJuego and numero=$numero and visible=1");
        if ($t instanceof Tarjeta) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Enter description here...
     */
    public function retrieveNumbersTable($idJuego)
    {
        $crit = new TActiveRecordCriteria();
        $crit->OrdersBy['numero'] = 'ASC';
        $crit->condition = "idjuego=$idJuego";
        return Tarjeta::finder()->findAll($crit);
    }

    /**
     * Enter description here...
     *
     * @param unknown_type $id            
     */
    public function saveGame($id)
    {
        $j = Juego::finder()->find("idjuego={$id}");
        $j->fecha = date("Y-m-d");
        $j->numeros_sorteados = $this->totalVisible($id);
        $j->save();
    }

    /**
     * Recarga un juego especifico
     */
    public function reloadGame($idgame)
    {
        return Tarjeta::find()->findAll("idjuego=$idgame");
    }
    // public function
}
?>