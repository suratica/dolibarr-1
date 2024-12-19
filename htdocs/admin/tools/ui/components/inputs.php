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
				'<td>Input label</td>',
				'<td><input id="label" name="label" class="minwidth200" maxlength="255" value=""></td>',
				'',
				'<td>Disabled Input</td>',
				'<td><input id="label" name="label" class="minwidth200" maxlength="255" value="" disabled></td>',
			);
			echo $documentation->showCode($lines); ?>

			<!-- Basic usage -->
			<div class="documentation-section" id="setinputssection-basicusage">
				<h2 class="documentation-title"><?php echo $langs->trans('DocBasicUsage'); ?></h2>
				<p class="documentation-text"><?php echo $langs->trans('DocinputsDescription'); ?></p>
				<div class="documentation-example">
					<td class="fieldrequired">Available Input</td>
					<td><input id="label" name="label" class="minwidth200" maxlength="255" value=""></td>
					<td class="fieldrequired">Disabled Input</td>
					<td><input id="label" name="label" class="minwidth200 disabled" maxlength="255" value=""></td>
				</div>
				<?php
				$lines = array(
					'<td class="fieldrequired">Input label</td>',
					'<td><input type="text" id="label" name="label" class="minwidth200" maxlength="255" value=""></td>',
				);
				echo $documentation->showCode($lines); ?>
		<!--  -->
	</div>

</div>

<?php
// Output close body + html
$documentation->docFooter();

?>
