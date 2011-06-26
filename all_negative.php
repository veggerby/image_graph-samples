<?php
/**
 * Usage example for Image_Graph.
 * 
 * Main purpose: 
 * Axis arrows when all values are negative
 * 
 * Other: 
 * None specific
 * 
 * $Id: all_negative.php,v 1.1 2005/11/27 22:21:17 nosey Exp $
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
      Image_Graph::factory('title', array('Arrow Position on All Negative', 12)),        
      Image_Graph::horizontal(
         $Plotarea1 = Image_Graph::factory('plotarea'),
         $Plotarea2 = Image_Graph::factory('plotarea'),
         50
      ),
      5
   )
);   

$Dataset1 =& Image_Graph::factory('dataset');
$Dataset1->addPoint('a', 19);
$Dataset1->addPoint('b', 12);
$Dataset1->addPoint('c', 16);
$Dataset1->addPoint('d', 7);
$Dataset1->addPoint('e', 21);
$Dataset1->addPoint('f', 14);
$Dataset1->addPoint('g', 16);
$Plot1 =& $Plotarea1->addNew('line', array(&$Dataset1));
$Plot1->setLineColor('red');                  

$AxisY1 =& $Plotarea1->getAxis('y');
$AxisY1->showArrow();                  

$Dataset2 =& Image_Graph::factory('dataset');
$Dataset2->addPoint('a', -19);
$Dataset2->addPoint('b', -12);
$Dataset2->addPoint('c', -16);
$Dataset2->addPoint('d', -7);
$Dataset2->addPoint('e', -21);
$Dataset2->addPoint('f', -14);
$Dataset2->addPoint('g', -16);
$Plot2 =& $Plotarea2->addNew('line', array(&$Dataset2));
$Plot2->setLineColor('red');

$AxisY2 =& $Plotarea2->getAxis('y');
$AxisY2->showArrow();                  
     
// output the Graph
$Graph->done();
?>