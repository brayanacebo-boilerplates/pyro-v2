<div id="baseurl" class="hide"><?php echo site_url(); ?></div>
<section class="title">
    <h4>Archivos / Categorias</h4>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-category"><span>Editar Categoria</span></a></li>
                <li><a href="#page-files"><span>Archivos</span></a></li>
            </ul>
            <div class="form_inputs" id="page-category">
                <?php echo form_open_multipart(site_url('admin/'.$moduleName.'/update_category'), ''); ?>
                <div class="inline-form">
                    <fieldset>
                        <ul>
                            <li>
                                <label for="title">Titulo <span>*</span></label>
                                <div class="input"><?php echo form_input('title', $category->title, 'class="dev-input-title"'); ?></div>
                            </li>
                            <li>
                                <label for="path">Padre</label>
                                <select name="parent">
                                    <option value="0">Seleccione una opción</option>
                                    <?php foreach ($categories as $item): ?>
                                        <?php if($item->id != $category->id): ?>
                                            <option value="<?php echo $item->id; ?>" <?php echo ($item->id == $category->parent) ? "selected" : null ?>>
                                                <?php echo $item->title; ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach ?>
                                </select>
                            </li>
                        </ul>
                    </fieldset>

                    <div class="buttons float-right padding-top">
                        <?php echo form_hidden('id',$category->id); ?>
                        <button type="submit" name="btnAction" value="save" class="btn blue">Guardar</button>
                        <a href="<?php echo backend_url($moduleName.'/#structure-categories') ?>" class="btn red cancel">Cancelar</a>
                        <?php echo anchor('admin/'.$moduleName.'/destroy_category/' . $category->id, lang('global:delete'), array('class' => 'confirm btn red')); ?>
                    </div>

                </div>
                <?php echo form_close(); ?>
            </div>
			
			<div class="form_inputs" id="page-files">
				* Procure no cargar archivos con caracteres especiales o espacios en el nombre, ya que las url de los navegadores los puede interpretar de mala manera.
				<?php echo form_open_multipart(site_url('admin/'.$moduleName.'/upload_file'.$category->id), 'id="form_proce_anexos" class="dropzone form-inline"'); ?>
				    <div class="fallback">
				    	<input type="file" name="userfile[]" id="userfile" size="20" multiple/>
					</div>
					<input type="hidden" value="<?php echo $category->id; ?>" name="idadjuntos" id="idadjuntos" />
				</form>
				
				<div id="files" class="dropzone">
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
				</div>
				
				
			</div>
			
        </div>
    </div>
</section>