<?php
class Presupuesto{
	public function getPresupuesto($consulta){
		$consulta = json_decode($consulta,true);
		$jsonARetornar = array();
		$jsonARetornar['token']= $consulta['token'];
		$total = 0;
		foreach ($consulta['items'] as $item){
			$itemARetornar = $item;
			$itemARetornar['precioUnitario'] = $this->getRandom();
			$itemARetornar['subtotal'] = number_format($itemARetornar['precioUnitario']*$itemARetornar['cantidad'],2,".","");
			$total += $itemARetornar['subtotal'];
			$jsonARetornar['items'][] = $itemARetornar;
		}
		$jsonARetornar['total'] = number_format($total,2,".","");;
		return json_encode($jsonARetornar);
	}
	protected function getRandom($digitos = 5){
		return number_format((rand(str_pad(1, $digitos+2,"0"),str_pad(9, $digitos+2,"9"))/100),2,".","");
	}
}

$presupuesto = new Presupuesto();
$consulta = $_POST['q'];
echo $presupuesto->getPresupuesto($consulta);