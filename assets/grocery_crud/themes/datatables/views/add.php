<?php

	$this->set_css($this->default_theme_path.'/datatables/css/datatables.css');
    $this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.form.min.js');
	$this->set_js_config($this->default_theme_path.'/datatables/js/datatables-add.js');
	$this->set_css($this->default_css_path.'/ui/simple/'.grocery_CRUD::JQUERY_UI_CSS);
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/ui/'.grocery_CRUD::JQUERY_UI_JS);

	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/jquery.noty.js');
	$this->set_js_lib($this->default_javascript_path.'/jquery_plugins/config/jquery.noty.config.js');
?>
<div class='ui-widget-content ui-corner-all datatables'>
	<h3 class="ui-accordion-header ui-helper-reset ui-state-default form-title">
		<div class='floatL form-title-left'>
			<a href="#"><?php echo $this->l('form_add'); ?> <?php echo $subject?></a>
		</div>
		<div class='clear'></div>
	</h3>
<div class='form-content form-div'>
	<?php echo form_open( $insert_url, 'method="post" id="crudForm" enctype="multipart/form-data"'); ?>
		<div>
			<?php
			$counter = 0;
				foreach($fields as $field)
				{
					$even_odd = $counter % 2 == 0 ? 'odd' : 'even';
					$counter++;
			?>
			<div class='form-field-box <?php echo $even_odd?>' id="<?php echo $field->field_name; ?>_field_box">
				<div class='form-display-as-box' id="<?php echo $field->field_name; ?>_display_as_box">
					<?php echo $input_fields[$field->field_name]->display_as?><?php echo ($input_fields[$field->field_name]->required)? "<span class='required'>*</span> " : ""?> :
				</div>
				<div class='form-input-box' id="<?php echo $field->field_name; ?>_input_box">
					<?php echo $input_fields[$field->field_name]->input?>
				</div>
				<div class='clear'></div>
			</div>
			<?php }?>
			<!-- Start of hidden inputs -->
				<?php
					foreach($hidden_fields as $hidden_field){
						echo $hidden_field->input;
					}
				?>
			<!-- End of hidden inputs -->
			<?php if ($is_ajax) { ?><input type="hidden" name="is_ajax" value="true" /><?php }?>
			<div class='line-1px'></div>
			<div id='report-error' class='report-div error'></div>
			<div id='report-success' class='report-div success'></div>
		</div>
		<div class='buttons-box'>
			<div class='form-button-box'>
				<input id="form-button-save" type='submit' value='<?php echo $this->l('form_save'); ?>' class='ui-input-button'/>
			</div>
<?php 	if(!$this->unset_back_to_list) { ?>
			<div class='form-button-box'>
				<input type='button' value='<?php echo $this->l('form_save_and_go_back'); ?>' class='ui-input-button' id="save-and-go-back-button"/>
			</div>
			<div class='form-button-box'>
				<input type='button' value='<?php echo $this->l('form_cancel'); ?>' class='ui-input-button' id="cancel-button" />
			</div>
<?php   } ?>
			<div class='form-button-box loading-box'>
				<div class='small-loading' id='FormLoading'><?php echo $this->l('form_insert_loading'); ?></div>
			</div>
			<div class='clear'></div>
		</div>
	<?php echo form_close(); ?>
</div>
</div>
<script>
	var validation_url = '<?php echo $validation_url?>';
	var list_url = '<?php echo $list_url?>';

	var message_alert_add_form = "<?php echo $this->l('alert_add_form')?>";
	var message_insert_error = "<?php echo $this->l('insert_error')?>";
        function getUrlParameter(sParam)
        {
            var sPageURL = window.location.search.substring(1);
            var sURLVariables = sPageURL.split('&');
            for (var i = 0; i < sURLVariables.length; i++) 
            {
                var sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] === sParam) 
                {
                    return sParameterName[1];
                }
            }
            return null;
        }
        
        var placement_id = getUrlParameter("placementId");
        if (placement_id === null){
            //
        } else {
            $('#field-placement_id option[value="'+ placement_id +'"]').attr("selected", "selected");
        }
        
        var banner_id = getUrlParameter("bannerId");
        if (banner_id === null){
            //
        } else {
            $('#field-banner_id option[value="'+ banner_id +'"]').attr("selected", "selected");
        }
        
        var campaign_id = getUrlParameter("campaignId");
        if (campaign_id === null){
            //
        } else {
            $('#field-campaign_id option[value="'+ campaign_id +'"]').attr("selected", "selected");
        }
        
        var advertiser_id = getUrlParameter("advertiserId");
        if (advertiser_id === null){
            //
        } else {
            $('#field-advertiser_id option[value="'+ advertiser_id +'"]').attr("selected", "selected");
        }
        
        var brand_id = getUrlParameter("brandId");
        if (brand_id === null){
            //
        } else {
            $('#field-brand_id option[value="'+ brand_id +'"]').attr("selected", "selected");
        }
        
        var variant_id = getUrlParameter("variantId");
        if (variant_id === null){
            //
        } else {
            $('#field-variant_id option[value="'+ variant_id +'"]').attr("selected", "selected");
        }
        
        var publisher_id = getUrlParameter("publisherId");
        if (publisher_id === null){
            //
        } else {
            $('#field-publisher_id option[value="'+ publisher_id +'"]').attr("selected", "selected");
        }
</script>