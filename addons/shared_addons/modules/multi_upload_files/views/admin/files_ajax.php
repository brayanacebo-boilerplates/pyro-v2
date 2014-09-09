<?php
$adjuntos = TRUE;
if (isset($archivosAdjuntos))
{
   ?>
		 <?php
			if($archivosAdjuntos != '')
			{
				if(count($archivosAdjuntos) > 0)
				{
					foreach ($archivosAdjuntos as $nomfile)
					{
						$i = 1;
						//echo '<td>'.$nomfile.'</td>';
						$nombre_archivo = explode(".", $nomfile);
						$ext = $this->multi_upload_file_model->extensionArchivo($nomfile);
						$esImg = ($ext == 'gif' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'png');
						?>
						<div class="dz-preview">
							<a <?php echo ($esImg ? 'class="photobox"' : "" ); ?> href="<?php echo site_url().'uploads/default/'.$moduleName.'/'.$category->id.'/'.$nomfile.'?'.time(); ?>" target="_blank">
								<div class="dz-details">
									<div class="dz-filename"><span><?php echo $nomfile; ?></span></div>
									<?php
									
									if($esImg)
									{
									?>
										<img src="<?php echo site_url().'uploads/default/'.$moduleName.'/'.$category->id.'/thumb/'.$nomfile.'?'.time(); ?>" alt="" title="<?php echo $nomfile; ?>"/>
									<?php
									}
									else
									{
										switch ($ext)
										{
											case 'doc':
											case 'docx':
												?>
												<img src="<?php echo site_url().'addons/shared_addons/modules/'.$moduleName.'/images/anexos-word.png'; ?>" alt=""/>
												<?php
												break;
											case 'xls':
											case 'xlsx':
												?>
												<img src="<?php echo site_url().'addons/shared_addons/modules/'.$moduleName.'/images/anexos-excel.png'; ?>" alt=""/>
												<?php
												break;
											case 'pdf':
												?>
												<img src="<?php echo site_url().'addons/shared_addons/modules/'.$moduleName.'/images/anexos-pdf.png'; ?>" alt=""/>
												<?php
												break;
											case 'txt':
												?>
												<img src="<?php echo site_url().'addons/shared_addons/modules/'.$moduleName.'/images/anexos-txt.png'; ?>" alt=""/>
												<?php
												break;
										}
									}
									?>
								</div>
							</a>
								<a href="<?php echo site_url().'admin/'.$moduleName.'/renombrarArchivo/'.$category->id; ?>" data-nomfile="<?php echo $nomfile; ?>" class="renombrar-archivo btip dzRenombrar" title="Renombrar"><i class="icon-edit"></i><span class="nom-archivo hide"><?php echo $nombre_archivo[0]; ?></span> </a>
								<a href="#" class="delete_file_link btip dzEliminar" data-file_id="<?php echo $category->id; ?>" data-nomfile="<?php echo $nomfile; ?>" title="Eliminar"><i class="icon-trash"></i> </a>
								<?php
								if($ext == 'gif' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
								{
								?>
									<a href="#" class="rotate_file_link btip dzRotar" data-file_id="<?php echo $nomfile.'/'.$category->id; ?>" title="Rotar Imagen"><i class="icon-repeat"></i> </a>
								<?php
								}
								?>
						</div>
						
						<?php
						$i++;
					}
				}
			}
		 ?>
   <?php
}
?>
<script type="text/javascript">
	$( document ).ready(function() {
		$('#files').photobox('a.photobox',{time:3000});
	}) 
</script>