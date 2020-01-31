<?php 

class Postagem
{
	public static function selecionaTodos()
	{
		$con = Connection::getConn();
		$sql= "SELECT * FROM postagem ORDER BY id DESC";
		$sql = $con->prepare($sql);
		$sql->execute();

		$resultado = array();

		while ($row = $sql->fetchObject('Postagem')){
			$resultado[] = $row;
		}
		if (!$resultado) {
			throw new Exception("Não foi encontrado nenhum resultado no Banco de Dados");
		} 
		return $resultado;
	}



	

	public static function selecionaPorId($idPost)
	{
		$con = connection::getConn();

		$sql = "SELECT * FROM postagem WHERE id = :id";
		$sql = $con->prepare($sql);
		$sql-> bindValue(':id', $idPost, PDO::PARAM_INT);
		$sql-> execute();

		$resultado = $sql->fetchObject('Postagem');
		
		if (!$resultado){
			throw new Exception("Não foi encontrado nenhum resultado no Banco de Dados");
		} else {
			$resultado->comentarios = Comentario::selecionarComentarios($resultado->id);
			if (!$resultado->comentarios){
				$resultado->comentarios = 'Não existe comentário para essa postagem!';
			}
		}

		return $resultado;
	}
}