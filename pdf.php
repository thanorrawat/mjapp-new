<?php return [
	'mode'                 => '',
	'format'               => 'A4',
	'default_font_size'    => '12',
	'default_font'         => 'sarabun',
	'margin_left'          => 10,
	'margin_right'         => 10,
	'margin_top'           => 10,
	'margin_bottom'        => 10,
	'margin_header'        => 0,
	'margin_footer'        => 0,
	'orientation'          => 'P',
	'title'                => 'Laravel mPDF',
	'author'               => '',
	'watermark'            => '',
	'show_watermark'       => false,
	'watermark_font'       => 'sans-serif',
	'display_mode'         => 'fullpage',
	'watermark_text_alpha' => 0.1,
    'custom_font_dir' => base_path('public/fonts/'), // don't forget the trailing slash!
	'custom_font_data' => [
		'sarabun' => [
			'R'  => 'Sarabun-Regular.ttf',    // regular font
			'B'  => 'Sarabun-Bold.ttf',       // optional: bold font
			'I'  => 'Sarabun-Italic.ttf',     // optional: italic font
			'BI' => 'Sarabun-BoldItalic.ttf' // optional: bold-italic font
		]
		// ...add as many as you want.
        ],
	'auto_language_detection'  => false,
	'temp_dir'               => '',
	'pdfa' 			=> false,
    'pdfaauto' 		=> false,
];
?>