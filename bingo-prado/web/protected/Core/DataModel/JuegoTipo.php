<?php
/**
 * Class JuegoTipo.
 *
 * Tipo de Bingo
 * Linea
 * Bingo
 * Etc
 *
 * @author Yassel O. I. Souchay <sioy23@gmail.com>
 * @version $Revision: $  $Date: $
 */
class JuegoTipo extends TActiveRecord
{
    const TABLE='juego_tipo';
    /**
     * @var integer
     */
    private $_idjuego_tipo=0;
    /**
     * @var string
     */
    private $_nombre='';

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