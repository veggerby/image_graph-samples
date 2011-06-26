<?php
/**
 * Usage example for Image_Graph.
 * 
 * Main purpose: 
 * Show line chart
 * 
 * Other: 
 * None specific
 * 
 * $Id: log_axis_low.php,v 1.1 2006/02/28 22:48:07 nosey Exp $
 * 
 * @package Image_Graph
 * @author Jesper Veggerby <pear.nosey@veggerby.dk>
 */

require_once 'Image/Graph.php';

// create the graph
$Graph =& Image_Graph::factory('graph', array(400, 300));

// add a TrueType font
$Font =& $Graph->addNew('font', 'Verdana');
// set the font size to 11 pixels
$Font->setSize(10);

$Graph->setFont($Font);

// setup the plotarea, legend and their layout
$Graph->add(
   Image_Graph::vertical(
      Image_Graph::factory('title', array('Small Values on Log Axis Chart Sample', 12)),        
      Image_Graph::vertical(
         $Plotarea = Image_Graph::factory('plotarea', array('axis_log', 'axis')),
         $Legend = Image_Graph::factory('legend'),
         88
      ),
      5
   )
);   

// link the legend with the plotares
$Legend->setPlotarea($Plotarea);

$Dataset =& Image_Graph::factory('dataset');
$Dataset->addPoint(0.063,5);
$Dataset->addPoint(0.125,7);
$Dataset->addPoint(0.25,8);
$Dataset->addPoint(0.5,10);
$Dataset->addPoint(1,15);
$Dataset->addPoint(2,30);
$Dataset->addPoint(4,45);
$Dataset->addPoint(8,80);
// create the plot as line chart using the dataset
$Plot =& $Plotarea->addNew('line', array(&$Dataset));

$Axis =& $Plotarea->getAxis(IMAGE_GRAPH_AXIS_X);
$Axis->forceMinimum(0.05);

// set a line color
$Plot->setLineColor('red');                  
     
// output the Graph
$Graph->done();
?>