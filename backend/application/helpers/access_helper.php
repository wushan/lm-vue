<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/******************** 判斷登入 *************************/
if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        $CI =& get_instance();

        return $CI->session->userdata('logged_in');
    }
}

/******************** 跳轉頁面 *************************/
if (!function_exists('js_location')) {
    function js_location($go)
    {
        echo "<script>location.href='" . $go . "';</script>";
    }
}

/******************** 回前頁 *************************/
if (!function_exists('js_back')) {
    function js_back()
    {
        echo "<script>history.back();</script>";
    }
}

/******************** 提示框 *************************/
if (!function_exists('js_warn')) {
    function js_warn($act)
    {
        //防js中文亂碼
        ini_set('default_charset', 'utf-8');
        echo "<script>alert('" . $act . "');</script>";
    }
}

/******************** 提示框&返回 *************************/
if (!function_exists('js_warn_back')) {
    function js_warn_back($act)
    {
        //防js中文亂碼
        ini_set('default_charset', 'utf-8');
        echo "<script>alert('" . $act . "');</script>";
        echo "<script>history.back();</script>";
    }
}

/******************** 檢查數值 *************************/
if (!function_exists('check_input_value')) {
    function check_input_value($value, $is_num = false, $default = NULL)
    {
        if (!empty($value) && (!$is_num || ($is_num && is_numeric($value))) && $value != '-1') {
            return $value;
        } else {
            if ($is_num && !is_numeric($default)) {
                return 0;
            } else if (!$is_num && is_numeric($default)) {
                return NULL;
            }
        }
        return $default;
    }
}

/******************** 檢查檔案是否存在 *************************/
if (!function_exists('check_file_path')) {
    function check_file_path($path)
    {
        if ($path != '' && $path != false) {
            if (file_exists($path)) {
                return base_url($path);
            }
        }
        return NULL;
    }
}

/******************** 啟用/未啟用圖片 *************************/
if (!function_exists('show_enable_image')) {
    function show_enable_image($boolean)
    {
        if ($boolean) {
            return base_url("assets/backend/img/bullet_tick.png");
        } else {
            return base_url("assets/backend/img/bullet_cross.png");
        }
    }
}

/******************** 取得youtube ID *************************/
if (!function_exists('youtube_id')) {
    function youtube_id($url)
    {
        if (!empty($url) && $url != '') {
            $parts = parse_url($url);
            if (isset($parts['query'])) {
                parse_str($parts['query'], $qs);
                if (isset($qs['v'])) {
                    return $qs['v'];
                } else if (isset($qs['vi'])) {
                    return $qs['vi'];
                }
            }
            if (isset($parts['path'])) {
                $path = explode('/', trim($parts['path'], '/'));
                return $path[count($path) - 1];
            }
        }
        return false;
    }
}

/******************** 取得所有國家 *************************/
if (!function_exists('get_all_country')) {
    function get_all_country()
    {
        return array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
    }
}

