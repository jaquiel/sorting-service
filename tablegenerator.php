<?php 

include_once 'msorting.php';
class Data
{
	private $data;
	private $sortedData;
	private $header;
	private $params;
	
	function __construct($params = NULL)
	{
		$new_param = [];
		if ($params != NULL)
		{   
			foreach ($params as $param=>$value){
				foreach ($value as $val=>$v){
					if(($v != '') || ($v != ''))
					{
						$new_param[$param][$val] = $v;
					}
				}
			}
		}
		$this->setParams($new_param);
	}
	
	function setParams($params)
	{
		$this->params = $params;
	}
	
	function getParams()
	{
		return $this->params;
	}
	
	function setData($array)
	{
		$this->data = $array;
	}
	
	function getData()
	{
		return $this->data;
	}

	function setSortedData($array)
	{
		$this->sortedData = $array;
	}
	
	function getSortedData()
	{
		return $this->sortedData;
	}	
	
	function setHeader($array)
	{
		$this->header = $array;
	}
	
	function getHeader()
	{
		return $this->header;
	}
	
	
	function sortingData($array)
	{
		$array3 = [];
		$header = $this->getHeader();
		$countHeader = count($this->getHeader());
		$countRows = count($array);
		for ($j = 0; $j<$countRows;$j++) {
			for ($k = 0; $k<$countHeader;$k++) {
				$array2[$header[$k]] = $array[$j][$k];
			}
			array_push($array3,$array2);
		}
	    
		$params = $this->getParams();
		
		$orderedArray = array_msort($params, array('priority'=>SORT_ASC));
		
		$arrayAux = [];
		$sortedArray = $array3;
		foreach ($orderedArray as $param=>$value){
			if($param == '#')
				{ 
					if($value['ordering'] == 'ASC')
					{
						$arrayAux[0]['#'] = SORT_ASC;
					}
					
					if($value['ordering'] == 'DESC')
					{
						$arrayAux[0]['#'] = SORT_DESC;
					}
				}
				if($param == 'Title')
				{ 
					if($value['ordering'] == 'ASC')
					{
						$arrayAux[0]['Title'] = SORT_ASC;
					}

					if($value['ordering'] == 'DESC')					
					{
						$arrayAux[0]['Title'] = SORT_DESC;						
					}
				}
				if($param == 'Author')
				{ 
					if($value['ordering'] == 'ASC')
					{
						$arrayAux[0]['Author'] = SORT_ASC;
					}

					if($value['ordering'] == 'DESC')
					{
						$arrayAux[0]['Author'] = SORT_DESC;
					}
				}
				if($param == 'Edition Year')
				{ 
					if($value['ordering'] == 'ASC')
					{
						$arrayAux[0]['Edition Year'] = SORT_ASC;
					}

					if($value['ordering'] == 'DESC')
					{
						$arrayAux[0]['Edition Year'] = SORT_DESC;						
					}
				}
		}
	    
		$sortedArray = array_msort($array3, $arrayAux[0]);
	    $this->setSortedData($sortedArray);
	}

	function showDataFile($arquivo)
	{
		$array = [];
		$content = '<table class="table table-bordered table-hover table-condensed">';
		$f = fopen($arquivo, "r");
		while (($line = fgetcsv($f)) !== false) {
			if ($line[0] == '#')
			{
				$beginTable = '<thead>';
				$endTable = '</thead>';
				$beginTag = '<th>';
				$endTag = '</th>';
				$header = $line;
			}else
			{
				$beginTable = '<tbody>';
				$endTable = '</tbody>';
				$beginTag = '<td>';
				$endTag = '</td>';
				array_push($array, $line);
			}
			$content = $content . $beginTable;
			$content = $content . "<tr>";
			foreach ($line as $cell) {
				$content = $content .  $beginTag . htmlspecialchars($cell) . $endTag;
			}
			$content = $content .  $endTable;
		
		}
		fclose($f);

		$this->setHeader($header);
		$this->setData($array);
		$content = $content . "\n</table>";
		return $content;
		

	}
	
	function showSortedDataFile()
	{
		$this->sortingData($this->getData());
		$content = '<table class="table table-bordered table-hover table-condensed">';
		$content = $content . "<thead><tr><th>#</th><th>Title</th><th>Author</th><th>Edition Year</th></tr></thead>";
		$beginTable = "<tbody>";
		$endTable = '</tbody>';
		$beginTag = '<td>';
		$endTag = '</td>';
		$content =  $content . $beginTable . "<tr>";
		foreach ($this->getSortedData() as $line){
			$content =  $content . "<tr>";
			foreach ($line as $cell) {
				$content =  $content . $beginTag . $cell . $endTag;
			}
			$content =  $content . "</tr>\n";
		}
	
		$content =  $content . $endTable;
		$content =  $content . '</table>';
		return $content;
	}
	
}

?>