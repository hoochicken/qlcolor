<?php


namespace QlColor;


class QlColor
{

    private $red = 0;
    private $green = 0;
    private $blue = 0;
    private $opacity = 0;

    public function __construct($input)
    {
        $this->init($input);
    }

    private function init($input)
    {
        if ('QlColor' === get_class($input)) $this->initByClass($input);

    }

    private function initByClass(QlColor $input)
    {
        $this->setRed($input->red);
        $this->setGreen($input->green);
        $this->setBlue($input->blue);
        $this->setOpacity($input->opacity);
    }

    public function setRed($value)
    {
        $this->red = $value;
    }

    public function setGreen($value)
    {
        $this->green = $value;
    }

    public function setBlue($value)
    {
        $this->blue = $value;
    }

    public function setOpacity($value)
    {
        $this->opacity = $value;
    }

    public function getRed()
    {
        return $this->red;
    }

    public function getGreen()
    {
        return $this->green;
    }

    public function getBlue()
    {
        return $this->blue;
    }

    public function getOpacity()
    {
        return $this->opacity;
    }

    public function getRGB()
    {
        return implode (',', $this->getRGBArray());
    }

    public function getRGBArray()
    {
        return [$this->getRed(), $this->getGreen(), $this->getBlue()];
    }

    public function getRGBA()
    {
        return [$this->getRed(), $this->getGreen(), $this->getBlue(), $this->getOpacity()];
    }

    public function getRGBAArray()
    {
        return implode (',', $this->getRGBAArray());
    }

    public function getHex()
    {
        return $this->opacity;
    }
}
