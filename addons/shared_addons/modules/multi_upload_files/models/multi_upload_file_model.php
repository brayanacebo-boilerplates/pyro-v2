<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @author  Luis Fernando Salazar
 */
class multi_upload_file_Model extends MY_Model {
	
	var $dirProyect = '';
	
    public function __construct()
    {
        parent::__construct();
		// en el local es con los slash \ y en la web es con los /
		$this->dirProyect = str_replace("addons\shared_addons\modules", "", dirname(dirname(__DIR__)));
		$this->dirProyect = str_replace("addons/shared_addons/modules", "", $this->dirProyect);
    }
	
	public function filtrarSoloArchivosCarpeta($archivosArray)
	{
		$nombresExcluir = array('.', '..', 'thumb', 'thumbs.db');
		$numRegistros = count($archivosArray);
		for ($i = 0; $i < $numRegistros; $i++)
		{
			foreach ($nombresExcluir as $nombreExcluir)
			{
				if(strtolower($archivosArray[$i]) == $nombreExcluir)
				{
					unset($archivosArray[$i]);
					break;
				}
			}
		}
		return $archivosArray;
	}
	
	public function extensionArchivo($nomArchivo)
	{
		$trozosNombre = explode(".", $nomArchivo); 
		$extArchivo = end($trozosNombre);
		$extArchivo = strtolower($extArchivo);
		return $extArchivo; 
	}
	
	public function insert_file_actuaciones($nombreArchivo, $idRegistro, $DB_tabla)
   {
      $archivosArray = array(
         'nomanaab'		=> $nombreArchivo,
         'idactab'		=> $idRegistro,
      );
      $this->db->insert($DB_tabla, $archivosArray);
      return $this->db->insert_id();
   }

   	public function get_files()
	{
	   return $this->db->select()
	         ->from('files')
	         ->get()
	         ->result();
	}

	public function delete_file($nomCarpeta, $id_carpeta, $nombreArchivo)
	{
	   unlink('./uploads/default/'.$nomCarpeta.'/'.$id_carpeta.'/'.$nombreArchivo);
	   unlink('./uploads/default/'.$nomCarpeta.'/'.$id_carpeta.'/thumb/'.$nombreArchivo);
	   return TRUE;
	}
	
	public function img_resize($archivoAdjunto, $anchoMax, $altoMax, $tipoArchivo, $id)
    {    
        $this->load->library('image_lib');
        $nuevaRuta = './uploads/default/'.$tipoArchivo.'/'.$id.'/'.$archivoAdjunto['raw_name'].'_resize'.$archivoAdjunto['file_ext'];
        
        $configImg['image_library'] = 'gd2';
        $configImg['source_image'] = $archivoAdjunto['full_path'];
        $configImg['new_image'] = $nuevaRuta;
        $configImg['maintain_ratio'] = TRUE;
        $configImg['width'] = $anchoMax;
        $configImg['height'] = $altoMax;
		
        $this->image_lib->initialize($configImg);
        
        if ( ! $this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
        }
       
        unset($configImg);
        $this->image_lib->clear();
    }
	
	public function rotar_imagen($nomCarpeta, $id_carpeta, $nombreArchivo, $rotarImg)
	{
		$this->load->library('image_lib');
		$archivo = ('./uploads/default/'.$nomCarpeta.'/'.$id_carpeta.'/'.$nombreArchivo);
	   	$archivoThumb = ('./uploads/default/'.$nomCarpeta.'/'.$id_carpeta.'/thumb/'.$nombreArchivo);
		$nuevaImagen = './uploads/default/'.$nomCarpeta.'/'.$id_carpeta.'/';
		$nuevaImagenThumb = './uploads/default/'.$nomCarpeta.'/'.$id_carpeta.'/thumb/';
		
		$configImg['image_library']   = 'gd2';
		$configImg['new_image'] = $nuevaImagen;
		$configImg['create_thumb'] = FALSE;
		$configImg['source_image'] = $archivo;
		$configImg['rotation_angle'] = $rotarImg;
		
		$this->image_lib->initialize($configImg);
        
        if ( ! $this->image_lib->rotate())
        {
            echo $this->image_lib->display_errors();
        }
		
		$configImg['new_image'] = $nuevaImagenThumb;
		$configImg['source_image'] = $archivoThumb;
		
		$this->image_lib->initialize($configImg);
        
        if ( ! $this->image_lib->rotate())
        {
            echo $this->image_lib->display_errors();
        }
		$this->image_lib->clear();
	}
	