/******************** 取得所有縣市 *************************/
if (!function_exists('get_all_zone')) {
    function get_all_zone($city = false)
    {
        $zone = array(
            "台北市" => array("中正區", "大同區", "中山區", "松山區", "大安區", "萬華區", "信義區", "士林區", "北投區", "內湖區", "南港區", "文山區"),
            "基隆市" => array("仁愛區", "信義區", "中正區", "中山區", "安樂區", "暖暖區", "七堵區"),
            "新北市" => array("萬里區", "金山區", "板橋區", "汐止區", "深坑區", "石碇區", "瑞芳區", "平溪區", "雙溪區", "貢寮區", "新店區", "坪林區", "烏來區", "永和區", "中和區", "土城區", "三峽區", "樹林區", "鶯歌區", "三重區", "新莊區", "泰山區", "林口區", "蘆洲區", "五股區", "八里區", "淡水區", "三芝區", "石門區"),
            "宜蘭縣" => array("宜蘭市", "頭城鎮", "礁溪鄉", "壯圍鄉", "員山鄉", "羅東鎮", "三星鄉", "大同鄉", "五結鄉", "冬山鄉", "蘇澳鎮", "南澳鄉"),
            "新竹市" => array("東　區", "北　區", "香山區"),
            "新竹縣" => array("竹北市", "湖口鄉", "新豐鄉", "新埔鎮", "關西鎮", "芎林鄉", "寶山鄉", "竹東鎮", "五峰鄉", "橫山鄉", "尖石鄉", "北埔鄉", "峨眉鄉"),
            "桃園縣" => array("中壢市", "平鎮市", "龍潭鄉", "楊梅鎮", "新屋鄉", "觀音鄉", "桃園市", "龜山鄉", "八德市", "大溪鎮", "復興鄉", "大園鄉", "蘆竹鄉"),
            "苗栗縣" => array("竹南鎮", "頭份鎮", "三灣鄉", "南庄鄉", "獅潭鄉", "後龍鎮", "通霄鎮", "苑裡鎮", "苗栗市", "造橋鄉", "頭屋鄉", "公館鄉", "大湖鄉", "泰安鄉", "銅鑼鄉", "三義鄉", "西湖鄉", "卓蘭鎮"),
            "台中市" => array("中　區", "東　區", "南　區", "西　區", "北　區", "北屯區", "西屯區", "南屯區", "太平區", "大里區", "霧峰區", "烏日區", "豐原區", "后里區", "石岡區", "東勢區", "和平區", "新社區", "潭子區", "大雅區", "神岡區", "大肚區", "沙鹿區", "龍井區", "梧棲區", "清水區", "大甲區", "外埔區", "大安區"),
            "彰化縣" => array("彰化市", "芬園鄉", "花壇鄉", "秀水鄉", "鹿港鎮", "福興鄉", "線西鄉", "和美鎮", "伸港鄉", "員林鎮", "社頭鄉", "永靖鄉", "埔心鄉", "溪湖鎮", "大村鄉", "埔鹽鄉", "田中鎮", "北斗鎮", "田尾鄉", "埤頭鄉", "溪州鄉", "竹塘鄉", "二林鎮", "大城鄉", "芳苑鄉", "二水鄉"),
            "南投縣" => array("南投市", "中寮鄉", "草屯鎮", "國姓鄉", "埔里鎮", "仁愛鄉", "名間鄉", "集集鎮", "水里鄉", "魚池鄉", "信義鄉", "竹山鎮", "鹿谷鄉"),
            "嘉義市" => array("東　區", "西　區"),
            "嘉義縣" => array("番路鄉", "梅山鄉", "竹崎鄉", "阿里山", "中埔鄉", "大埔鄉", "水上鄉", "鹿草鄉", "太保市", "朴子市", "東石鄉", "六腳鄉", "新港鄉", "民雄鄉", "大林鎮", "溪口鄉", "義竹鄉", "布袋鎮"),
            "雲林縣" => array("斗南鎮", "大埤鄉", "虎尾鎮", "土庫鎮", "褒忠鄉", "東勢鄉", "台西鄉", "崙背鄉", "麥寮鄉", "斗六市", "林內鄉", "古坑鄉", "莿桐鄉", "西螺鎮", "二崙鄉", "北港鎮", "水林鄉", "口湖鄉", "四湖鄉", "元長鄉"),
            "台南市" => array("中西區", "東　區", "南　區", "北　區", "安平區", "安南區", "永康區", "歸仁區", "新化區", "左鎮區", "玉井區", "楠西區", "南化區", "仁德區", "關廟區", "龍崎區", "官田區", "麻豆區", "佳里區", "西港區", "七股區", "將軍區", "學甲區", "北門區", "新營區", "後壁區", "白河區", "東山區", "六甲區", "下營區", "柳營區", "鹽水區", "善化區", "大內區", "山上區", "新市區", "安定區"),
            "高雄市" => array("新興區", "前金區", "苓雅區", "鹽埕區", "鼓山區", "旗津區", "前鎮區", "三民區", "楠梓區", "小港區", "左營區", "仁武區", "大社區", "岡山區", "路竹區", "阿蓮區", "田寮區", "燕巢區", "橋頭區", "梓官區", "彌陀區", "永安區", "湖內區", "鳳山區", "大寮區", "林園區", "鳥松區", "大樹區", "旗山區", "美濃區", "六龜區", "內門區", "杉林區", "甲仙區", "桃源區", "那瑪夏", "茂林區", "茄萣區"),
            "屏東縣" => array("屏東市", "三地門", "霧台鄉", "瑪家鄉", "九如鄉", "里港鄉", "高樹鄉", "鹽埔鄉", "長治鄉", "麟洛鄉", "竹田鄉", "內埔鄉", "萬丹鄉", "潮州鎮", "泰武鄉", "來義鄉", "萬巒鄉", "崁頂鄉", "新埤鄉", "南州鄉", "林邊鄉", "東港鎮", "琉球鄉", "佳冬鄉", "新園鄉", "枋寮鄉", "枋山鄉", "春日鄉", "獅子鄉", "車城鄉", "牡丹鄉", "恆春鎮", "滿州鄉"),
            "台東縣" => array("台東市", "綠島鄉", "蘭嶼鄉", "延平鄉", "卑南鄉", "鹿野鄉", "關山鎮", "海端鄉", "池上鄉", "東河鄉", "成功鎮", "長濱鄉", "太麻里", "金峰鄉", "大武鄉", "達仁鄉"),
            "花蓮縣" => array("花蓮市", "新城鄉", "秀林鄉", "吉安鄉", "壽豐鄉", "鳳林鎮", "光復鄉", "豐濱鄉", "瑞穗鄉", "萬榮鄉", "玉里鎮", "卓溪鄉", "富里鄉"),
            "澎湖縣" => array("馬公市", "西嶼鄉", "望安鄉", "七美鄉", "白沙鄉", "湖西鄉"),
            "金門縣" => array("金沙鎮", "金湖鎮", "金寧鄉", "金城鎮", "烈嶼鄉", "烏坵鄉"),
            "連江縣" => array("南竿鄉", "北竿鄉", "莒光鄉", "東引鄉"),
            "南海島" => array("東　沙", "南　沙"),
            "釣魚台" => array("")
        );

        if ($city) {
            return $zone[$city];
        } else {
            return array('台北市', '新北市', '基隆市', '宜蘭縣', '桃園縣', '新竹市', '新竹縣', '苗栗縣', '台中市', '彰化縣', '南投縣', '雲林縣', '嘉義市', '嘉義縣', '台南市', '高雄市', '屏東縣', '花蓮縣', '台東縣', '澎湖縣', '金門縣', '連江縣', '南海島', '釣魚台');
        }
    }
}

