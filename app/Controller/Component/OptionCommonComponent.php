<?php
App::uses('Component', 'Controller');
class OptionCommonComponent extends Component {
	public $day = array(
		1 => '1',
		2 => '2',
		3 => '3',
		4 => '4',
		5 => '5',
		6 => '6',
		7 => '7',
		8 => '8',
		9 => '9',
		10 => '10',
		11 => '11',
		12 => '12',
		13 => '13',
		14 => '14',
		15 => '15',
		16 => '16',
		17 => '17',
		18 => '18',
		19 => '19',
		20 => '20',
		21 => '21',
		22 => '22',
		23 => '23',
		24 => '24',
		25 => '25',
		26 => '26',
		27 => '27',
		28 => '28',
		29 => '29',
		30 => '30',
		31 => '31'
		);

	public $month = array(
		1 => 'JAN',
		2 => 'FEB',
		3 => 'MAR',
		4 => 'APR',
		5 => 'MAY',
		6 => 'JUN',
		7 => 'JUL',
		8 => 'AUG',
		9 => 'SEP',
		10 => 'OCT',
		11 => 'NOV',
		12 => 'DEC'
		);

	public function year() { //upto current year
		$tmp_year = array();
		for ($i = 1965; $i <= 2020; $i++) {
			$tmp_year[$i] = $i;
		}
		return $tmp_year;
	}

	public function next_three_years() { //current year plus next 3 years in admin company ,headhunter add
		$tmp_year = array();
		for ($i = 1965; $i <= date("Y")+3; $i++) {
			$tmp_year[$i] = $i;
		}
		return $tmp_year;
	}

	public function birthYear() {
		$tmp = array();
		for($i = 1950; $i <= 2000; $i++) {
			$tmp[$i] = $i;
		}

		return $tmp;
	}

// Admin pickup start year
	public function pickYear() { // from current year to 2030
		$pick_year = array();
		for ($i = date("Y"); $i <= 2030; $i++) {
			$pick_year[$i] = $i;
		}
		return $pick_year;
	}


	public $employee= array(
		1 => '1 to 5 ',
		2 => '6 to 10',
		3 => '11 to 20',
		4 => '21 to 50',
		5 => '51 to 100',
		6 => '101 to 500',
		7 => '501 to 1,000',
		8 => '1,001 to 50,000',
		9 => 'more than 50,000'
		);

	public $education = array(
		1 => 'University (Doctor)',
		2 => 'University (MBA)',
		3 => 'University (Master)',
		4 => 'University (Bachelor)',
		5 => 'Others'
		);

	public $language_skill = array(
		1 => 'Native ',
		2 => 'Business',
		3 => 'Daily conversation',
		4 => 'Basic conversation',
		5 => 'No skill'
		);

	public $headhunter_language_skill = array(
		1 => 'Native ',
		2 => 'Business',
		3 => 'Daily conversation',
		4 => 'Basic conversation'
		);

	public $mail_transmission = array(
		1=> '10 jobseekers',
		2 => '30 jobseekers',
		3 => '50 jobseekers',
		4 => '100 jobseekers',
		5 => '200 jobseekers'
		);

	public $carrer_change = array(
		1 => 'Within 3 months',
		2 => 'Within 6 months',
		3 => 'Within 1 year',
		4 => 'Depends on nice opportunity',
		5 => 'No interest to change career'
		);

	public $language = array(
		1 => 'Arabic',
		2 => 'Bengali',
		3 => 'Dutch',
		4 => 'French',
		5 => 'German',
		6 => 'Hindi',
		7 => 'Indonesian',
		8 => 'Italian',
		9 => 'Korean',
		10 => 'Malay',
		11 => 'Portuguese',
		12 => 'Russian',
		13 => 'Spanish',
		14 => 'Swedish',
		15 => 'Tagalog',
		16 => 'Thai',
		17 => 'Turkish',
		18 => 'Vietnamese'
		);

	public $salary_range = array(
		1 => 'Negotiable',
		2 => '0 - 99,999 Ks',
		3 => '100,000 - 249,999 Ks',
		4 => '250,000 - 499,999 Ks',
		5 => '500,000 - 749,999 Ks',
		6 => '750,000 - 999,999 Ks',
		7 => '1,000,000 - 1,499,999 Ks',
		8 =>'1,500,000 - 1,999,999 Ks',
		9 =>'2,000,000 - 2,999,999 Ks',
		10 => '3,000,000 Ks +'
		);

	public $age =array(
		1 => '19 or below',
		2 => '20 to 29',
		3 => '30 to 39',
		4 => '40 to 49',
		5 => 'over 50'
		);

