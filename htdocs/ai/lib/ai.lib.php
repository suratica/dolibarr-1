<?php
/* Copyright (C) 2022 Alice Adminson <aadminson@example.com>
 * Copyright (C) 2024       Frédéric France             <frederic.france@free.fr>
 * Copyright (C) 2024		MDW							<mdeweerd@users.noreply.github.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * \file    htdocs/ai/lib/ai.lib.php
 * \ingroup ai
 * \brief   Library files with common functions for Ai
 */


/**
 * Prepare admin pages header
 *
 * @return array<string,array<string,string>>
 */
function getListOfAIFeatures()
{
	global $langs;

	$arrayofaifeatures = array(
		'textgenerationemail' => array('label' => $langs->trans('TextGeneration').' ('.$langs->trans("EmailContent").')', 'picto'=>'', 'status'=>'dolibarr', 'function' => 'TEXT'),
		'textgenerationwebpage' => array('label' => $langs->trans('TextGeneration').' ('.$langs->trans("WebsitePage").')', 'picto'=>'', 'status'=>'dolibarr', 'function' => 'TEXT'),
		'textgeneration' => array('label' => $langs->trans('TextGeneration').' ('.$langs->trans("Other").')', 'picto'=>'', 'status'=>'notused', 'function' => 'TEXT'),
		'texttranslation' => array('label' => $langs->trans('TextTranslation'), 'picto'=>'', 'status'=>'dolibarr', 'function' => 'TEXT'),
		'textsummarize' => array('label' => $langs->trans('TextSummarize'), 'picto'=>'', 'status'=>'dolibarr', 'function' => 'TEXT'),
		'imagegeneration' => array('label' => 'ImageGeneration', 'picto'=>'', 'status'=>'notused', 'function' => 'IMAGE'),
		'videogeneration' => array('label' => 'VideoGeneration', 'picto'=>'', 'status'=>'notused', 'function' => 'VIDEO'),
		'audiogeneration' => array('label' => 'AudioGeneration', 'picto'=>'', 'status'=>'notused', 'function' => 'AUDIO'),
		'transcription' => array('label' => 'AudioTranscription', 'picto'=>'', 'status'=>'notused', 'function' => 'TRANSCRIPT'),
		'translation' => array('label' => 'AudioTranslation', 'picto'=>'', 'status'=>'notused', 'function' => 'TRANSLATE')
	);

	return $arrayofaifeatures;
}

/**
 * Get list of available ai services
 *
 * @return array<int|string,mixed>
 */
function getListOfAIServices()
{
	global $langs;

	$arrayofai = array(
		'-1' => $langs->trans('SelectAService'),
		'chatgpt' => 'ChatGPT',
		'groq' => 'Groq',
		'custom' => 'Custom'
		//'gemini' => 'Gemini'
	);

	return $arrayofai;
}

/**
 * Get list for AI summarize
 *
 * @return array<int|string,mixed>
 */
function getListForAISummarize()
{
	global $langs;

	$arrayforaisummarize = array(
		'20_w' => 'SummarizeTwentyWords',
		'50_w' => 'SummarizeFiftyWords',
		'100_w' => 'SummarizeHundredWords',
		'200_w' => 'SummarizeTwoHundredWords',
		'1_p' => 'SummarizeOneParagraphs',
		'2_p' => 'SummarizeTwoParagraphs'
	);

	return $arrayforaisummarize;
}

/**
 * Prepare admin pages header
 *
 * @return array<array{0:string,1:string,2:string}>
 */
function aiAdminPrepareHead()
{
	global $langs, $conf;

	$langs->load("agenda");

	$h = 0;
	$head = array();

	$head[$h][0] = dol_buildpath("/ai/admin/setup.php", 1);
	$head[$h][1] = $langs->trans("Settings");
	$head[$h][2] = 'settings';
	$h++;

	$head[$h][0] = dol_buildpath("/ai/admin/custom_prompt.php", 1);
	$head[$h][1] = $langs->trans("CustomPrompt");
	$head[$h][2] = 'custom';
	$h++;

	/*
	$head[$h][0] = dol_buildpath("/ai/admin/myobject_extrafields.php", 1);
	$head[$h][1] = $langs->trans("ExtraFields");
	$head[$h][2] = 'myobject_extrafields';
	$h++;
	*/

	// Show more tabs from modules
	// Entries must be declared in modules descriptor with line
	//$this->tabs = array(
	//	'entity:+tabname:Title:@ai:/ai/mypage.php?id=__ID__'
	//); // to add new tab
	//$this->tabs = array(
	//	'entity:-tabname:Title:@ai:/ai/mypage.php?id=__ID__'
	//); // to remove a tab
	complete_head_from_modules($conf, $langs, null, $head, $h, 'ai@ai');

	complete_head_from_modules($conf, $langs, null, $head, $h, 'ai@ai', 'remove');

	return $head;
}
