<?php
/**
 * Usage example for Image_Graph.
 * 
 * Main purpose: 
 * Demonstrate logarithmic axis
 * 
 * Other: 
 * Matrix layout, Axis titles
 * 
 * $Id: log_axis_forcemin.php,v 1.1 2006/02/28 22:48:07 nosey Exp $
 * 
 * @package Image_Graph
 * @author Jesper Veggerby <pear.nosey@veggerby.dk>
 */


require_once 'Image/Graph.php';    
require_once 'Image/Canvas.php';

$Canvas =& Image_Canvas::factory('png', array('width' => 400, 'height' => 300, 'antialias' => true));      

// create the graph
$Graph =& Image_Graph::factory('graph', $Canvas);
// add a TrueType font
$Font =& $Graph->addNew('font', 'Verdana');
// set the font size to 15 pixels
$Font->setSize(8);
// add a title using the created font

for ($i = 0; $i < 2; $i++) {
    for ($j = 0; $j < 2; $j++) {
        $Axis['X'][($i*2+$j)] = 'axis' . ($i % 2 == 0 ? '' : '_log'); 
        $Axis['Y'][($i*2+$j)] = 'axis' . ($j % 2 == 0 ? '' : '_log');
    }
}

for ($i = 0; $i < 4; $i++) {
    $Plotarea[$i] =& Image_Graph::factory('plotarea', array($Axis['X'][$i], $Axis['Y'][$i]));             
}

$Graph->setFont($Font);
// create the plotarea
$Graph->add(
    Image_Graph::vertical(
        Image_Graph::factory('title', array('Logarithmic Axis Set Minimum', 11)),               
        Image_Graph::vertical(
            Image_Graph::horizontal(
                Image_Graph::vertical(
                    Image_Graph::factory('title', array('Normal Y-Axis', array('size' => 10, 'angle' => 90))),
                    Image_Graph::factory('title', array('Logarithmic Y-Axis', array('size' => 10, 'angle' => 90)))                
                ),
                Image_Graph::horizontal(
                    Image_Graph::vertical(
                        Image_Graph::factory('title', array('Normal X-Axis', 10)),
                        Image_Graph::vertical(
                            $Plotarea[0],
                            $Plotarea[1]
                        ),
                        7
                    ),
                    Image_Graph::vertical(
                        Image_Graph::factory('Image_Graph_Title', array('Logarithmic X-Axis', 10)),
                        Image_Graph::vertical(
                            $Plotarea[2],
                            $Plotarea[3]
                        ),
                        7
                    )
                ),
                4
            ),            
            $Legend = Image_Graph::factory('Image_Graph_Legend'),
            92
        ),
        5            
    )
);
$Legend->setPlotarea($Plotarea[0]);

$Dataset = Image_Graph::factory('dataset');
$i = 1;
while ($i <= 10) {
    $Dataset->addPoint($i, $i*$i);
    $i++;
}

for ($i = 0; $i < 4; $i++) {
    $Plotarea[$i]->addNew('line_grid', false, IMAGE_GRAPH_AXIS_X);
    $Plotarea[$i]->addNew('line_grid', false, IMAGE_GRAPH_AXIS_Y);
    
    $Axis =& $Plotarea[$i]->getAxis(IMAGE_GRAPH_AXIS_Y);
    if ($i % 2 == 1) {
        $Axis->setLabelInterval(array(30, 45, 50, 65, 100));
    }
    $Axis->forceMinimum(25);
    $Axis->forceMaximum(125);

    $Axis =& $Plotarea[$i]->getAxis(IMAGE_GRAPH_AXIS_X);
    if ($i > 1) {
        $Axis->setLabelInterval(array(1, 2, 3, 4, 5, 6, 8, 10));
    }
    $Axis->forceMaximum(12);
        

    $Plot =& $Plotarea[$i]->addNew('line', array(&$Dataset));
    $Plot->setLineColor('red');
    $Plot->setTitle("x^2");
}
    
$Graph->done();
?>