<?php

namespace App\Models;

use Exception;
use Src\Database\Sql;
use Src\Application\Model;

class Image extends Model
{
    private $iduser;
    private $imgname;
    private $imgsize;
    private $imgtype;
    private $imgtmp;

    const ERROR = "ImageError";
	const ERROR_REGISTER = "ImageErrorRegister";
    const SUCCESS = "ImageSucesss";

    const BASE_UPLOAD_DIR = 'res/admin/dist/img/perfil-update/'; // diretório base onde sera feito o upload
    const EXT_TYPE = array('jpg','jpe','jpeg','png'); // array contendo as extensões permitidas
    const LIMIT_SIZE = 80000; // tamanho máximo permitido em bytes
    const FILENAME_MAX_SIZE = 80; // quantidade de caracteres permitido no nome
    
    public function select()
    {
        $sql = "SELECT * FROM tb_users_perfils_images WHERE iduser = :IDUSER";
        
        $conn = new Sql();
        $results = $conn->select($sql, array(
            ':IDUSER' => $this->__get('iduser')
        ));

        return $results;
    }

    /**
     * Faz o insert de uma imagem na tabela
     */
    public function insertImgUser()
    {
        $sql = "INSERT INTO tb_users_perfils_images (iduser, imgname, imgsize, imgtype, imgtmp)
                VALUES (:IDUSER, :IMGNAME, :IMGSIZE, :IMGTYPE, :IMGTMP)";
        
        $conn = new Sql();
        $conn->query($sql, array(
            ':IDUSER' => $this->__get('iduser'),
            ':IMGNAME' => $this->__get('imgname'), 
            ':IMGSIZE' => $this->__get('imgsize'),
            ':IMGTYPE' => $this->__get('imgtype'),
            ':IMGTMP' => $this->__get('imgtmp')
        ));
    }

    /**
     * Faz o update de uma foto na tabela
     */
    public function updateImgUser()
    {
        $sql = "UPDATE tb_users_perfils_images SET 
                imgname = :IMGNAME,
                imgsize = :IMGSIZE, 
                imgtype = :IMGTYPE,
                imgtmp  = :IMGTMP
                WHERE iduser = :IDUSER";
        
        $conn = new Sql();
        $conn->query($sql, array(
            ':IDUSER' => $this->__get('iduser'),
            ':IMGNAME' => $this->__get('imgname'), 
            ':IMGSIZE' => $this->__get('imgsize'),
            ':IMGTYPE' => $this->__get('imgtype'),
            ':IMGTMP' => $this->__get('imgtmp')
        ));
    }



    // Faz o insert ou o update da imagem no BD e envia ou apaga o arquivo da pasta upload
    public function insertOrUpdateImg($files)
    {
        $results = $this->select();

        if (count($results) > 0)
        {
            // faz o upload do arquivo para a pasta
            if ($data = $this->uploadImg($files))
            {
                // faz o set automatico do array passado da função uploadImg
                $this->setData($data);

                // remove o arquivo antigo contido na pasta upload
                unlink(Image::BASE_UPLOAD_DIR . $results[0]["imgname"]);
                $this->updateImgUser();

                return true;
            }
            else
            {
                throw new \Exception("Erro ao atualizar a imagem. Contate do administrador do site.");
            }
        }
        else
        {
            // faz o upload do arquivo para a pasta
            if ($data = $this->uploadImg($files))
            {
                // faz o set automatico do array passado da função uploadImg
                $this->setData($data);

                // faz a inserção do arquivo no BD
                $this->insertImgUser();

                return true;
            }
            else
            {
                throw new \Exception("Erro ao enviar a imagem. Contate do administrador do site.");
            }
        }
    }

    // carrega a imagem de perfil de usuário
    public function userPerfilImage($id)
    {
        $this->__set('iduser', $id);
        $results = $this->select();
        
        $imgurl = '../res/admin/dist/img/user2-160x160.jpg';
        
        if (count($results)  > 0)
        {
            //$imgname = $this->selectIndex($id);
            $imgurl = '../res/admin/dist/img/perfil-update/' . $results[0]['imgname'];
            return $imgurl;
        }
        else
        {
            return $imgurl;
        }
    }

    // Faz upload de um arquivo para a pasta BASE_UPLOAD_DIR
    public function uploadImg($files)
    {
        $filename = str_replace(" ", '-', $files["name"]);
        $filetype = str_replace("image/", '', $files["type"]);
        $filenametmp = $files["tmp_name"];
        $filesize = $files["size"];
        $extension = strtolower(str_replace('image/', '', $filetype)); // pega a extenção do arquivo
        $imgnewname = time() . '.' . $extension; // renomeia o arquivo

        // Início do tratamento de Exceções

        if (strlen($filename) > Image::FILENAME_MAX_SIZE) // verifica se o nome do arquivo excede 40 caracteres
        {
            throw new Exception("O nome do arquivo excede o limite de caracteres");
        }

        if (!in_array($filetype, Image::EXT_TYPE)) // compara se não existe a extenção no array
        {
            throw new Exception("Este arquivo não é válido");
        }

        
        if ($filesize > Image::LIMIT_SIZE) // se o tamanho exceder 80 KBs
        {
            throw new Exception("O tamanho do arquivo excede o limite " . Image::LIMIT_SIZE . " Bytes");
        }
        
        // Fim do tratamento de Exceções

        if($this->moveUploadFile(Image::BASE_UPLOAD_DIR, $filenametmp, $imgnewname))
        {
            // envia os dados para ser passado por meio do setData
            $data = array(
                'imgname' => $imgnewname,
                'imgsize'=> $filesize,
                'imgtype'=> $filetype,
                'imgtmp'=> $filenametmp
            );

            // retorna o array
            return $data;
        }
        else
        {
            return false;
        }
    }

    // função que envia o arquivo para a pasta upload
    public function moveUploadFile($dir, $filenametmp, $imgname)
    {
        $destination = $dir . $imgname;

        if (is_dir($dir))
        {
            return move_uploaded_file($filenametmp, $destination); // move o arquivo para o novo diretorio e retorna true or false
        }
        else
        {
            mkdir($dir);
            return move_uploaded_file($filenametmp, $destination); // move o arquivo para o novo diretorio e retorna true or false
        }
    }

}