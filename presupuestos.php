<?php
class Presupuesto{
	public function getPresupuesto($consulta){
		$consulta = json_decode($consulta,true);
		$jsonARetornar = array("status"=>"ok", "objetos"=>array());
		//$jsonARetornar['token']= $consulta['token'];
		$total = 0;
		if (is_array($consulta) && is_array($consulta['objetos'])) {
			foreach ($consulta['objetos'] as $item){
				$precio = $this->getRandom();
				$subtotal = number_format($precio*$item['cantidad'], 2, ".", "");
				$itemARetornar = ["id"=>$item[id], "precioUnitario"=>$precio, "subtotal" => $subtotal];
				$total += $subtotal;
				array_push($jsonARetornar['objetos'], $itemARetornar);
			}
			$jsonARetornar['total'] = number_format($total,2,".","");;
			return json_encode($jsonARetornar, JSON_UNESCAPED_UNICODE);
		} else {
			return json_encode(["status" => "error"]);
		}
	}
	protected function getRandom($digitos = 5){
		return number_format((rand(str_pad(1, $digitos+2,"0"),str_pad(9, $digitos+2,"9"))/100),2,".","");
	}
}

$presupuesto = new Presupuesto();
$consulta = file_get_contents('php://input');
header("Content-type: application/json; charset=utf-8");
echo $presupuesto->getPresupuesto($consulta);
