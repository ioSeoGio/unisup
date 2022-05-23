<?php
use domain\workReport\WorkReportType;

return [
	[
		'serial_number' => 1, 
		'type' => WorkReportType::SCIENTIFIC, 
		'description' => 'Выкананне праграмы, па якой універсітэт з ’яўляецца галаўной арганізацыяй (на ўсіх выканаўцаў)', 
		'brest_points' => 60, 
		'belarus_points' => 50, 
		'foreign_points' => 30
	],
	[
		'serial_number' => 2, 
		'type' => WorkReportType::SCIENTIFIC, 
		'description' => 'Выкананне праекта па праграме ЕС па навуцы і інавацыях «Гарызонт 2020» , трансгранічнага супрацоўніцтва (на ўсіх выканаўцаў,)', 
		'brest_points' => 60, 
		'belarus_points' => null, 
		'foreign_points' => null
	],            

	[
		'serial_number' => 1, 
		'type' => WorkReportType::METHODICAL, 
		'description' => 'Удзел у міжнародных адукацыйных праектах, у якіх універсітэт выступае ў якасці каардынатара ці партнёра (на ўсіх удзельнікаў ад БрДУ)', 
		'brest_points' => 60, 
		'belarus_points' => null, 
		'foreign_points' => null
	],
	[
		'serial_number' => 5, 
		'type' => WorkReportType::METHODICAL, 
		'description' => 'Апублікаванне вучэбна-метадычных рэкамендацый, атласа-альбома, слоўніка, навукова-метадычнага даведніка, рабочага сшытку для практычных і лабараторных заняткаў у ВНУ (друкаванае выданне)', 
		'brest_points' => 5, 
		'belarus_points' => 5, 
		'foreign_points' => 5
	],            

	[
		'serial_number' => 1, 
		'type' => WorkReportType::EDUCATIONAL, 
		'description' => 'Распрацоўка лакальнага прававога акта па ІВП, зацверджанага ва ўстаноўленым парадку (на ўсіх распрацоўшчыкаў)', 
		'brest_points' => null, 
		'belarus_points' => null, 
		'foreign_points' => 7
	],
	[
		'serial_number' => 6, 
		'type' => WorkReportType::EDUCATIONAL, 
		'description' => "Кіраўніцтва (без аплаты) студэнцкім пастаянна дзеючым калектывам, аб'яднаннем: добраахвотніцкія атрады, групы; клубы па інтарэсах; краязнаўчая група, творчы калектыў, зборнай камандай і інш. (пры наяўнасці загада, распараджэння і вынікаў працы", 
		'brest_points' => null, 
		'belarus_points' => null, 
		'foreign_points' => 4
	],
];
