<?php
/*
 * Copyright (C) 2024 Anthony Damhet <a.damhet@progiseize.fr>
 *
 * This program and files/directory inner it is free software: you can
 * redistribute it and/or modify it under the terms of the
 * GNU Affero General Public License (AGPL) as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AGPL for more details.
 *
 * You should have received a copy of the GNU AGPL
 * along with this program. If not, see <https://www.gnu.org/licenses/agpl-3.0.html>.
 */

$res=0;
if (! $res && file_exists("../../main.inc.php")) : $res=@include '../../main.inc.php';
endif;
if (! $res && file_exists("../../../main.inc.php")) : $res=@include '../../../main.inc.php';
endif;
if (! $res && file_exists("../../../../main.inc.php")) : $res=@include '../../../../main.inc.php';
endif;


// Protection if external user
if ($user->socid > 0) : accessforbidden();
endif;

// Includes
dol_include_once('admin/tools/ui/class/documentation.class.php');
require_once DOL_DOCUMENT_ROOT.'/core/class/doleditor.class.php';

// Load documentation translations
$langs->load('uxdocumentation');

$action = GETPOST('action', 'alpha');

//if ($action == 'displayeventmessage') {
//	setEventMessages($langs->trans('DocSetEventMessageUnique'), null);
//} elseif ($action == 'displayeventmessages') {
//	$messageArray = [$langs->trans('DocSetEventMessage', '1'),
//		$langs->trans('DocSetEventMessage', '2'),
//		$langs->trans('DocSetEventMessage', '3')];
//	setEventMessages(null, $messageArray);
//} elseif ($action == 'displayeventmessageok') {
//	setEventMessages($langs->trans('DocSetEventMessageOK'), null);
//} elseif ($action == 'displayeventmessagewarning') {
//	setEventMessages($langs->trans('DocSetEventMessageWarning'), null, 'warnings');
//} elseif ($action == 'displayeventmessageerror') {
//	setEventMessages($langs->trans('DocSetEventMessageError'), null, 'errors');
//}

//
$documentation = new Documentation($db);

// Output html head + body - Param is Title
$documentation->docHeader('Inputs');

// Set view for menu and breadcrumb
// Menu must be set in constructor of documentation class
$documentation->view = array('Components','Inputs');

// Output sidebar
$documentation->showSidebar(); ?>

