<section class="item">
    <section class="title">
    <h4><?php echo lang('language:title') ?></h4>
</section>
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
            	<li><a href="#page-send-emails"><span><?php echo lang('language:mailing') ?></span></a></li>
                <li><a href="#page-view"><span><?php echo lang('language:data') ?></span></a></li>
                <li><a href="#page-details"><span><?php echo lang('language:manage_data') ?></span></a></li>
            </ul>
            <div class="form_inputs" id="page-view">
                <div class="inline-form">
                <fieldset>
                    <ul>
						<li>
                            <label for="name">Facebook</label>
                            <div class="input"><?php echo isset($data->facebook) ? $data->facebook : "" ?></div>
                        </li>
                        <li>
                            <label for="name">twitter</label>
                            <div class="input"><?php echo isset($data->twitter) ? $data->twitter : "" ?></div>
                        </li>
                        <li>
                            <label for="name">linkedin</label>
                            <div class="input"><?php echo isset($data->linkedin) ? $data->linkedin : "" ?></div>
                        </li>
                       <li>
                            <label for="name"><?php echo lang('language:address') ?></label>
                            <div class="input"><?php echo isset($data->adress) ? $data->adress : "" ?></div>
                        </li>
                        <li>
                            <label for="name"><?php echo lang('language:phone') ?></label>
                            <div class="input"><?php echo isset($data->phone) ? $data->phone : "" ?></div>
                        </li>
                        <li>
                            <label for="name"><?php echo lang('language:email') ?></label>
                            <div class="input"><?php echo isset($data->email) ? $data->email : "" ?></div>
                        </li>
                         <li>
                            <label for="name"><?php echo lang('language:schedule') ?></label>
                            <div class="input"><?php echo isset($data->schedule) ? $data->schedule : "" ?></div>
                        </li>
                        <li>
                            <label for="name"><?php echo lang('language:map') ?></label>
                            <div class="input"><?php if(isset($data->map)){ $map = str_replace("#", "%23", $data->map); echo $map; } ?></div>
                        </li>
                    </ul>
                </fieldset>
                </div>
            </div>
            <div class="form_inputs" id="page-details">
                <?php echo form_open(site_url('admin/contact_us/index/'), 'id="form-wysiwyg"'); ?>
                <div class="inline-form">
                <fieldset>
					Las Direcciones Url es recomendable que siempre lleven el https:// Como por ejemplo https://www.facebook.com/ <br/><br/><br/>
                    <ul>
						<li>
                            <label for="name">facebook</label>
                            <div class="input"><?php echo form_input('facebook', set_value('facebook', isset($data->facebook) ? $data->facebook : ""), ' id="facebook"'); ?></div>
                        </li>
                        <li>
                            <label for="name">twitter</label>
                            <div class="input"><?php echo form_input('twitter', set_value('twitter', isset($data->twitter) ? $data->twitter : ""), ' id="twitter"'); ?></div>
                        </li>
                        <li>
                            <label for="name">linkedin</label>
                            <div class="input"><?php echo form_input('linkedin', set_value('linkedin', isset($data->linkedin) ? $data->linkedin : ""), ' id="linkedin"'); ?></div>
                        </li>
                       <li>
                            <label for="name"><?php echo lang('language:address') ?></label>
                            <div class="input"><?php echo form_input('adress', set_value('adress', isset($data->adress) ? $data->adress : ""), ' id="adress"'); ?></div>
                        </li>
                        <li>
                            <label for="name"><?php echo lang('language:phone') ?></label>
                            <div class="input"><?php echo form_input('phone', set_value('phone', isset($data->phone) ? $data->phone : ""), ' id="phone"'); ?></div>
                        </li>
                        <li>
                            <label for="name"><?php echo lang('language:email') ?></label>
                            <div class="input"><?php echo form_input('email', set_value('correo', isset($data->email) ? $data->email : ""), ' id="email"'); ?></div>
                        </li>
                        <li class="even">

                            <label for="name">

                                <?php echo lang('language:schedule') ?>

                                <span>*</span>

                                <small><?php echo lang('language:msg_schedule') ?></small>

                            </label>

                            <div class="input">

                                <div class="sroll-table">

                                    <?php echo form_textarea(array('id' => 'text-wysiwyg', 'name' => 'text_wysiwyg', 'value' => (isset($data->schedule)) ? $data->schedule : set_value('schedule'), 'rows' => 15, 'class' => 'wysiwyg-advanced ')) ?>

                                    <input type="hidden" name="text" id="text">

                                </div>

                            </div>

                            <br class="clear">

                        </li>
                        <li class="even">
                            <label for="name"><?php echo lang('language:map') ?></label>

                            <div class="input">

                                <div class="sroll-table">

                                    <?php echo form_textarea(array('id' => 'text-wysiwyg-map', 'name' => 'text_wysiwyg_map', 'value' => (isset($data->map)) ?$data->map : set_value('map'), 'rows' => 15, 'class' => 'wysiwyg-advanced ')) ?>
                                    <input type="hidden" name="map" id="map">

                                </div>

                            </div>

                            <br class="clear">

                        </li>
                        <li>
                        <li>
                            <div class="buttons float-right padding-top">
                                <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))); ?>
                            </div>
                        </li>
                    </ul>
                </fieldset>
                <?php echo form_close(); ?>
            </div>
            </div>
            <div class="form_inputs" id="page-send-emails">
                <div class="inline-form">
                <?php if (!empty($data2)): ?>

                    <table border="0" class="table-list" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 15%"><?php echo lang('language:name') ?></th>
                                <th style="width: 15%"><?php echo lang('language:email') ?></th>
                                <th style="width: 10%"><?php echo lang('language:phone') ?></th>
                                <th style="width: 10%"><?php echo lang('language:cell') ?></th>
                                <th style="width: 10%"><?php echo lang('language:company') ?></th>
                                <th style="width: 10%"><?php echo lang('language:city') ?></th>
                                <th style="width: 40%"><?php echo lang('language:msg') ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div class="inner filtered"><?php $this->load->view('admin/partials/pagination') ?></div>
                                </td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($data2 as $contact_data): ?>
                                <tr>
                                    <td><?php echo $contact_data->name ?></td>
                                    <td><?php echo $contact_data->email ?></td>
                                    <td><?php echo $contact_data->phone ?></td>
                                    <td><?php echo $contact_data->cell ?></td>
                                    <td><?php echo $contact_data->company ?></td>
                                    <td><?php echo $contact_data->city ?></td>
                                    <td><?php echo $contact_data->message ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    
                <?php else: ?>
                    <p style="text-align: center">No hay correos actualmente</p>
                <?php endif ?>
            </div>
            </div>
        </div>
    </div>
</section>

<script>
    jQuery(function($){
        // generate a slug when the user types a title in
        pyro.generate_slug('input[name="name"]', 'input[name="slug"]');
 
    });
</script>
