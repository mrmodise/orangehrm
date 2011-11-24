<link href="<?php echo public_path('../../themes/orange/css/ui-lightness/jquery-ui-1.7.2.custom.css') ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/ui/ui.core.js') ?>"></script>

<?php use_stylesheet('../orangehrmAdminPlugin/css/payGradeSuccess'); ?>
<?php use_javascript('../orangehrmAdminPlugin/js/payGradeSuccess'); ?>
<?php use_stylesheet('../../../themes/orange/css/jquery/jquery.autocomplete.css'); ?>
<?php use_javascript('../../../scripts/jquery/jquery.autocomplete.js'); ?>
<?php echo isset($templateMessage) ? templateMessage($templateMessage) : ''; ?>
<?php $hasCurrencies = count($currencyList) > 0; ?>
<div id="messagebar" class="<?php echo isset($messageType) ? "messageBalloon_{$messageType}" : ''; ?>" >
	<span><?php echo isset($message) ? $message : ''; ?></span>
</div>

<div id="payGrade">
     <div class="outerbox">

         <div class="mainHeading"><h2 id="payGradeHeading"><?php echo __("Add Pay Grade"); ?></h2></div>
            <form name="frmPayGrade" id="frmPayGrade" method="post" action="<?php echo url_for('admin/payGrade'); ?>" >

            <?php echo $form['_csrf_token']; ?>
            <?php echo $form->renderHiddenFields(); ?>
		    
	    <br class="clear"/>
	    <div class="newColumn">
                <?php echo $form['name']->renderLabel(__('Name'). ' <span class="required">*</span>'); ?>
                <?php echo $form['name']->render(array("class" => "formInput", "maxlength" => 52)); ?>
                <div class="errorHolder"></div>
            </div>
	    <br class="clear"/>
	    
	    <div class="formbuttons">
                    <input type="button" class="savebutton" name="btnSave" id="btnSave"
                           value="<?php echo __("Save"); ?>"onmouseover="moverButton(this);" onmouseout="moutButton(this);"/>
                    <input type="button" class="cancelbutton" name="btnCancel" id="btnCancel"
                           value="<?php echo __("Cancel"); ?>"onmouseover="moverButton(this);" onmouseout="moutButton(this);"/>
	    </div>
		    
	    </form>
    </div>
	<div class="paddingLeftRequired"><?php echo __('Fields marked with an asterisk') ?> <span class="required">*</span> <?php echo __('are required.') ?></div>
</div>

