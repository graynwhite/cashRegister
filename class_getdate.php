<?php
class getdate {
public $outstart;
public $outend;
private $hoursStart=" 00:00:00";
private $hoursEnd= " 23:59:59";

function getDateHandler($inStart,$inEnd){

if ($inStart == ''){
$this->outstart=date('Y-m-d'). $this->hoursStart;
$this->outend=date('Y-m-d') . $this->hoursEnd;

}

if ($inStart != '' && $inEnd == ''){
	$datework=explode('-',$inStart);
	if(strlen($datework[0]) <4){
		$this->outstart=$datework[2]."-".$datework[0]."-".$datework[1]. $this->hoursStart;
		$this->outend = $datework[2]."-".$datework[0]."-".$datework[1]. $this->hoursEnd;
		}else{
		$this->outstart = $inStart . $this->hoursStart;
		$this->outend = $inStart . $this->hoursEnd;
		}
		}
If($inStart != '' && $inEnd != ''){
	$datework=explode('-',$inStart);
	if(strlen($datework[0]) <4){
		$this->outstart=$datework[2]."-".$datework[0]."-".$datework[1] . $this->hoursStart;
		}else{
		$this->outstart=$inStart . $this->hoursStart;
		}
	$datework+explode('-',$inEnd);	
	if(strlen($datework[0]) <4){
		$this->outend=$datework[2]."-".$datework[0]."-".$datework[1] . $this->hoursEnd;
		}else{
		$this->outend=$inEnd . $this->hoursEnd;
		}	
		
}

return array($this->outstart,$this->outend);

} // end of function

} // end of class
?>