	public $country = array(
		151 => 'Myanmar',
		1 => 'Afghanistan',
		2 => 'Albania',
		3 => 'Algeria',
		4 => 'American Samoa',
		5 => 'Andorra',
		6 => 'Angola',
		7 => 'Anguilla',
		8 => 'Antarctica',
		9 => 'Antigua and Barbuda',
		10 => 'Argentina',
		11 => 'Armenia',
		12 => 'Aruba',
		13 => 'Australia',
		14 => 'Austria',
		15 => 'Azerbaijan',
		16 => 'Bahamas',
		17 => 'Bahrain',
		18 => 'Bangladesh',
		19 => 'Barbados',
		20 => 'Belarus',
		21 => 'Belgium',
		22 => 'Belize',
		23 => 'Benin',
		24 => 'Bermuda',
		25 => 'Bhutan',
		26 => 'Belgium',
		27 => 'Bolivia',
		28 => 'Bosnia and Herzegovina',
		29 => 'Botswana',
		30 => 'Bouvet Island',
		31 => 'Brazil',
		32 => 'British Indian Ocean Territory',
		33 => 'Brunei Darussalam',
		34 => 'Bulgaria',
		35 => 'Burkina Faso',
		36 => 'Burundi',
		37 => 'Cambodia',
		38 => 'Cameroon',
		39 => 'Canada',
		40 => 'Cape Verde',
		41 => 'Cayman Islands',
		42 => 'Central African Republic',
		43 => 'Chad',
		44 => 'Chile',
		45 => 'China',
		46 => 'Christmas Island',
		47 => 'Cocos (Keeling) Islands',
		48 => 'Colombia',
		49 => 'Comoros',
		50 => 'Congo',
		51 => 'Congo, The Democratic Republic of The',
		52 => 'Cook Islands',
		53 => 'Costa Rica',
		54 => 'Cote D\'ivoire',
		55 => 'Croatia',
		56 => 'Cuba',
		57 => 'Cyprus',
		58 => 'Czech Republic',
		59 => 'Denmark',
		60 => 'Djibouti',
		61 => 'Dominica',
		62 => 'Dominican Republic',
		63 => 'Easter Island',
		64 => 'Ecuador',
		65 => 'Egypt',
		66 => 'El Salvador',
		67 => 'Equatorial Guinea',
		68 => 'Eritrea',
		69 => 'Estonia',
		70 => 'Ethiopia',
		71 => 'Falkland Islands (Malvinas)',
		72 => 'Faroe Islands',
		73 => 'Fiji',
		74 => 'Finland',
		75 => 'France',
		76 => 'French Guiana',
		77 => 'French Polynesia',
		78 => 'French Southern Territories',
		79 => 'Gabon',
		80 => 'Gambia',
		81 => 'Georgia',
		82 => 'Germanyv',
		83 => 'Ghana',
		84 => 'Gibraltar',
		85 => 'Greece',
		86 => 'Greenland',
		87 => 'Grenada',
		88 => 'Guadeloupe',
		89 => 'Guam',
		90 => 'Guatemala',
		91 => 'Guinea',
		92 => 'Guinea-bissau',
		93 => 'Guyana',
		94 => 'Haiti',
		95 => 'Heard Island and Mcdonald Islands',
		96 => 'Honduras',
		97 => 'Hong Kong',
		98 => 'Hungary',
		99 => 'Iceland',
		100 => 'India',
		101 => 'Indonesia',
		102 => 'Indonesia',
		103 => 'Iran',
		104 => 'Iraq',
		105 => 'Ireland',
		106 => 'Israel',
		107 => 'Italy',
		108 => 'Jamaica',
		109 => 'Japan',
		110 => 'Jordan',
		111 => 'Kazakhstan',
		112 => 'Kazakhstan',
		113 => 'Kenya',
		114 => 'Kiribati',
		115 => 'Korea, North',
		116 => 'Korea, South',
		117 => 'Kosovo',
		118 => 'Kuwait',
		119 => 'Kyrgyzstan',
		120 => 'Laos',
		121 => 'Latvia',
		122 => 'Lebanon',
		123 => 'Lesotho',
		124 => 'Liberia',
		125 => 'Libyan Arab Jamahiriya',
		126 => 'Liechtenstein',
		127 => 'Lithuania',
		128 => 'Luxembourg',
		129 => 'Macau',
		130 => 'Macedonia',
		131 => 'Madagascar',
		132 => 'Malawi',
		133 => 'Malaysia',
		134 => 'Maldives',
		135 => 'Mali',
		136 => 'Malta',
		137 => 'Marshall Islands',
		138 => 'Martinique',
		139 => 'Mauritania',
		140 => 'Mauritius',
		141 => 'Mayotte',
		142 => 'Mexico',
		143 => 'Micronesia, Federated States of',
		144 => 'Moldova, Republic of',
		145 => 'Monaco',
		146 => 'Mongolia',
		147 => 'Montenegro',
		148 => 'Montserrat',
		149 => 'Morocco',
		150 => 'Mozambique',
		152 => 'Namibia',
		153 => 'Nauru',
		154 => 'Nepal',
		155 => 'Netherlands',
		156 => 'Netherlands Antilles',
		157 => 'New Caledonia',
		158 => 'New Zealand',
		159 => 'Nicaragua',
		160 => 'Niger',
		161 => 'Nigeria',
		162 => 'Niue',
		163 => 'Norfolk Island',
		164 => 'Northern Mariana Islands',
		165 => 'Norway',
		166 => 'Oman',
		167 => 'Pakistan',
		168 => 'Palau',
		169 => 'Palestinian Territory',
		170 => 'Panama',
		171 => 'Papua New Guinea',
		172 => 'Paraguay',
		173 => 'Peru',
		174 => 'Philippines',
		175 => 'Pitcairn',
		176 => 'Poland',
		177 => 'Portugal',
		178 => 'Puerto Rico',
		179 => 'Qatar',
		180 => 'Reunion',
		181 => 'Romania',
		182 => 'Russia',
		183 => 'Russia',
		184 => 'Rwanda',
		185 => 'Saint Helena',
		186 => 'Saint Kitts and Nevis',
		187 => 'Saint Lucia',
		188 => 'Saint Pierre and Miquelon',
		189 => 'Saint Vincent and The Grenadines',
		190 => 'Samoa',
		191 => 'San Marino',
		192 => 'Sao Tome and Principe',
		193 => 'Saudi Arabia',
		194 => 'Senegal',
		195 => 'Serbia and Montenegro',
		196 => 'Seychelles',
		197 => 'Sierra Leone',
		198 => 'Singapore',
		199 => 'Slovakia',
		200 => 'Slovenia',
		201 => 'Solomon Islands',
		202 => 'Somalia',
		203 => 'South Africa',
		204 => 'Spain',
		205 => 'Sri Lanka',
		206 => 'Sudan',
		207 => 'Suriname',
		208 => 'Svalbard and Jan Mayen',
		209 => 'Swaziland',
		210 => 'Sweden',
		211 => 'Switzerland',
		212 => 'Syria',
		213 => 'Taiwan',
		214 => 'Tajikistan',
		215 => 'Tanzania',
		216 => 'Thailand',
		217 => 'Timor-leste',
		218 => 'Togo',
		219 => 'Tokelau',
		220 => 'Tonga',
		221 => 'Trinidad and Tobago',
		222 => 'Tunisia',
		223 => 'Turkey',
		224 => 'Turkey',
		225 => 'Turkmenistan',
		226 => 'Turks and Caicos Islands',
		227 => 'Tuvalu',
		228 => 'Uganda',
		229 => 'Ukraine',
		230 => 'United Arab Emirates',
		231 => 'United Kingdom',
		232 => 'United States',
		233 => 'United States Minor Outlying Islands',
		234 => 'Uruguay',
		235 => 'Uzbekistan',
		236 => 'Vanuatu',
		237 => 'Vatican City',
		238 => 'Venezuela',
		239 => 'Vietnam',
		240 => 'Virgin Islands, British',
		241 => 'Virgin Islands, U.S.',
		242 => 'Wallis and Futuna',
		243 => 'Western Sahara',
		244 => 'Yemen',
		245 => 'Yemen',
		246 => 'Zambia',
		247 => 'Zimbabwe'
	);

