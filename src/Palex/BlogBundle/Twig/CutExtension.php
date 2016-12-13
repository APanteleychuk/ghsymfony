<?php

namespace Palex\BlogBundle\Twig;

class CutExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('cut', [$this, 'cutFilter']),
        ];
    }

    /**
     * @param $text
     * @param $quantity
     * @param string $ending
     * @return string
     */
    public function cutFilter($text, $quantity = '', $ending = '...')
    {
        if($quantity === ''){
            $quantity = strlen($text);
        }
        $text = substr($text, 0, $quantity);
        $text = $text.$ending;
        return $text;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cut_extension';
    }
}
