<?php
	require_once ('../config.php');
    require_once ( '../template/header.php');       
?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

    <head>
        <title>JuriLink ~ Basic</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css" />
        <link rel="stylesheet" href="bootstrap/css/jurilink.css" />   
    </head>

    <body>

        <div class="container"  >
            <div class="row show-grid">
                <!------ Conexão com o BD e busca -->
				<?php 
					$conexao1 = new CConexao();
					$conexao = $conexao1->novaConexao();
					$result = pg_query($conexao, "SELECT nome, id_juizo FROM juizo");

					if (!$result) {
						echo "Um erro ocorreu.\n";
						exit;
					}
				?>
				
                <div class="span6 drop">
                    <div class="drag">
                        <div class="barra-titulo">
                            <div class="esquerda">
                                <h3>
                                    Juizos
                                </h3>
                            </div>
                            <div class="direita">
                                <a class="btn btn-small btn-success" href="#">
                                    <i class="icon-plus icon-white"></i>
									
                                </a>
                            </div>
                        </div>
                        <div class="tabela"> 
								<?php
									echo "<table = 'teste' class=table table-striped table-condensed >";
										echo "<thead>";
										echo "<tr><th>Nome</th></tr></thead>";
										echo "<tbody>";
										while ($row = pg_fetch_row($result)) {
											echo "<tr>
													<td>".$row[0]."</td>
													<td>".$row[1]."</td>
													<td>
														<a class=btn btn-small btn-success href= '#' onClick='getIdJuizo($row[1])'>
															<i class=icon-minus icon-white></i>
									                    </a>
													</td>
												</tr>";
										}
									echo "</tbody>";
									echo "</table>";
								?>
						</div>
						<form name = "formulario_juizo_excluir" action="../operacoes/CJuizo/excluir_juizo_op.php" method="post">
							<input type="hidden" name="id_juizo_excluir" value="-1">
						</form>
                    </div>
                </div>
            
                       </div> <!-- Div de linha --->

            <div class="row show-grid">
                <div class="span12 drop">
                </div>
            </div>
        </div>

        

       

        <!------ Scripts -->

        <script type="text/javascript" src="drag/src/prototype.js"></script>
        <script type="text/javascript"  src="drag/src/scriptaculous.js" ></script> 
        <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>    
        <script type="text/javascript" src="../../jurilink_js.js"></script>    

        <script type="text/javascript">                                                        
                              
        </script>

    </body>
</html>