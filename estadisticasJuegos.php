<?php
main();

/**
 * Metodo principal donde se precargan las esctructuras con datos y se llama al menú
 */
function main()
{
    $juegoMasVendido = precargaJuegoMasVendido();
    $tickets = precargaTickets($juegoMasVendido);
    menuOpciones($juegoMasVendido, $tickets);
}

/**
 * Se le pide al usuario que ingrese una opción del menú
 * Si la opción es valida se ejecuta, sino se pregunta de nuevo
 * @param array 
 * @param array 
 */
function menuOpciones($juegoMasVendido, $tickets)
{
    $opcion = null;
    while ($opcion != 6)
    {
        echo "\n";
        echo " ----------------------MENÚ-----------------------  \n";
        echo "| 1) Ingresar una venta                           | \n";
        echo "| 2) Mes con mayor monto de ventas                | \n";
        echo "| 3) Primer mes que supera un monto de ventas     | \n";
        echo "| 4) Información de un mes                        | \n";
        echo "| 5) Juegos mas vendidos ordenados                | \n";
        echo "| 6) Salir del menu                               | \n";
        echo " -------------------------------------------------  \n";
        echo "Opción: ";
        $opcion = trim(fgets(STDIN));
        switch ($opcion)
        {
            case 1:
                echo "\nOpcion 1 \n\n";
                $nuevaVenta = ingresarVenta();
                $tickets[$nuevaVenta["mes"]] += $nuevaVenta["precioTicket"] * $nuevaVenta["cantTickets"];
                $juegoMasVendido = modificarJuegoMasVendido($juegoMasVendido, $nuevaVenta);
                break;
            case 2:
                echo "\nOpción 2 \n\n";
                consultaMesMayorVentas($tickets, $juegoMasVendido);
                break;
            case 3:
                echo "\nOpción 3 \n\n";
                consultaMesSuperaMonto($tickets, $juegoMasVendido);
                break;
            case 4:
                echo "\nOpción 4 \n\n";
                consultaMes($tickets, $juegoMasVendido);
                break;
            case 5:
                echo "\nOpción 5 \n\n";
                ordenarMasVendido($juegoMasVendido);
                break;
            case 6:
                echo "\nSalió del menú \n\n";
                break;
            default:
                echo "\nOpción invalida \n\n";
        }
    }
}

/**
 * Se crea y cargan los datos a la estructura juegosMasVendidos
 * @return array
 */
function precargaJuegoMasVendido()
{
    $juegoMasVendido = array(
        array("juego" => "Montaña Rusa", "precioTicket" => 60, "cantTickets" => 90),
        array("juego" => "Gusano Loco", "precioTicket" => 42, "cantTickets" => 95),
        array("juego" => "Gusano Loco", "precioTicket" => 42, "cantTickets" => 89),
        array("juego" => "Vertigo Extremo", "precioTicket" => 57, "cantTickets" => 65),
        array("juego" => "Cubo Mágico", "precioTicket" => 34, "cantTickets" => 48),
        array("juego" => "Vertigo Extremo", "precioTicket" => 57, "cantTickets" => 64),
        array("juego" => "Cubo Mágico", "precioTicket" => 34, "cantTickets" => 150),
        array("juego" => "Autitos Chocadores", "precioTicket" => 75, "cantTickets" => 135),
        array("juego" => "Autitos Chocadores", "precioTicket" => 75, "cantTickets" => 80),
        array("juego" => "Cubo Mágico", "precioTicket" => 34, "cantTickets" => 168),
        array("juego" => "Montaña Rusa", "precioTicket" => 60, "cantTickets" => 157),
        array("juego" => "Vertigo Extremo", "precioTicket" => 57, "cantTickets" => 250)
    );
    return $juegoMasVendido;
}

/**
 * Ingresa la estructura precargada de juegoMasVendido y se utilizan sus datos para completar los del arreglo tickets
 * @param array 
 * @return array
 */
