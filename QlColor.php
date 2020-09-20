<?php


namespace QlColor;


class QlColor
{

    private $red = 0;
    private $green = 0;
    private $blue = 0;
    private $alpha = 1;

    private $keyRed = 'red';
    private $keyGreen = 'green';
    private $keyBlue = 'blue';
    private $keyAlpha = 'alpha';

    private $greyScaleRed = 0.2126;
    private $greyScaleGreen = 0.7152;
    private $greyScaleBlue = 0.0722;

    public function __construct($input)
    {
        $this->init($input);
    }

    private function init($input)
    {
        if (is_object($input) && 'QlColor' === get_class($input)) {
            $this->initByClass($input);
            return;
        }
        if (is_string($input)) {
            if (false !== strpos($input, ',')) {$this->initByRgba($input);}
            if (false !== strpos($input, '#')) {$this->initByHex($input);}
            return;
        }
        if (is_array($input)) {
            $this->initByArray($input);
            return;
        }
        die('Cannot work on this');
    }

    private function initByClass(QlColor $input)
    {
        $this->setRed($input->red);
        $this->setGreen($input->green);
        $this->setBlue($input->blue);
        $this->setAlpha($input->alpha);
    }

    private function initByRgba(string $input)
    {
        $array = explode(',', $input);
        if (3 !== count($array) && 4 !== count($array)) die('Cannot work on this');
        $this->setRed($array[0]);
        $this->setGreen($array[1]);
        $this->setBlue($array[2]);
        $this->setAlpha(1);
        if (isset($array[3])) $this->setAlpha($array[3]);
    }

    private function initByHex(string $input)
    {
        $input = substr($input, 1);
        $array = str_split($input, 2);
        if (3 !== count($array)) die('Cannot work on this');
        $this->setRed(hexdec($array[0]));
        $this->setGreen(hexdec($array[1]));
        $this->setBlue(hexdec($array[2]));
        $this->setAlpha(1);
    }

    private function initByArray(array $array)
    {
        if (3 !== count($array) && 4 !== count($array)) die('Cannot work on this');
        $this->setRed($array['red']);
        $this->setGreen($array['green']);
        $this->setBlue($array['blue']);
        $this->setAlpha(1);
        if (isset($array['alpha'])) $this->setAlpha($array['alpha']);
    }

    /**
     * ADD
     */

    public function add(QlColor $color)
    {
        $this->addRed($color);
        $this->addGreen($color);
        $this->addBlue($color);
        $this->addAlpha($color);
    }

    public function addRed(QlColor $color)
    {
        $this->red += $color->getRed();
    }

    public function addGreen(QlColor $color)
    {
        $this->red += $color->getGreen();
    }

    public function addBlue(QlColor $color)
    {
        $this->red += $color->getBlue();
    }

    public function addAlpha(QlColor $color)
    {
        $this->alpha += $color->getAlpha();
    }

    /**
     * SUB
     */

    public function sub(QlColor $color)
    {
        $this->subRed($color);
        $this->subGreen($color);
        $this->subBlue($color);
        $this->subAlpha($color);
    }

    public function subRed(QlColor $color)
    {
        $this->red -= $color->getRed();
    }

    public function subGreen(QlColor $color)
    {
        $this->red -= $color->getGreen();
    }

    public function subBlue(QlColor $color)
    {
        $this->red -= $color->getBlue();
    }

    public function subAlpha(QlColor $color)
    {
        $this->alpha -= $color->getAlpha();
    }

    /**
     * MULTIPLY
     */

    public function mult(QlColor $color)
    {
        $this->multRed($color);
        $this->multGreen($color);
        $this->multBlue($color);
        $this->multAlpha($color);
    }

    public function multRed(QlColor $color)
    {
        $this->red *= $color->getRed();
    }

    public function multGreen(QlColor $color)
    {
        $this->red *= $color->getGreen();
    }

    public function multBlue(QlColor $color)
    {
        $this->red *= $color->getBlue();
    }

    public function multAlpha(QlColor $color)
    {
        $this->alpha *= $color->getAlpha();
    }

    /**
     * DIVIDE
     */

    public function div(QlColor $color)
    {
        $this->divRed($color);
        $this->divGreen($color);
        $this->divBlue($color);
        $this->divAlpha($color);
    }

    public function divRed(QlColor $color)
    {
        $this->red /= $color->getRed();
    }

    public function divGreen(QlColor $color)
    {
        $this->red /= $color->getGreen();
    }

    public function divBlue(QlColor $color)
    {
        $this->red /= $color->getBlue();
    }

    public function divAlpha(QlColor $color)
    {
        $this->alpha /= $color->getAlpha();
    }

    /**
     * GETTERS AND SETTERS
     */

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

    public function setAlpha($value)
    {
        $this->alpha = $value;
    }

    public function getRed()
    {
        return $this->transform255($this->red);
    }

    public function getGreen()
    {
        return $this->transform255($this->green);
    }

    public function getBlue()
    {
        return $this->transform255($this->blue);
    }

    public function getAlpha()
    {
        return $this->transformPercent($this->alpha);
    }

    public function getRGB()
    {
        return implode (',', $this->getRGBArray());
    }

    public function getRGBArray()
    {
        return [
            $this->keyRed => $this->getRed(),
            $this->keyGreen => $this->getGreen(),
            $this->keyBlue => $this->getBlue()
        ];
    }

    public function getRGBA()
    {
        return implode(',', $this->getRGBAArray());
    }

    public function getRGBAArray()
    {
        return [
            $this->keyRed => $this->getRed(),
            $this->keyGreen => $this->getGreen(),
            $this->keyBlue => $this->getBlue(),
            $this->keyAlpha => $this->getAlpha()
        ];
    }

    public function getHex()
    {
        return '#' . implode($this->getHexArray());
    }

    public function getHexArray()
    {
        return [
            $this->keyRed => $this->transformHex($this->getRed()),
            $this->keyGreen => $this->transformHex($this->getGreen()),
            $this->keyBlue => $this->transformHex($this->getBlue())
        ];
    }

    public function getGrey()
    {
        return implode (',', $this->getGreyArray());
    }

    public function getGreyArray()
    {
        return [
            $this->keyRed => $this->getGreyValueRed(),
            $this->keyGreen => $this->getGreyValueGreen(),
            $this->keyBlue => $this->getGreyValueBlue(),
            $this->keyAlpha => $this->getAlpha()
        ];
    }

    public function getGreyValueRed()
    {
        return (int) $this->greyScaleRed * $this->getRed();
    }

    public function getGreyValueGreen()
    {
        return (int) $this->greyScaleGreen * $this->getGreen();
    }

    public function getGreyValueBlue()
    {
        return (int) $this->greyScaleBlue * $this->getBlue();
    }

    /**
     * TRANSFORMERS
     */

    public function transform255($value)
    {
        if ($value > 255) return 255;
        if ($value < 0) return 0;
        return (int) $value;
    }

    public function transformPercent($value)
    {
        if ($value > 1) return 1;
        if ($value < 0) return 0;
        return round((int) $value, 2);
    }

    public function transformHex($value, $prefix = '#')
    {
        $array = explode(',', $value);
        foreach($array as $k => $v) {
            $hex = dechex($this->transform255($v));
            $array[$k] = str_pad($hex, 2, STR_PAD_LEFT);
        }
        $return = implode('', $array);
        if (1 < count($array)) $return = $prefix . $return;
        return $return;
    }
}
