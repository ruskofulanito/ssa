<?php
class Presupuesto{
	public function getPresupuesto($consulta){
		$consulta = json_decode($consulta,true);
		$jsonARetornar = array("objetos"=>array());
		//$jsonARetornar['token']= $consulta['token'];
		$total = 0;
		foreach ($consulta['objetos'] as $item){
			$itemARetornar = $item;
			$itemARetornar['precioUnitario'] = $this->getRandom();
			$itemARetornar['subtotal'] = number_format($itemARetornar['precioUnitario']*$itemARetornar['cantidad'],2,".","");
			$total += $itemARetornar['subtotal'];
			array_push($jsonARetornar['objetos'], $itemARetornar);
		}
		$jsonARetornar['total'] = number_format($total,2,".","");;
		return json_encode($jsonARetornar, JSON_UNESCAPED_UNICODE);
	}
	protected function getRandom($digitos = 5){
		return number_format((rand(str_pad(1, $digitos+2,"0"),str_pad(9, $digitos+2,"9"))/100),2,".","");
	}
}

$presupuesto = new Presupuesto();
$consulta = file_get_contents('php://input');
header("Content-type: application/json; charset=utf-8");
echo $presupuesto->getPresupuesto($consulta);