function precargaTickets($juegoMasVendido)
{
    $tickets = array();
    $i = 0;
    while ($i < count($juegoMasVendido))
    {
        $tickets[$i] = $juegoMasVendido[$i]["precioTicket"] * $juegoMasVendido[$i]["cantTickets"];
        $i++;
    }
    return $tickets;
}

/**
 * Lee un número
 * Si el número esta entre 0 y 11 devuele el mes correspondiente
 * @param int 
 * @return string
 */
function numeroAMes($numero)
{
    $nombre = null;
    switch ($numero)
    {
        case 0:
            $nombre = "enero";
            break;
        case 1:
            $nombre = "febrero";
            break;
        case 2:
            $nombre = "marzo";
            break;
        case 3:
            $nombre = "abril";
            break;
        case 4:
            $nombre = "mayo";
            break;
        case 5:
            $nombre = "junio";
            break;
        case 6:
            $nombre = "julio";
            break;
        case 7:
            $nombre = "agosto";
            break;
        case 8:
            $nombre = "septiembre";
            break;
        case 9:
            $nombre = "octubre";
            break;
        case 10:
            $nombre = "noviembre";
            break;
        case 11:
            $nombre = "diciembre";
            break;
        default:
            echo "Error en el número";
            break;
    }
    return $nombre;
}


/**
 * Entra por parametro el nombre de un mes
 * Lee el mes y devuelve el numero que le corresponde
 * @param string 
 * @return int
 */
function mesANumero($nombreMes)
{
    $indice = null;
    switch ($nombreMes)
    {
        case "enero":
            $indice = 0;
            break;
        case "febrero":
            $indice = 1;
            break;
        case "marzo":
            $indice = 2;
            break;
        case "abril":
            $indice = 3;
            break;
        case "mayo":
            $indice = 4;
            break;
        case "junio":
            $indice = 5;
            break;
        case "julio":
            $indice = 6;
            break;
        case "agosto":
            $indice = 7;
            break;
        case "septiembre":
            $indice = 8;
            break;
        case "octubre":
            $indice = 9;
            break;
        case "noviembre":
            $indice = 10;
            break;
        case "diciembre":
            $indice = 11;
            break;
        default:
            echo "Error en el nombre del mes";
            break;
    }
    return $indice;
}

/**
 * Solicita al usuario que ingrese un mes y se transforma a minusculas
 * Se verifica si es un nombre de mes valido
 * Si no es valido se vuelve a preguntar, caso contrario
 * se envia el mes a la funcion mesANumero y retorna
 * @return int
 */
function solicitarMes()
{
    $valido = false;
    while (!$valido)
    {
        echo "Ingrese un mes: ";
        $mes = trim(fgets(STDIN));
        $mesM = strtolower($mes);
        if ($mesM == "enero" || $mesM == "febrero" || $mesM == "marzo" || $mesM == "abril" || $mesM == "mayo" || $mesM == "junio" || $mesM == "julio" || $mesM == "agosto" || $mesM == "septiembre" || $mesM == "octubre" || $mesM == "noviembre" || $mesM == "diciembre")
        {
            $valido = true;
        }
        else
        {
            echo "Mes incorrecto.\n";
        }
    }
    return mesANumero($mesM);
}

/**
 * Se muestra al usuario los juegos disponibles
 * Se pide una opción
 * Si es una opción valida se devuelve el string del juego
 * Si es invalida se vuelve a pedir una opción
 * @return string
 */
