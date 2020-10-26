<?php
// ダウンロードした以下のファイルを読み込む
require_once ('graph/jpgraph.php');
require_once ('graph/jpgraph_bar.php');

// 縦軸のデータ
$x_data = array(1,5,10);
 
// グラフの生成
$graph = new Graph(400, 300);
$graph->SetScale('textlin');
 
$graph->SetMarginColor('white');
 
// タイトル
$graph->title->Set('graph');
 
// グラフ表示
$bar = new BarPlot($x_data);
$bar->value->Show();
$graph->Add($bar);
$graph->Stroke();
 
?>
 