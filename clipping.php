<?php
/**
 * Usage example for Image_Graph.
 * 
 * Main purpose: 
 * Demonstrate a "semi-real" graph
 * 
 * Other: 
 * None specific
 * 
 * $Id: clipping.php,v 1.2 2006/02/28 22:48:07 nosey Exp $
 * 
 * @package Image_Graph
 * @author Jesper Veggerby <pear.nosey@veggerby.dk>
 */

require_once 'Image/Graph.php';    

$Graph =& Image_Graph::factory('graph', array(400, 300));

$Font =& $Graph->addNew('font', 'Verdana');
$Font->setSize(8);

$Graph->setFont($Font);

$Graph->add(
    Image_Graph::vertical(
        Image_Graph::vertical(
            Image_Graph::factory('title', array('Weather Conditions by Month', 12)),
            Image_Graph::factory('title', array('Location: Århus, Denmark', 8)),
            80
        ),
        Image_Graph::vertical(
            $Plotarea_Weather = Image_Graph::factory('plotarea'),
            $Legend_Weather = Image_Graph::factory('legend'),
            85
        ),
    9)
);
$Legend_Weather->setPlotarea($Plotarea_Weather);

$GridY_Weather =& $Plotarea_Weather->addNew('line_grid', null, IMAGE_GRAPH_AXIS_Y);
$GridY_Weather->setLineColor('gray@0.1');

$Dataset_TempAvg =& Image_Graph::factory('dataset');
$Dataset_TempAvg->addPoint("Jan\n2005", 0.2);
$Dataset_TempAvg->addPoint("Feb\n2005", 0.1);
$Dataset_TempAvg->addPoint("Mar\n2005", 2.3);
$Dataset_TempAvg->addPoint("Apr\n2005", 5.8);
$Dataset_TempAvg->addPoint("May\n2005", 10.8);
$Dataset_TempAvg->addPoint("Jun\n2005", 14.1);
$Dataset_TempAvg->addPoint("Jul\n2005", 16.2);
$Dataset_TempAvg->addPoint("Aug\n2005", 15.9);
$Dataset_TempAvg->addPoint("Sep\n2005", 12.1);
$Dataset_TempAvg->addPoint("Oct\n2005", 8.7);
$Dataset_TempAvg->addPoint("Nov\n2005", 4.4);
$Dataset_TempAvg->addPoint("Dec\n2005", 1.8);
$Plot_TempAvg =& $Plotarea_Weather->addNew('smooth_line', array(&$Dataset_TempAvg));
$Plot_TempAvg->setLineColor('blue');
$Plot_TempAvg->setTitle('Average temperature');

$Dataset_TempMin =& Image_Graph::factory('dataset');
$Dataset_TempMin->addPoint("Jan\n2005", -2.7);
$Dataset_TempMin->addPoint("Feb\n2005", -2.8);
$Dataset_TempMin->addPoint("Mar\n2005", -0.9);
$Dataset_TempMin->addPoint("Apr\n2005", 1.2);
$Dataset_TempMin->addPoint("May\n2005", 5.5);
$Dataset_TempMin->addPoint("Jun\n2005", 9.2);
$Dataset_TempMin->addPoint("Jul\n2005", 11.3);
$Dataset_TempMin->addPoint("Aug\n2005", 11.1);
$Dataset_TempMin->addPoint("Sep\n2005", 7.8);
$Dataset_TempMin->addPoint("Oct\n2005", 5.0);
$Dataset_TempMin->addPoint("Nov\n2005", 1.5);
$Dataset_TempMin->addPoint("Dec\n2005", -0.9);
$Plot_TempMin =& $Plotarea_Weather->addNew('smooth_line', array(&$Dataset_TempMin));
$Plot_TempMin->setLineColor('teal');
$Plot_TempMin->setTitle('Minimum temperature');

$Dataset_TempMax =& Image_Graph::factory('dataset');
$Dataset_TempMax->addPoint("Jan\n2005", 2.4);
$Dataset_TempMax->addPoint("Feb\n2005", 2.5);
$Dataset_TempMax->addPoint("Mar\n2005", 5.4);
$Dataset_TempMax->addPoint("Apr\n2005", 10.5);
$Dataset_TempMax->addPoint("May\n2005", 15.8);
$Dataset_TempMax->addPoint("Jun\n2005", 18.9);
$Dataset_TempMax->addPoint("Jul\n2005", 21.2);
$Dataset_TempMax->addPoint("Aug\n2005", 20.8);
$Dataset_TempMax->addPoint("Sep\n2005", 16.3);
$Dataset_TempMax->addPoint("Oct\n2005", 11.8);
$Dataset_TempMax->addPoint("Nov\n2005", 6.9);
$Dataset_TempMax->addPoint("Dec\n2005", 4.1);
$Plot_TempMax =& $Plotarea_Weather->addNew('smooth_line', array(&$Dataset_TempMax));
$Plot_TempMax->setLineColor('red');
$Plot_TempMax->setTitle('Maximum temperature');

$Marker_AverageSpan =& $Plotarea_Weather->addNew('Image_Graph_Axis_Marker_Area', IMAGE_GRAPH_AXIS_Y);
$Marker_AverageSpan->setFillColor('green@0.2');
$Marker_AverageSpan->setLowerBound(3.8);
$Marker_AverageSpan->setUpperBound(11.4);

$Marker_Average =& $Plotarea_Weather->addNew('Image_Graph_Axis_Marker_Line', IMAGE_GRAPH_AXIS_Y);
$Marker_Average->setLineColor('blue@0.4');
$Marker_Average->setValue(7.7);
 
$DataPreprocessor_DegC =& Image_Graph::factory('Image_Graph_DataPreprocessor_Formatted', '%d C');

$AxisX_Weather =& $Plotarea_Weather->getAxis(IMAGE_GRAPH_AXIS_X);
$AxisX_Weather->setAxisIntersection('min');

$AxisY_Weather =& $Plotarea_Weather->getAxis(IMAGE_GRAPH_AXIS_Y);
$AxisY_Weather->showLabel(IMAGE_GRAPH_LABEL_ZERO);
$AxisY_Weather->setDataPreprocessor($DataPreprocessor_DegC);
$AxisY_Weather->setTitle('Temperature', 'vertical');

$AxisY_Weather->forceMinimum(5);

// output the graph
$Graph->setPadding(10);
$Graph->done();
?>