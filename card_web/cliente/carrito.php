<?php
session_start();

class carrito 
{
    protected $carritoContenido = array();
    function __construct()
    {
        $this->carritoContenido = !empty($_SESSION['carritoContenido'])?$_SESSION['carritoContenido']:NULL;
		if ($this->carritoContenido === NULL){
			$this->carritoContenido = array('carritoTotal' => 0, 'TotalProductos' => 0);
		}
    }
	
	public function contents()
    {
		$carrito = array_reverse($this->carritoContenido);

		unset($carrito['TotalProductos']);
		unset($carrito['carritoTotal']);

		return $carrito;
	}
    public function get_item($ProductoID)
    {
		return (in_array($ProductoID, array('TotalProductos', 'carritoTotal'), TRUE) OR ! isset($this->carritoContenido[$ProductoID]))
			? FALSE
			: $this->carritoContenido[$ProductoID];
	}
	public function total_productos()
    {
		return $this->carritoContenido['TotalProductos'];
	}
	public function total()
    {
		return $this->carritoContenido['carritoTotal'];
	}
    protected function save_cart(){
		$this->carritoContenido['TotalProductos'] = $this->carritoContenido['carritoTotal'] = 0;
		foreach ($this->carritoContenido as $key => $val){
			if(!is_array($val) OR !isset($val['precio'], $val['cantidad'])){
				continue;
			}
			$this->carritoContenido['carritoTotal'] += ($val['precio'] * $val['cantidad']);
			$this->carritoContenido['TotalProductos'] += $val['cantidad'];
			$this->carritoContenido[$key]['subtotal'] = ($this->carritoContenido[$key]['precio'] * $this->carritoContenido[$key]['cantidad']);
		}
		if(count($this->carritoContenido) <= 2){
			unset($_SESSION['carritoContenido']);
			return FALSE;
		}else{
			$_SESSION['carritoContenido'] = $this->carritoContenido;
			return TRUE;
		}
    }
	public function insert($articulo = array())
    {
		if(!is_array($articulo) OR count($articulo) === 0)
        {
			return FALSE;
		}
        else
        {
            if(!isset($articulo['id_producto'], $articulo['nombre_producto'], $articulo['precio'], $articulo['cantidad']))
            {
                return FALSE;
            }
            else
            {
                $articulo['cantidad'] = (float) $articulo['cantidad'];
                if($articulo['cantidad'] == 0){
                    return FALSE;
                }
                $articulo['precio'] = (float) $articulo['precio'];
                $ProductoID = md5($articulo['id_producto']);
                $old_qty = isset($this->carritoContenido[$ProductoID]['cantidad']) ? (int) $this->carritoContenido[$ProductoID]['cantidad'] : 0;
                $articulo['ProductoID_producto'] = $ProductoID;
                $articulo['cantidad'] += $old_qty;
                $this->carritoContenido[$ProductoID] = $articulo;
                if($this->save_cart())
                {
                    return isset($ProductoID) ? $ProductoID : TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
        }
	}
	    
    /**
	 * Remove Item: Elimina un producto del carrito
	 * @param	int
	 * @return	bool
	 */

	// Función para eliminar un producto
	public function eliminar($ProductoID){
		// altera la tabla y guarda los productos restantes
		unset($this->carritoContenido[$ProductoID]);
		$this->save_cart();
		return TRUE;	
	 }
     
    /**
	 * Destroy the cart: Si el carro queda vacio se destruye de la sesión
	 * @return	void
	 */
    //Función para eliminar un producto

		
	 
    //Función para destruir o vaciar el carro
	public function destroy(){
		$this->carritoContenido = array('carritoTotal' => 0, 'total_productos' => 0);
		unset($_SESSION['carritoContenido']);
	}
}
?>