<?php
/**
 * Class Tarjeta.
 *
 * Tarjeta de un juego
 *
 * @author Yassel O. I. Souchay <sioy23@gmail.com>
 * @version $Revision: $  $Date: $
 */
class Tarjeta extends TActiveRecord
{
    /**
     * @var integer
     */
    private $_idtarjeta=0;
    /**
     * @var integer
     */
    private $_idjuego=0;
    /**
     * @var string
     */
    private $_numero='';
    /**
     * @var string
     */
    private $_fila='';
    /**
     * @var string
     */
    private $_columna='';
    /**
     * @var boolean
     */
    private $_visible=false;
    /**
     * @var boolean
     */
    private $_final=false;
    /**
     * @var boolean
     */
    private $_inicio=false;
    /**
     * @var string
     */
    private $_touch='';

    /**
     * @return integer  Defaults to 0.
     */
    public function getIdtarjeta()
    {
        return $this->_idtarjeta;
    }

    /**
     * @param integer
     */
    public function setIdtarjeta($value)
    {
        $this->_idtarjeta=TPropertyValue::ensureInteger($value);
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
    public function getNumero()
    {
        return $this->_numero;
    }

    /**
     * @param string
     */
    public function setNumero($value)
    {
        $this->_numero=TPropertyValue::ensureString($value);
    }

    /**
     * @return string  Defaults to ''.
     */
    public function getFila()
    {
        return $this->_fila;
    }

    /**
     * @param string
     */
    public function setFila($value)
    {
        $this->_fila=TPropertyValue::ensureString($value);
    }

    /**
     * @return string  Defaults to ''.
     */
    public function getColumna()
    {
        return $this->_columna;
    }

    /**
     * @param string
     */
    public function setColumna($value)
    {
        $this->_columna=TPropertyValue::ensureString($value);
    }

    /**
     * @return boolean  Defaults to false.
     */
    public function getVisible()
    {
        return $this->_visible;
    }

    /**
     * @param boolean
     */
    public function setVisible($value)
    {
        $this->_visible=TPropertyValue::ensureBoolean($value);
    }

    /**
     * @return boolean  Defaults to false.
     */
    public function getFinal()
    {
        return $this->_final;
    }

    /**
     * @param boolean
     */
    public function setFinal($value)
    {
        $this->_final=TPropertyValue::ensureBoolean($value);
    }

    /**
     * @return boolean  Defaults to false.
     */
    public function getInicio()
    {
        return $this->_inicio;
    }

    /**
     * @param boolean
     */
    public function setInicio($value)
    {
        $this->_inicio=TPropertyValue::ensureBoolean($value);
    }

    /**
     * @return string  Defaults to ''.
     */
    public function getTouch()
    {
        return $this->_touch;
    }

    /**
     * @param string
     */
    public function setTouch($value)
    {
        $this->_touch=TPropertyValue::ensureString($value);
    }
    /**
     * Enter description here...
     *
     * @param unknown_type $className
     * @return unknown
     */
    public static function finder($className=__CLASS__){
        return parent::finder($className);
    }
}
?>