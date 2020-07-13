<?php

namespace App\Models;


use \Src\Database;
use Src\Database\Connection;

class Image extends User
{
    private $iduser;
    private $imgname;
    private $imgsize;
    private $imgtype;
    private $imgtmp;

    public function __set($attrib, $value)
    {
        return $this->$attrib = $value;
    }

    public function __get($attrib)
    {
        return $this->$attrib;
    }

    public function userPerfilImage($id)
    {
        $result = $this->countAll('tb_users_perfils_images', $id);
        $imgurl = '../res/admin/dist/img/user2-160x160.jpg';

        if ($result['count'] > 0)
        {
            $results = $this->selectIndex($id);
            $imgurl = '../res/admin/dist/img/perfil-update/' . $results['imgname'];
            return $imgurl;
        }
        else
        {
            return $imgurl;
        }
    }

    public function updateImg($files)
    {
        if ($files != '')
        {
            // salva os dados vindo da super global $_FILES
            
            $filename = $files['name'];
            $filetype = $files['type'];
            $filetmpname = $files['tmp_name'];
            $filesize = $files['size'];
        
            if ($filename != "")
            {

            $imgtype = strtolower(substr($filetype, 0, 5)); // verifica se na extenção possui o tipo 'image'
            
                if ($filetype != "" && $imgtype == 'image')
                {

                    $extension = strtolower(str_replace('image/', '', $filetype)); // pega a extenção do arquivo

                    if ($filetmpname != "")
                    {
                        if ($filesize != "")
                        {
                            
                            $dir = 'res/admin/dist/img/perfil-update/'; // diretorio onde sera feito o upload

                            $imgnewname = time() . '.' . $extension;
                            $id = $this->__set('iduser', $_SESSION['id']);
                            $this->__set('imgname', $imgnewname);
                            $this->__set('imgtype', $filetype);
                            $this->__set('imgtmp', $filetmpname);
                            $this->__set('imgsize', $filesize);

                            if (is_dir($dir))
                            {
                                move_uploaded_file($filetmpname, $dir . $imgnewname); // move o arquivo para o novo diretorio
                            }
                            else
                            {
                                mkdir($dir);
                                move_uploaded_file($filetmpname, $dir . $imgnewname); // move o arquivo para o novo diretorio
                            }
                            
                            $this->insertOrUpdateImg('tb_users_perfils_images', $id);
                        }
                    }
                }
            }
        }
    }

    public function insertOrUpdateImg($tbname, $id)
    {
        $result = $this->countAll($tbname, $id);

        if ($result['count'] > 0)
        {
            $this->updateImgUser( $this->__get('iduser'), 
                                  $this->__get('imgname'), 
                                  $this->__get('imgtype'), 
                                  $this->__get('imgtmp'), 
                                  $this->__get('imgsize'));
        }
        else
        {
            $this->insertImgUser( $this->__get('iduser'), 
                                  $this->__get('imgname'), 
                                  $this->__get('imgtype'), 
                                  $this->__get('imgtmp'), 
                                  $this->__get('imgsize'));
        }
    }

    public function selectIndex($id)
    {
        $sql = "SELECT imgname FROM tb_users_perfils_images WHERE iduser = :IDUSER";
        $conn = Connection::open('config');
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':IDUSER', $id);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $results[0];
    }

    /**
     * Faz o insert de uma imagem na tabela
     */
    public function insertImgUser($iduser, $imgname, $imgtype, $imgtmp, $imgsize)
    {
        $sql = "INSERT INTO tb_users_perfils_images (iduser, imgname, imgsize, imgtype, imgtmp)
                VALUES (:IDUSER, :IMGNAME, :IMGSIZE, :IMGTYPE, :IMGTMP)";
        
        $conn = Connection::open('config');
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':IDUSER', $iduser);
        $stmt->bindParam(':IMGNAME', $imgname);
        $stmt->bindParam(':IMGSIZE', $imgsize);
        $stmt->bindParam(':IMGTYPE', $imgtype);
        $stmt->bindParam(':IMGTMP', $imgtmp);
        $stmt->execute();
    }

    /**
     * Faz o update de uma foto na tabela
     */
    public function updateImgUser($iduser, $imgname, $imgtype, $imgtmp, $imgsize)
    {
        $sql = "UPDATE tb_users_perfils_images SET 
            imgname = :IMGNAME,
            imgsize = :IMGSIZE, 
            imgtype = :IMGTYPE,
            imgtmp  = :IMGTMP
                WHERE iduser = :IDUSER";
        
        $conn = Connection::open('config');
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':IDUSER', $iduser);
        $stmt->bindParam(':IMGNAME', $imgname);
        $stmt->bindParam(':IMGSIZE', $imgsize);
        $stmt->bindParam(':IMGTYPE', $imgtype);
        $stmt->bindParam(':IMGTMP', $imgtmp);
        $stmt->execute();
    }
}