function solicitarJuego()
{
    echo "Juego: \n";
    echo "1) Gusano Loco \n";
    echo "2) Autitos Chocadores \n";
    echo "3) Vertigo Extremo \n";
    echo "4) Montaña Rusa \n";
    echo "5) Cubo Mágico \n";
    $opcion = trim(fgets(STDIN));
    $juego = "ninguno";
    while ($juego == "ninguno")
    {
        switch ($opcion)
        {
            case 1:
                $juego = "Gusano Loco";
                break;
            case 2:
                $juego = "Autitos Chocadores";
                break;
            case 3:
                $juego = "Vertigo Extremo";
                break;
            case 4:
                $juego = "Montaña Rusa";
                break;
            case 5:
                $juego = "Cubo Mágico";
                break;
            default:
                echo "Opción incorrecta \n";
                echo "Elija una opción del 1 al 5";
                $opcion = trim(fgets(STDIN));
                break;
        }
    }
    return $juego;
}

/**
 * Se piden todos los datos necesarios para ingresar una venta
 * Se asignan los datos a un arreglo y se devuelve el mismo
 * @return array
 */
function ingresarVenta()
{
    $mes = solicitarMes();
    $juego = solicitarJuego();
    echo "Precio ticket: ";
    $precioTicket = trim(fgets(STDIN));
    echo "Cantidad de tickets vendidos: ";
    $cantTicket = trim(fgets(STDIN));
    return array(
        "mes" => $mes,
        "juego" => $juego,
        "precioTicket" => $precioTicket,
        "cantTickets" => $cantTicket,
    );
}

/**
 * Guardo el mes actual de la venta en una variable
 * Si no hay datos sobre ventas en el mes 
 * o el monto total del juego ingresado supera al mayor monto total del juego vendido el mismo mes
 * se ingresa al arreglo el monto total del juego nuevo
 * @param array 
 * @param array 
 * @return array
 */
function modificarJuegoMasVendido($juegoMasVendido, $nuevaVenta)
{
    $mesActual = $nuevaVenta["mes"];
    if (empty($juegoMasVendido[$mesActual]) || ($nuevaVenta["precioTicket"] * $nuevaVenta["cantTickets"]) > ($juegoMasVendido[$mesActual]["precioTicket"] * $juegoMasVendido[$mesActual]["cantTickets"]))
    {
        $juegoMasVendido[$mesActual] = array(
            "juego" => $nuevaVenta["juego"],
            "precioTicket" => $nuevaVenta["precioTicket"],
            "cantTickets" => $nuevaVenta["cantTickets"]
        );
    }
    return $juegoMasVendido;
}

/**
 * Precondicion: $tickets no debe ser vacio
 * Se envia $tickets a mesMayorVentas() que devuelve el indice del mes de mayor ventas
 * Se imprime la informacion de ese mes
 * @param array 
 * @param array 
 */
function consultaMesMayorVentas($tickets, $juegoMasVendido)
{
    $resultado = mesMayorVentas($tickets);
    echo "El mes con mayor monto de ventas es: \n";
    infoMes($tickets, $juegoMasVendido, $resultado);
}

/**
 * Si es la primera comparación se guarda el primer monto en un auxiliar (mayorMonto)
 * Luego se sigue preguntado si el monto actual es mayor al mayorMonto, de ser verdadero se reemplaza
 * Devuelve el indice del mes con mayor monto
 * @param array 
 * @return int
 */
function mesMayorVentas($tickets)
{
    $mayorMonto = null;
    $resultado = null;
    foreach ($tickets as $mes => $monto)
    {
        if ($monto != null)
        {
            if ($mayorMonto == null)
            {
                $mayorMonto = $monto;
                $resultado = $mes;
            }
            elseif ($monto > $mayorMonto)
            {
                $mayorMonto = $monto;
                $resultado = $mes;
            }
        }
    }
    return $resultado;
}

/**
 * Lee el monto ingresado por el usuario
 * Envía el monto a mesSuperaMonto que devuelve un indice
 * Si el indice es distinto de -1 muestra por pantalla la información del mes correspondiente
 * @param array 
 */
