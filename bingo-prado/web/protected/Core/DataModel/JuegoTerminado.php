<?php
/**
 * Class JuegoTerminado.
 *
 * Juego terminado
 * Informacion para almacenar cuando se termina un juego
 *
 * @author Yassel O. I. Souchay <sioy23@gmail.com>
 * @version $Revision: $  $Date: $
 */
class JuegoTerminado extends TActiveRecord
{
    const TABLE='juego_terminado';
    /**
     * @var integer
     */
    private $_idjuego=0;
    /**
     * @var integer
     */
    private $_idjuego_tipo=0;
    /**
     * @var integer
     */
    private $_cantidad=0;
    /**
     * @var string
     */
    private $_date='';
    /**
     * @var mixed
     */
    private $_id=null;

    /**
     * @return mixed  Defaults to null.
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed
     */
    public function setId($value)
    {
        $this->_id=$value;
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
     * @return integer  Defaults to 0.
     */
    public function getIdjuego_tipo()
    {
        return $this->_idjuego_tipo;
    }

    /**
     * @param integer
     */
    public function setIdjuego_tipo($value)
    {
        $this->_idjuego_tipo=TPropertyValue::ensureInteger($value);
    }

    /**
     * @return integer  Defaults to 0.
     */
    public function getCantidad()
    {
        return $this->_cantidad;
    }

    /**
     * @param integer
     */
    public function setCantidad($value)
    {
        $this->_cantidad=TPropertyValue::ensureInteger($value);
    }

    /**
     * @return string  Defaults to ''.
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param string
     */
    public function setDate($value)
    {
        $this->_date=TPropertyValue::ensureString($value);
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