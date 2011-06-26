<?php
/**
 * Not a real usage example for Image_Graph.
 * 
 * Main purpose: 
 * Color chart of named colors
 * 
 * Other: 
 * Using canvass "outside" Image_Graph
 * 
 * $Id: color_chart.php,v 1.2 2005/08/03 21:21:52 nosey Exp $
 * 
 * @package Image_Graph
 * @author Jesper Veggerby <pear.nosey@veggerby.dk>
 */

error_reporting(E_ALL);
 
$file = file(dirname(__FILE__) . '/../colors.txt');

require_once 'Image/Canvas.php';
require_once 'Image/Canvas/Color.php';
require_once 'Image/Graph/Constants.php';

$Canvas =& Image_Canvas::factory('gd', array('width' => 600, 'height' => 1200));

$i = 0;
$cols = 10;
$Width = ($Canvas->getWidth() / $cols);
$rows = count($file) / $cols;
$rows = floor($rows) + ($rows > floor($rows) ? 1 : 0);
$Height = ($Canvas->getHeight() / $rows);
while (list($id, $color) = each($file)) {
    if ($id > 1) {      
        $color = trim($color);
        $x = ($i % $cols) * $Width + $Width / 2;
        $y = floor($i / $cols) * $Height;
        
        $Canvas->setLineColor('black');
        $Canvas->setFillColor($color);
                
        $Canvas->rectangle(
            array(
                'x0' => $x - $Width / 4, 
                'y0' => $y, 
                'x1' => $x + $Width / 4, 
                'y1' => $y + $Height / 3
                )
            );
            
        $Canvas->addText(
            array(
                'x' => $x, 
                'y' => $y + $Height / 3 + 3, 
                'text' => $color, 
                'alignment' => array('horizontal' => 'center', 'vertical' => 'top')
                )
            );
        
        $rgbColor = Image_Canvas_Color::color2RGB($color);
        $rgbs = 'RGB: ';
        unset($rgbColor[3]); 
        while (list($id, $rgb) = each($rgbColor)) {
            $rgbs .= ($rgb < 0x10 ? '0' : '') . dechex($rgb);
        }       
        $Canvas->addText(
            array(
                'x' => $x, 
                'y' => $y + $Height / 3 + 13, 
                'text' => $rgbs, 
                'alignment' => array('horizontal' => 'center', 'vertical' => 'top')
                )
            );
        $i++;
    }
}

$Canvas->show();      
?>