/******************** 取得後台選單 *************************/
if (!function_exists('get_menu_item')) {
    function get_menu_item($row)
    {
        $CI =& get_instance();

        return $CI->load->view("_menuItem", array('row' => $row), true);
    }
}

/******************** 支援 png & gif 縮圖 *************************/
if (!function_exists('image_resize_transparent')) {
    function image_resize_transparent($from_filename, $save_filename, $new_width = 400, $new_height = 300)
    {
        // 透明背景只有 png 和 gif 支援
        $allow_format = array('png', 'gif');
        $sub_name = $t = '';

        // Get new dimensions
        $img_info = getimagesize($from_filename);
        $width = $img_info['0'];
        $height = $img_info['1'];
        $mime = $img_info['mime'];

        list($t, $sub_name) = explode('/', $mime);
        if (!in_array($sub_name, $allow_format))
            return false;

        // Resample
        $image_new = imagecreatetruecolor($new_width, $new_height);

        // $function_name: set function name
        //   => imagecreatefrompng, imagecreatefromgif
        // $sub_name = png, gif
        $function_name = 'imagecreatefrom' . $sub_name;

        $image = $function_name($from_filename); //$image = imagecreatefrompng($from_filename);

        // 透明背景
        imagealphablending($image_new, false);
        imagesavealpha($image_new, true);
        $color = imagecolorallocatealpha($image_new, 0, 0, 0, 127);
        imagefill($image_new, 0, 0, $color);

        imagecopyresampled($image_new, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // return imagepng($image_new, $save_filename);
        $function_name = 'image' . $sub_name;
        return $function_name($image_new, $save_filename);
    }
}

/******************** 取得分頁的第一頁 *************************/
if (!function_exists('pageStart')) {
    function pageStart($page, $totalPage, $maxPage)
    {
        $start = $page - floor($maxPage / 2);
        if ($totalPage <= $maxPage || $start < 1) return 1;
        if ($page + floor($maxPage / 2) > $totalPage) return $totalPage - floor($maxPage / 2) * 2;
        return $start;
    }
}

/******************** 取得分頁的最後頁 *************************/
if (!function_exists('pageEnd')) {
    function pageEnd($page, $totalPage, $maxPage)
    {
        $end = $page + floor($maxPage / 2);
        if ($totalPage <= $maxPage || $end > $totalPage) return $totalPage;
        if ($page - floor($maxPage / 2) < 1) return $maxPage;
        return $end;
    }
}


if (!function_exists('cUrlPost')) {
    function cUrlPost($toURL)
    {
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $toURL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        );

        curl_setopt_array($ch, $options);
        $result=curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}