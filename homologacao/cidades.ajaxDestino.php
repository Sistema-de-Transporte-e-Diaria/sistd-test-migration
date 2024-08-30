<?php
	
	include 'funcoes.php';
        conecta();
	$cod_estados2 = mysql_real_escape_string( $_REQUEST['cod_estados1'] );

	$cidades2 = array();

	$sql2 = "SELECT cod_cidades, nome
			FROM cidades
			WHERE estados_cod_estados=$cod_estados2
			ORDER BY nome";
	$res2 = mysql_query( $sql2 );
	while ( $row2 = mysql_fetch_assoc( $res2 ) ) {
		$cidades2[] = array(
			'cod_cidades'	=> $row2['cod_cidades'],
			'nome'			=> $row2['nome'],
		);
	}

	echo( json_encode( $cidades2 ) );