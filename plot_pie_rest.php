<?php
/**
 * Usage example for Image_Graph.
 * 
 * Main purpose: 
 * Show pie chart
 * 
 * Other: 
 * None specific
 * 
 * $Id: plot_pie_rest.php,v 1.1 2005/10/13 20:18:27 nosey Exp $
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
$Font->setSize(8);

$Graph->setFont($Font);

// setup the plotarea, legend and their layout
$Graph->add(
   Image_Graph::vertical(
      Image_Graph::factory('title', array('Pie Chart Sample', 12)),        
      Image_Graph::vertical(
         $Plotarea = Image_Graph::factory('plotarea'),
         $Legend = Image_Graph::factory('legend'),
         70
      ),
      5
   )
);
$Legend->setPlotArea($Plotarea);
$Plotarea->hideAxis();

// create the dataset
$Dataset =& Image_Graph::factory('dataset', 
    array(
        array(
            'Monkey' => 12,
            'Cat' => 14,
            'Dog' => 13,
            'Platypuss' => 29,
            'Spider' => 5,
            'Elephant' => 9,
            'Gerbil' => 3,
            'Mouse' => 19,
            'Fly' => 11
        )
    )
);

// create the 1st plot as smoothed area chart using the 1st dataset
$Plot =& $Plotarea->addNew('Image_Graph_Plot_Pie', $Dataset);

$Plot->setRestGroup(11, 'Other animals');

$Plot->Radius = 2;
	
// set a line color
$Plot->setLineColor('gray');

// set a standard fill style
$FillArray =& Image_Graph::factory('Image_Graph_Fill_Array');
$Plot->setFillStyle($FillArray);
$FillArray->addColor('green@0.2');
$FillArray->addColor('blue@0.2');
$FillArray->addColor('yellow@0.2');
$FillArray->addColor('red@0.2');
$FillArray->addColor('orange@0.2');
$FillArray->addColor('black@0.2', 'rest');

$Plot->explode(10);


// create a Y data value marker
$Marker =& $Plot->addNew('Image_Graph_Marker_Value', IMAGE_GRAPH_PCT_Y_TOTAL);
// fill it with white
$Marker->setFillColor('white');
// and use black border
$Marker->setBorderColor('black');
// and format it using a data preprocessor
$Marker->setDataPreprocessor(Image_Graph::factory('Image_Graph_DataPreprocessor_Formatted', '%0.1f%%'));
$Marker->setFontSize(7);

// create a pin-point marker type
$PointingMarker =& $Plot->addNew('Image_Graph_Marker_Pointing_Angular', array(20, &$Marker));
// and use the marker on the plot
$Plot->setMarker($PointingMarker);

// output the Graph
$Graph->done();
?>