function consultaMesSuperaMonto($tickets, $juegoMasVendido)
{
    echo "Monto: $";
    $monto = trim(fgets(STDIN));
    $indiceMes = mesSuperaMonto($tickets, $monto);
    if ($indiceMes != -1)
    {
        echo "El primer mes en superar el monto ingresado es: \n";
        infoMes($tickets, $juegoMasVendido, $indiceMes);
    }
    else
    {
        echo "No se ha encontrado un mes que supere el monto ingresado.\n";
    }
}

/**
 * Se recorre el arreglo de $tickets
 * En cada indice se verifica si el monto del mes es mayor al monto ingresado por parametro
 * Si es verdadero, se termina de recorrer
 * Caso contrario se sigue preguntando con los otros indices
 * Si no se encontro un mes, el indice termina en -1 luego se devuelve el indice
 * @param array 
 * @return int
 */
function mesSuperaMonto($tickets, $monto)
{
    $encontrado = false;
    $i = 0;
    while (!$encontrado && $i < count($tickets))
    {
        if ($tickets[$i] > $monto)
        {
            $encontrado = true;
        }
        else
        {
            $i++;
        }
    }
    if (!$encontrado)
    {
        $i = -1;
    }
    return $i;
}

/**
 * Entran por paramtro los datos de los juegos vendidos
 * Se imprime por pantalla los datos del mes que se ingresó por parametro
 * @param array 
 * @param array 
 * @param int 
 */
function infoMes($tickets, $juegoMasVendido, $mesElegido)
{
    echo "<" . numeroAMes($mesElegido) . ">\n";
    echo "El juego con mayor monto de venta: " . $juegoMasVendido[$mesElegido]["juego"] . "\n";
    echo "Numero de Tickets Vendidos: " . $juegoMasVendido[$mesElegido]["cantTickets"] . "\n";
    echo "Venta total del juego: $" . ($juegoMasVendido[$mesElegido]["cantTickets"] * $juegoMasVendido[$mesElegido]["precioTicket"]) . "\n";
    echo "Monto total de ventas del mes: $" . $tickets[$mesElegido] . "\n";
}

/**
 * Se pide al usuario que ingrese un mes
 * Si hay datos cargados del mes ingresado se imprime por pantalla
 * @param array 
 * @param array 
 */
function consultaMes($tickets, $juegoMasVendido)
{
    $numeroMes = solicitarMes();
    if (empty($tickets[$numeroMes]) || empty($juegoMasVendido[$numeroMes]))
    {
        echo "Faltan los datos del mes ingresado.\n";
    }
    else
    {
        infoMes($tickets, $juegoMasVendido, $numeroMes);
    }
}

/**
 * Si hay datos del arreglo juegoMasVendido se reccore el mismo
 * Se crea una copia agregando los claves de montoVenta y mes
 * Se crea un arreglo que solo contiene el montoVentas de aux
 * Se ordenan de menor a mayor simultaneamente aux y montoVenta
 * Se imprime el arreglo completo
 * Lo que hace la función print_r es imprimir un arreglo de forma legible para un humano
 * manteniendo la asociacion de clave y valor
 * @param array 
 */
function ordenarMasVendido($juegoMasVendido)
{
    if (!empty($juegoMasVendido))
    {
        $i = 0;
        while ($i < count($juegoMasVendido))
        {
            if (!empty($juegoMasVendido[$i]))
            {
                $aux[$i] = array(
                    "mes" => numeroAMes($i),
                    "juego" => $juegoMasVendido[$i]["juego"],
                    "precioTicket" => $juegoMasVendido[$i]["precioTicket"],
                    "cantTickets" => $juegoMasVendido[$i]["cantTickets"],
                    "montoVenta" => $juegoMasVendido[$i]["precioTicket"] * $juegoMasVendido[$i]["cantTickets"]
                );
            }
            $i++;
        }
        $montoVenta = array_column($aux, "montoVenta");
        array_multisort($montoVenta, SORT_ASC, $aux);
        print_r($aux);
    }
    else
    {
        echo "No hay datos disponibles. \n";
    }
}
