<?php

namespace App\Http\Controllers;

use Neoxygen\NeoClient\ClientBuilder;
use Illuminate\Support\Facades\Input;
use Log;

class GraphController extends Controller{

    public function main() {
    	return view('graph');
   }

	public function importData() {

	}

	public function getGraphList() {
		$client = ClientBuilder::create()
	    ->addConnection('default', 'http', 'localhost', 7474, true, 'neo4j', 'webapp')
	    ->setAutoFormatResponse(true)
	    ->build();

	    $graph_list = [];
		$q = 'Match(n:Database) return n';
		$results = $client->sendCypherQuery($q)->getResult()->getTableFormat();
		foreach($results as $key => $result) {
      		array_push($graph_list, $result['n']['name']);
    	}
    	sort($graph_list);
		return response()->json(['graph_name' => $graph_list]);
	}

	public function getGraphData() {
		$client = ClientBuilder::create()
	    ->addConnection('default', 'http', 'localhost', 7474, true, 'neo4j', 'webapp')
	    ->setAutoFormatResponse(true)
	    ->build();

	    $label  = Input::get('graph_name');

	    $q = 'MATCH (n:' . $label . ') RETURN n,ID(n) as n_id';
	    $results = $client->sendCypherQuery($q)->getResult()->getTableFormat();
	    $node_list = array();
	    $edge_list = array();
	    $node_count = sizeof($results);
	    foreach($results as $key => $result) {
	      	$user_info = [
		        'label' => $result['n']['number'],
		    	'x' => 10*cos(2 * $key * M_PI/$node_count),
		        'y' => 10*sin(2 * $key * M_PI/$node_count),
		        'id' => $result['n_id'],
		        'color' => '#a5adb0',
		        'size' => 1
	      	];
	      	array_push($node_list, $user_info);
	    }

	    $q = 'MATCH (n:' . $label . ')-[r]->(m:' . $label . ') RETURN ID(n) as n_id, r, ID(r) as r_id, ID(m) as m_id';
	    $results = $client->sendCypherQuery($q)->getResult()->getTableFormat();
	    $node_count = sizeof($results);
	    foreach($results as $key => $result) {
	      	$edge_info = [
	      		'source' => $result['n_id'],
		    	'target' => $result['m_id'],
		    	'color' => '',
		    	'id' => $result['r_id'],
		    	'size' => 1
		    ];
		    array_push($edge_list, $edge_info);
	    }
	    return  response()->json(['nodes' => $node_list, 'edges' => $edge_list]);
	}

	public function importGraphData() {
		$client = ClientBuilder::create()
	    ->addConnection('default', 'http', 'localhost', 7474, true, 'neo4j', 'webapp')
	    ->setAutoFormatResponse(true)
	    ->build();

	    $graph_data  = Input::get('graph_data');
	    $label = Input::get('database_name');
	    foreach($graph_data as $source => $target) {
	    	$q = 'MERGE (p:'.$label.' { number:"'.$source.'"}) MERGE (q:'.$label.' { number:"'.$target.'"}) CREATE (p)-[r:Link]->(q)';
	    	$results = $client->sendCypherQuery($q);
	    }
	    return "Import Data success";
	}

	public function createDatabase() {
		$client = ClientBuilder::create()
	    ->addConnection('default', 'http', 'localhost', 7474, true, 'neo4j', 'webapp')
	    ->setAutoFormatResponse(true)
	    ->build();

	    $label  = Input::get('database_name');
	    $q = 'Merge (n:Database{name:"'.$label.'"})';
	    $results = $client->sendCypherQuery($q);
	    return "Create Database success";
	}

	public function deleteDatabase() {
		$client = ClientBuilder::create()
	    ->addConnection('default', 'http', 'localhost', 7474, true, 'neo4j', 'webapp')
	    ->setAutoFormatResponse(true)
	    ->build();

	    $label  = Input::get('database_name');
	    $q = 'MATCH (n:Database{name:"'.$label.'"}) DETACH DELETE n';
	    $results = $client->sendCypherQuery($q);
	    $r = 'MATCH (n:'.$label.') DETACH DELETE n';
	    $results = $client->sendCypherQuery($r);
	    return "Delete Database success";
	}
}
?>