	public $religion = array(
		1 => 'Hinduism',
		2 => 'Buddhist',
		3 => 'Jewish',
		4 => 'Christian',
		5 => 'Islam',
		6 => 'Others',
		7 => 'irreligion'
	);

	public $marital_status = array(
		1 => 'Single',
		2 => 'Married'
	);

	public $nationality = array(
		1 => 'Myanmar',
		2 => 'China',
		3 => 'Japan',
		4 => 'South Korea',
		5 => 'India',
		6 => 'Indonesia',
		7 => 'Cambodia',
		8 => 'Singapore',
		9 => 'Sri Lanka',
		10 => 'Thailand',
		11 => 'Taiwan',
		12 => 'Nepal',
		13 => 'Pakistan',
		14 => 'Bangladesh',
		15 => 'Bhutan',
		16 => 'Philippines',
		17 => 'Brunei',
		18 => 'Viet Nam',
		19 => 'Malaysia',
		20 => 'Mongolia',
		21 => 'Laos',
		22 => 'USA',
		23 => 'UK',
		24 => 'France',
		25 => 'Italy',
		26 => 'Austria',
		27 => 'Netherland',
		28 => 'Germany',
		29 => 'Portuguese',
		30 => 'Russia',
		31 => 'Other countries'
	);

	public $ms_skill_level = array(
		1 => 'No experience',
		2 => 'Low',
		3 => 'Middle',
		4 => 'High'
	);

	public $computer_skill_level = array(
		1 => 'Low',
		2 => 'Middle',
		3 => 'High'
	);

	public $availability = array(
		1 => 'Anytime',
		2 => '1 month notice',
		3 => '2 month notice',
		4 => '3 month notice',
		5 => '3 month and more'
	);

	public $message_type = array(
		'1' => 'admin',
		'2' => 'company',
		'3' => 'headhunter',
		'4' => 'jobseeker'
	);

	public $message_label = array(
		'A' => 'admin',
		'C' => 'company',
		'H' => 'headhunter',
		'J' => 'jobseeker'
	);

	public $pick_term = array(
		1 => '3 months ',
		2 => '6 months',
		3 => '12 months'
	);
}