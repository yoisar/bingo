<?php
/**
* Class Juego.
*
* Juego
*
* @author Yassel O. I. Souchay <sioy23@gmail.com>
* @version $Revision: $  $Date: $
*/
class Juego extends TActiveRecord
{
    /**
     * @var integer
     */
    private $_idjuego=0;
    /**
     * @var string
     */
    private $_nombre='';
    /**
     * @var string
     */
    private $_fecha='';
    /**
     * @var integer
     */
    private $_numeros_sorteados=0;

    /**
     * @return integer  Defaults to 0.
     */
    public function getNumeros_sorteados()
    {
        return $this->_numeros_sorteados;
    }

    /**
     * @param integer
     */
    public function setNumeros_sorteados($value)
    {
        $this->_numeros_sorteados=TPropertyValue::ensureInteger($value);
    }

    /**
     * @return integer  Defaults to 0.
     */
    public function getIdjuego()
    {
        return $this->_idjuego;
    }

    /**
     * @param integer
     */
    public function setIdjuego($value)
    {
        $this->_idjuego=TPropertyValue::ensureInteger($value);
    }

    /**
     * @return string  Defaults to ''.
     */
    public function getNombre()
    {
        return $this->_nombre;
    }

    /**
     * @param string
     */
    public function setNombre($value)
    {
        $this->_nombre=TPropertyValue::ensureString($value);
    }

    /**
     * @return string  Defaults to ''.
     */
    public function getFecha()
    {
        return $this->_fecha;
    }

    /**
     * @param string
     */
    public function setFecha($value)
    {
        $this->_fecha=TPropertyValue::ensureString($value);
    }
    /**
     * @return TActiveRecord active record finder instance
     */
    public static function finder($className=__CLASS__)
    {
        return parent::finder($className);
    }
}
?>