<div class="doc-wrapper">

	<?php $documentation->showBreadCrumb(); ?>

	<div class="doc-content-wrapper">

		<h1 class="documentation-title"><?php echo $langs->trans('DocInputsTitle'); ?></h1>
		<p class="documentation-text"><?php echo $langs->trans('DocInputsMainDescription'); ?></p>

		<!-- Summary -->
		<?php $documentation->showSummary(); ?>

		<!-- Basic usage -->
		<div class="documentation-section" id="setinputssection-basicusage">
			<h2 class="documentation-title"><?php echo $langs->trans('DocBasicUsage'); ?></h2>
			<p class="documentation-text"><?php echo $langs->trans('DocinputsDescription'); ?></p>
			<div class="documentation-example">
				<td>Available Input</td>
				<td><input id="label" name="label" class="minwidth200" maxlength="255" value=""></td>
				<br><br>
				<td>Disabled Input</td>
				<td><input id="label" name="label" class="minwidth200" maxlength="255" value="" disabled></td>
			</div>
			<?php
			$lines = array(
				'<td>Available Input</td>',
				'<td><input id="label" name="label" class="minwidth200" maxlength="255" value=""></td>',
				'',
				'<td>Disabled Input</td>',
				'<td><input id="label" name="label" class="minwidth200" maxlength="255" value="" disabled></td>',
			);
			echo $documentation->showCode($lines); ?>
		</div>


		<!-- Select input -->
		<div class="documentation-section" id="setinputssection-basicusage">
			<h2 class="documentation-title"><?php echo $langs->trans('DocSelectInputUsage'); ?></h2>
			<p class="documentation-text"><?php echo $langs->trans('DocinputsDescription'); ?></p>
			<div class="documentation-example">
				<td>Select with empty value</td>
				<?php
				$values = ['1' => 'value 1', '2' => 'value 2', '3' => 'value 3'];
				$form = new Form($db);
				print $form->selectarray('htmlnameselectwithemptyvalue', $values, 'idselectwithemptyvalue', 1, 0, 0, '', 0, 0, 0, '', 'minwidth200');
				?>
				<br><br>
				<td>Select within empty value</td>
				<?php
				$values = ['1' => 'value 1', '2' => 'value 2', '3' => 'value 3'];
				$form = new Form($db);
				print $form->selectarray('htmlnameselectwithinemptyvalue', $values, 'idnameselectwithinemptyvalue', 0, 0, 0, '', 0, 0, 0, '', 'minwidth200');
				?>
			</div>
			<?php
			$lines = array(
				'<?php',
				'/**',
				' * Function selectarray',
				' *',
				' * @param string 				$htmlname           Name of html select area. Try to start name with "multi" or "search_multi" if this is a multiselect,',
				' * @param array            	$array              Array like array(key => value) or array(key=>array(\'label\'=>..., \'data-...\'=>..., \'disabled\'=>..., \'css\'=>...)),',
				' * @param string|string[]|int 	$id                 Preselected key or array of preselected keys for multiselect. Use \'ifone\' to autoselect record if there is only one record.,',
				' * @param int<0,1>|string 		$show_empty         0 no empty value allowed, 1 or string to add an empty value into list (If 1: key is -1 and value is \'\' or "&nbsp;", If \'Placeholder string\': key is -1 and value is the string), <0 to add an empty value with key that is this value.,',
				' * @param int<0,1>				$key_in_label       1 to show key into label with format "[key] value",',
				' * @param int<0,1>				$value_as_key       1 to use value as key,',
				' * @param string 				$moreparam          Add more parameters onto the select tag. For example "style=\"width: 95%\"" to avoid select2 component to go over parent container,',
				' * @param int<0,1>				$translate          1=Translate and encode value,',
				' * @param int 					$maxlen             Length maximum for labels,',
				' * @param int<0,1>				$disabled           Html select box is disabled,',
				' * @param string 				$sort               \'ASC\' or \'DESC\' = Sort on label, \'\' or \'NONE\' or \'POS\' = Do not sort, we keep original order,',
				' * @param string 				$morecss            Add more class to css styles,',
				' * @param int 					$addjscombo         Add js combo,',
				' * @param string 				$moreparamonempty   Add more param on the empty option line. Not used if show_empty not set,',
				' * @param int 					$disablebademail    1=Check if a not valid email, 2=Check string \'---\', and if found into value, disable and colorize entry,',
				' * @param int 					$nohtmlescape       No html escaping (not recommended, use \'data-html\' if you need to use label with HTML content).,',
				' * @return string                                  HTML select string.,',
				' */',
				'',
				'<td>Select with empty value</td>',
				'print $form->selectarray(\'htmlnameselectwithemptyvalue\', $values, \'idselectwithemptyvalue\', 1, 0, 0, \'\', 0, 0, 0, \'\', \'minwidth200\');',
				'',
				'<td>Select within empty value</td>',
				'print $form->selectarray(\'htmlnameselectwithinemptyvalue\', $values, \'idnameselectwithinemptyvalue\', 0,0, 0, \'\', 0, 0, 0, \'\', \'minwidth200\');',

			);
			echo $documentation->showCode($lines); ?>
		</div>

		<!-- Checkbox input -->
		<div class="documentation-section" id="setinputssection-basicusage">
			<h2 class="documentation-title"><?php echo $langs->trans('DocCheckboxInputUsage'); ?></h2>
			<p class="documentation-text"><?php echo $langs->trans('DocCheckboxInputDescription'); ?></p>
			<div class="documentation-example">
				<span id="spannature1" class="spannature paddinglarge marginrightonly nonature-back"><label for="prospectinput" class="valignmiddle">Prospect<input id="prospectinput" class="flat checkforselect marginleftonly valignmiddle" type="checkbox" name="customer" value="1"></label></span>
				<span id="spannature2" class="spannature paddinglarge marginrightonly nonature-back"><label for="customerinput" class="valignmiddle">Customer<input id="customerinput" class="flat checkforselect marginleftonly valignmiddle" type="checkbox" name="customer" value="1"></label></span>
				<span id="spannature3" class="spannature paddinglarge marginrightonly nonature-back"><label for="supplierinput" class="valignmiddle">Supplier<input id="supplierinput" class="flat checkforselect marginleftonly valignmiddle" type="checkbox" name="customer" value="1"></label></span>
				<br><br>
				<span id="spannature4" class="spannature paddinglarge marginrightonly nonature-back"><label for="prospectinput" class="valignmiddle">Prospect<input id="prospectinput2" class="flat checkforselect marginleftonly valignmiddle" type="checkbox" name="customer" value="1" checked></label></span>
				<span id="spannature5" class="spannature paddinglarge marginrightonly nonature-back"><label for="customerinput" class="valignmiddle">Customer<input id="customerinput2" class="flat checkforselect marginleftonly valignmiddle" type="checkbox" name="customer" value="1" checked></label></span>
				<span id="spannature6" class="spannature paddinglarge marginrightonly nonature-back"><label for="supplierinput" class="valignmiddle">Supplier<input id="supplierinput2" class="flat checkforselect marginleftonly valignmiddle" type="checkbox" name="customer" value="1" checked></label></span>
			</div>
			<?php
			$lines = array(
				'<span id="spannature1" class="spannature paddinglarge marginrightonly nonature-back"><label for="prospectinput" class="valignmiddle">Prospect<input id="prospectinput" class="flat checkforselect marginleftonly valignmiddle" type="checkbox" name="customer" value="1"></label></span>',
				'<span id="spannature2" class="spannature paddinglarge marginrightonly nonature-back"><label for="customerinput" class="valignmiddle">Customer<input id="customerinput" class="flat checkforselect marginleftonly valignmiddle" type="checkbox" name="customer" value="1"></label></span>',
				'<span id="spannature3" class="spannature paddinglarge marginrightonly nonature-back"><label for="supplierinput" class="valignmiddle">Supplier<input id="supplierinput" class="flat checkforselect marginleftonly valignmiddle" type="checkbox" name="customer" value="1"></label></span>',
				' ',
				'<span id="spannature1" class="spannature paddinglarge marginrightonly nonature-back"><label for="prospectinput" class="valignmiddle">Prospect<input id="prospectinput" class="flat checkforselect marginleftonly valignmiddle" type="checkbox" name="customer" value="1" checked></label></span>',
				'<span id="spannature2" class="spannature paddinglarge marginrightonly nonature-back"><label for="customerinput" class="valignmiddle">Customer<input id="customerinput" class="flat checkforselect marginleftonly valignmiddle" type="checkbox" name="customer" value="1" checked></label></span>',
				'<span id="spannature3" class="spannature paddinglarge marginrightonly nonature-back"><label for="supplierinput" class="valignmiddle">Supplier<input id="supplierinput" class="flat checkforselect marginleftonly valignmiddle" type="checkbox" name="customer" value="1" checked></label></span>',
			);
			echo $documentation->showCode($lines); ?>
		</div>

		<!-- Radio input -->
		<div class="documentation-section" id="setinputssection-basicusage">
			<h2 class="documentation-title"><?php echo $langs->trans('DocCheckboxInputUsage'); ?></h2>
			<p class="documentation-text"><?php echo $langs->trans('DocCheckboxInputDescription'); ?></p>
			<div class="documentation-example">

			</div>
			<?php
			$lines = array(
			);
			echo $documentation->showCode($lines); ?>
		</div>

		<!-- Multiselect input -->
		<div class="documentation-section" id="setinputssection-basicusage">
			<h2 class="documentation-title"><?php echo $langs->trans('DocMultiSelectInputUsage'); ?></h2>
			<p class="documentation-text"><?php echo $langs->trans('DocMultiSelectInputDescription'); ?></p>
			<div class="documentation-example">
				<td>Multiselect</td>
				<?php
				$values = ['1' => 'value 1', '2' => 'value 2', '3' => 'value 3'];
				$form = new Form($db);
				print $form->multiselectarray('categories', $values, GETPOST('categories', 'array'), 0, 0, 'minwidth200', 0, 0);
				?>
			</div>
			<?php
			$lines = array(
				'<?php',
				'/**',
				' * Show a multiselect form from an array. WARNING: Use this only for short lists.',
				' *',
				' * @param 	string 		$htmlname 		Name of select',
				' * @param 	array<string,string|array{id:string,label:string,color:string,picto:string,labelhtml:string}>	$array 			Array(key=>value) or Array(key=>array(\'id\'=>key, \'label\'=>value, \'color\'=> , \'picto\'=> , \'labelhtml\'=> ))',
				' * @param 	string[]	$selected 		Array of keys preselected',
				' * @param 	int<0,1>	$key_in_label 	1 to show key like in "[key] value"',
				' * @param 	int<0,1>	$value_as_key 	1 to use value as key',
				' * @param 	string 		$morecss 		Add more css style',
				' * @param 	int<0,1> 	$translate 		Translate and encode value',
				' * @param 	int|string 	$width 			Force width of select box. May be used only when using jquery couch. Example: 250, \'95%\'',
				' * @param 	string 		$moreattrib 	Add more options on select component. Example: \'disabled\'',
				' * @param 	string 		$elemtype 		Type of element we show (\'category\', ...). Will execute a formatting function on it. To use in readonly mode if js component support HTML formatting.',
				' * @param 	string 		$placeholder 	String to use as placeholder',
				' * @param 	int<-1,1> 	$addjscombo 	Add js combo',
				' * @return 	string                      HTML multiselect string',
				' * @see selectarray(), selectArrayAjax(), selectArrayFilter()',
				' */',
				'',
				'<td>Multiselect</td>',
				'print $form->multiselectarray(\'categories\', $values, GETPOST(\'categories\', \'array\'), 0, 0, \'minwidth200\', 0, 0);'
			);
			echo $documentation->showCode($lines); ?>
		</div>

		<!-- Multiselect input -->
		<div class="documentation-section" id="setinputssection-basicusage">
			<h2 class="documentation-title"><?php echo $langs->trans('DocEditorInputUsage'); ?></h2>
			<p class="documentation-text"><?php echo $langs->trans('DocEditorInputDescription'); ?></p>
			<div class="documentation-example">
				<?php
				$doleditor = new DolEditor('desc', GETPOST('desc', 'restricthtml'), '', 160, 'dolibarr_details', '', false, true, getDolGlobalString('FCKEDITOR_ENABLE_DETAILS'), ROWS_4, '90%');
				$doleditor->Create();
				?>
			</div>
			<?php
			$lines = array(
				'<?php',
				'/**',
				' * Create an object to build an HTML area to edit a large string content',
				' *',
				' *  @param 	string				$htmlname		        		HTML name of WYSIWYG field',
				' *  @param 	string				$content		        		Content of WYSIWYG field',
				' *  @param	int|string			$width							Width in pixel of edit area (auto by default)',
				' *  @param 	int					$height			       		 	Height in pixel of edit area (200px by default)',
				' *  @param 	string				$toolbarname	       		 	Name of bar set to use (\'Full\', \'dolibarr_notes[_encoded]\', \'dolibarr_details[_encoded]\'=the less featured, \'dolibarr_mailings[_encoded]\', \'dolibarr_readonly\')',
				' *  @param  string				$toolbarlocation       			Deprecated. Not used',
				' *  @param  bool				$toolbarstartexpanded  			Bar is visible or not at start',
				' *  @param	bool|int			$uselocalbrowser				Enabled to add links to local object with local browser. If false, only external images can be added in content.',
				' *  @param  bool|int|string		$okforextendededitor    		1 or True=Allow usage of extended editor tool if qualified (like ckeditor). If \'textarea\', force use of simple textarea. If \'ace\', force use of Ace.',
				' *                          	                        		Warning: If you use \'ace\', don\'t forget to also include ace.js in page header. Also, the button "save" must have class="buttonforacesave"',
				' *  @param  int					$rows                   		Size of rows for textarea tool',
				' *  @param  string				$cols                   		Size of cols for textarea tool (textarea number of cols \'70\' or percent \'x%\')',
				' *  @param	int<0,1>			$readonly						0=Read/Edit, 1=Read only',
				' *  @param	array{x?:string,y?:string,find?:string}	$poscursor	Array for initial cursor position array(\'x\'=>x, \'y\'=>y).',
				' *                      	                       				array(\'find\'=> \'word\')  can be used to go to line were the word has been found',
				' */',
				'',
				'$doleditor = new DolEditor(\'desc\', GETPOST(\'desc\', \'restricthtml\'), \'\', 160, \'dolibarr_details\', \'\', false, true, getDolGlobalString(\'FCKEDITOR_ENABLE_DETAILS\'), ROWS_4, \'90%\');',
				'print $form->multiselectarray(\'categories\', $values, GETPOST(\'categories\', \'array\'), 0, 0, \'minwidth200\', 0, 0);'
			);
			echo $documentation->showCode($lines); ?>
		</div>
	</div>

</div>

<script>
	function refreshNatureCss() {
		jQuery(".spannature").each(function( index ) {
			id = $(this).attr("id").split("spannature")[1];
			console.log(jQuery("#spannature"+(id)+" .checkforselect").is(":checked"));
			if (jQuery("#spannature"+(id)+" .checkforselect").is(":checked")) {
				if (id == 1) {
					jQuery("#spannature"+(id)).addClass("prospect-back").removeClass("nonature-back");
				}
				if (id == 2) {
					jQuery("#spannature"+(id)).addClass("customer-back").removeClass("nonature-back");
				}
				if (id == 3) {
					jQuery("#spannature"+(id)).addClass("vendor-back").removeClass("nonature-back");
				}
			} else {
				jQuery("#spannature"+(id)).removeClass("prospect-back").removeClass("customer-back").removeClass("vendor-back").addClass("nonature-back");
			}
		});
	}

	jQuery(".spannature").click(function(){
		console.log("hey");
		refreshNatureCss();
	});
	refreshNatureCss();
</script>';

<?php
// Output close body + html
$documentation->docFooter();

?>