    public function crear_miniatura($archivoAdjunto)
    {
    	$this->load->library('image_lib');

		$anchoThumb = 100;
		$altoThumb = 100;
		
		// 1. redimensionamos la imagen tomando el lado más pequeño
		$ejeMenor = ($archivoAdjunto['image_width'] <= $archivoAdjunto['image_height'] ? "x" : "y");
		$ladoPeq = ($archivoAdjunto['image_width'] <= $archivoAdjunto['image_height'] ? $archivoAdjunto['image_width'] : $archivoAdjunto['image_height']);
		
		$tempImage = $archivoAdjunto['full_path'];
		$nuevaImagen = $archivoAdjunto['file_path'].'thumb/';
        $configImgThumb['image_library'] = 'gd2';
		$configImgThumb['new_image'] = $nuevaImagen;
        $configImgThumb['source_image'] = $tempImage;
        $configImgThumb['maintain_ratio'] = TRUE;
		$configImgThumb['master_dim'] = ($ejeMenor == "x" ? 'width' : 'height');
        $configImgThumb['create_thumb'] = TRUE;
        $configImgThumb['thumb_marker'] = "";
        $configImgThumb['quality'] = '100';
        $configImgThumb['width'] = 100;
        $configImgThumb['height'] = 100;
		
        $this->image_lib->initialize($configImgThumb);
        if ( ! $this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
        }
        unset($configImgThumb);
		
		$imagenCortada = $nuevaImagen.$archivoAdjunto['file_name'];
		
		list($thumbTempWidth,$thumbTempHeight) = getimagesize($imagenCortada);
		
		// 2. determinamos los pixels sobrantes y los cortamos de la imagen
		$pixelSobrantes = ($ejeMenor == "x" ? $thumbTempHeight : $thumbTempWidth) - ($ejeMenor == "x" ? $altoThumb : $anchoThumb);
		$pixelSobrantes=$pixelSobrantes/2;
	
		$configImg['image_library'] = 'gd2';
		$configImg['new_image'] = $nuevaImagen;
		$configImg['source_image'] = $imagenCortada;
		$configImg['x_axis'] = ($ejeMenor == "x" ? 0 : $pixelSobrantes);
		$configImg['y_axis'] = ($ejeMenor == "y" ? 0 : $pixelSobrantes);
		$configImg['maintain_ratio'] = FALSE;
        $configImg['width'] = 100;
        $configImg['height'] = 100;

		$this->image_lib->initialize($configImg); 
		if ( ! $this->image_lib->crop())
		{
			echo $this->image_lib->display_errors();
		}
		unset($configImg);
		$this->image_lib->clear();
    }

	public function crearCarpeta($moduleName, $id_carpeta, $thumbCarpeta = false)
	{
		$rutaArchivo = $this->dirProyect.'uploads/default/'.$moduleName.'/'.$id_carpeta.'/';
		echo $rutaArchivo;
		if (!file_exists($rutaArchivo)) 
		{
			mkdir($rutaArchivo,0777);
		}
		if($thumbCarpeta)
		{
			$rutaArchivo .= 'thumb/';
			if (!file_exists($rutaArchivo))
			{
				mkdir($rutaArchivo,0777);
			}
		}
	}
	
	public function renombrarArchivo($nomCarpeta, $id_carpeta, $nombreArchivo, $nuevoNombreArchivo, $thumbCarpeta = false)
	{
		$extArchivo = $this->extensionArchivo($nombreArchivo);
		$rutaNombre = $this->dirProyect.'uploads/default/'.$nomCarpeta.'/'.$id_carpeta.'/'.$nombreArchivo;
		$nuevaRutaNombre = $this->dirProyect.'uploads/default/'.$nomCarpeta.'/'.$id_carpeta.'/'.$nuevoNombreArchivo.'.'.$extArchivo;
		rename ($rutaNombre, $nuevaRutaNombre);
		if($thumbCarpeta)
		{
			$rutaNombre = $this->dirProyect.'uploads/default/'.$nomCarpeta.'/'.$id_carpeta.'/thumb/'.$nombreArchivo;
			$nuevaRutaNombre = $this->dirProyect.'uploads/default/'.$nomCarpeta.'/'.$id_carpeta.'/thumb/'.$nuevoNombreArchivo.'.'.$extArchivo;
			rename ($rutaNombre, $nuevaRutaNombre);
		}
		return $nuevoNombreArchivo.'.'.$extArchivo;
	}
	
	public function borrarCarpeta($nomCarpeta)
	{
		if (!file_exists($nomCarpeta))
		{
			return true;
		}
    	if (!is_dir($nomCarpeta))
		{
			return unlink($nomCarpeta);
		}
    	foreach (scandir($nomCarpeta) as $objExluy) 
    	{
	        if (!($objExluy == '.' || $objExluy == '..'))
			{
				$this->borrarCarpeta($nomCarpeta.DIRECTORY_SEPARATOR.$objExluy);
			}
    	}
    	rmdir($nomCarpeta);
	}
}