<?php if($payGradeId > 0) { ?>
<div id="currency">
<div class="outerbox">
    <div class="mainHeading"><h2><?php echo __('Assigned Currencies'); ?></h2></div>
    <div>
        <form name="frmCurrency" id="frmCurrency" method="post" action="<?php echo url_for('admin/savePayGradeCurrency'); ?>">
	    <?php echo $currencyForm['_csrf_token']; ?>
            <?php echo $currencyForm->renderHiddenFields(); ?>

	 <div id="addPaneCurrency" style="display: none" >
	 <br class="clear"/>
	    <div>
		<?php echo $currencyForm['currencyName']->renderLabel(__('Currency') . ' <span class="required">*</span>'); ?>
                <?php echo $currencyForm['currencyName']->render(array("class" => "formInput", "maxlength" => 52)); ?>
		<div class="errorHolder"></div>
		<br class="clear"/>
	    </div>
	    <div>
		<?php echo $currencyForm['minSalary']->renderLabel(__('Minimum Salary')); ?>
                <?php echo $currencyForm['minSalary']->render(array("class" => "formInput", "maxlength" => 52)); ?>
		<div class="errorHolder"></div>
		<br class="clear"/>
	    </div>
	    <div>
		<?php echo $currencyForm['maxSalary']->renderLabel(__('Maximum Salary')); ?>
                <?php echo $currencyForm['maxSalary']->render(array("class" => "formInput", "maxlength" => 52)); ?>
		<div class="errorHolder"></div>
		<br class="clear"/>
	    </div>

	    
	    <div id="actionButtons" class="formbuttons" style="display: none">
                <input type="button" class="savebutton" name="btnSaveCurrency" id="btnSaveCurrency"
                       value="<?php echo __("Save");?>" onmouseover="moverButton(this);" onmouseout="moutButton(this);"/>
                <input type="button" class="plainbtn" id="cancelButton" value="<?php echo __("Cancel"); ?>"
		       onmouseover="moverButton(this);" onmouseout="moutButton(this);"/>
            </div>
	    </div>
	</form>
	<form name="frmDelCurrencies" id="frmDelCurrencies" method="post" action="<?php echo url_for('admin/deletePayGradeCurrency?payGradeId='.$payGradeId);?>">
        <?php echo $deleteForm['_csrf_token']; ?>
	    <div id="addDeleteBtnDiv">
                <input type="button" class="addbutton" id="btnAddCurrency"
                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"
                       value="<?php echo __("Add");?>" title="<?php echo __("Add");?>"/>
		<?php if($hasCurrencies){ ?>
		<input type="button" class="delbutton" id="btnDeleteCurrency"
                       onmouseover="moverButton(this);" onmouseout="moutButton(this);"
                       value="<?php echo __("Delete");?>" title="<?php echo __("Delete");?>"/>
		<?php } ?>
            </div>
	    <?php if ($hasCurrencies) { ?>
            <table width="100%" cellspacing="0" cellpadding="0" class="data-table" id="tblCurrencies">
            <thead>
                <tr>
                    <td class="check"><input type="checkbox" id="currencyCheckAll" class="checkboxCurr"/></td>
                    <td><?php echo __("Currency")?></td>                   
                    <td><?php echo __("Minimum Salary")?></td>
                    <td><?php echo __("Maximum Salary")?></td>
                </tr>
            </thead>
            <tbody>
       <?php

        $row = 0;
        foreach ($currencyList as $currency)
        {
            $cssClass = ($row%2) ? 'even' : 'odd';
            ?>
                <tr class="<?php echo $cssClass;?>">
                    <td class="check"><input type='checkbox' class='checkboxCurr' name='delCurrencies[]'
                               value="<?php echo $currency->currency_id; ?>"/></td>
                    <td><a href="#" class="editLink"><?php echo $currency->getCurrencyType()->getCurrencyName(); ?></a></td>
                    <td><?php echo $currency->minSalary; ?></td>
                    <td><?php echo $currency->maxSalary; ?></td>
                </tr>
            <?php   $row++;
            }
            ?>
            </tbody>
        </table>
        <?php } else { ?>
        <?php } ?>
	</form>
    </div>
</div>
</div>
<?php } ?>
<script type="text/javascript"> 
	var currencies = <?php echo str_replace('&#039;', "'", $form->getCurrencyListAsJson()); ?> ;
        var currencyList = eval(currencies);
	var assignedCurrencies = <?php echo str_replace('&#039;', "'", $form->getAssignedCurrencyListAsJson($payGradeId)); ?>;
        var assignedCurrencyList = eval(assignedCurrencies);
	var lang_NameRequired = "<?php echo __("Pay Grade name is required"); ?>";
	var lang_exceed50Charactors = "<?php echo __("Cannot exceed 50 charactors"); ?>";
	var payGradeId = "<?php echo $payGradeId; ?>";
	var lang_edit = "<?php echo __("Edit"); ?>";
	var lang_save = "<?php echo __("Save"); ?>";
	var lang_editPayGrade = "<?php echo __("Edit Pay Grade"); ?>";
	var lang_addPayGrade = "<?php echo __("Add Pay Grade"); ?>";
	var lang_currencyRequired = "<?php echo __("Currency is required"); ?>";
	var lang_salaryShouldBeNumeric = "<?php echo __("Salary should be numeric"); ?>";
	var lang_validCurrency = "<?php echo __("Enter a valid currency"); ?>";
	var lang_currencyAlreadyExist = "<?php echo __("Currency is already exist"); ?>";
	var lang_validSalaryRange  = "<?php echo __("Invalid salary range"); ?>";
	var lang_addCurrency  = "<?php echo __("Edit Currency"); ?>";
	var lang_editCurrency  = "<?php echo __("Add Currency"); ?>";
	var lang_assignedCurrency  = "<?php echo __("Assigned Currency"); ?>";
	var viewPayGradesUrl = "<?php echo url_for("admin/viewPayGrades"); ?>";
</script>