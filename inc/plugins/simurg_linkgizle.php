<?php

/**
 * MyBB 1.8 Linkleri Gizle Eklentisi v1.0
 * Harici linkleri belirlenen kullanıcı grupları ve gönderi sayısı şartlarına göre gizler ve gizlenen linkler yerine özelleştirilebilir mesajlar ekler.
 * Eklenti Yapımcısı: Simurg
 * Eklenti Sürümü: 1.0
 * MyBB Uyumluluk: 1.8*
 * Test Status: MyBB v1.8.39 and PHP 8.0, PHP 7.4.33, PHP 8.1, PHP 8.2, PHP 8.3.36
 * Son Güncelleme: 15.06.2025, 01:38 (GMT+3)
 * 
 * Plugin Support: https://mybb.pro
 * Author Profile: https://mybb.pro/profil-simurg/
 */

if (!defined("IN_MYBB")) {
    die("Bu dosyaya doğrudan erişemezsiniz.");
}

// Hooks
$plugins->add_hook('postbit', 'simurg_linkgizle_filters');
$plugins->add_hook('admin_config_settings_change_commit', 'simurg_linkgizle_update_css_save');
$plugins->add_hook('admin_config_settings_change', 'simurg_linkgizle_temizle_settings');

// Eklenti bilgileri
function simurg_linkgizle_info()
{
    global $lang;

    if (!isset($lang->simurg_linkgizle)) {
        $lang->load("simurg_linkgizle");
    }
    return [
        "name" => $lang->simurg_linkgizle_ad ?? "Linkleri Gizle",
        "description" => $lang->simurg_linkgizle_desc ?? "Harici linkleri gizler ve yetkilendirme sağlar.",
        "website" => "https://mybb.pro",
        "author" => "Simurg",
        "authorsite" => "https://mybb.pro/profil-simurg",
        "version" => "1.0",
        "codename" => "simurg_linkgizle",
        "compatibility" => "18*"
    ];
}

// Eklenti kurulduğunda
function simurg_linkgizle_install()
{
    global $db, $lang;
    if (!isset($lang->simurg_linkgizle)) {
        $lang->load("simurg_linkgizle");
    }

    // Ayar grubu oluştur
    $group = [
        'name' => "simurg_linkgizle_settings",
        'title' => $lang->simurg_linkgizle_ayarbaslik ?? "Linkleri Gizle Ayarları",
        'description' => $lang->simurg_linkgizle_ayarbaslik_desc ?? "Link gizleme eklentisi için ayarlar.",
        'disporder' => 1,
        'isdefault' => 0
    ];
    (int)$gid = $db->insert_query('settinggroups', $group);

    // Eklenti ayarları
    $settings = [
        [
            'name' => 'simurg_linkgizle_enabled',
            'title' => $lang->simurg_linkgizle_aktifbaslik ?? "Eklentiyi Etkinleştir",
            'description' => $lang->simurg_linkgizle_aktifbaslik_desc ?? "Link gizleme özelliğini açar/kapatır.",
            'optionscode' => 'onoff',
            'value' => '1',
            'disporder' => 1,
            'gid' => (int)$gid
        ],
        [
            'name' => 'simurg_linkgizle_ic_linkleri_gizle',
            'title' => $lang->simurg_linkgizle_ic_linkleri_gizle_title ?? "İç Linkleri Gizle",
            'description' => $lang->simurg_linkgizle_ic_linkleri_gizle_desc ?? "Bu seçeneği Evet olarak seçerseniz iç linkler de dahil olmak üzere tüm linkler gizlenecektir. Hayır olarak seçerseniz sadece dış (harici) linkler gizlenecektir.",
            'optionscode' => 'yesno',
            'value' => '0',
            'disporder' => 2,
            'gid' => (int)$gid
        ],
        [
            'name' => 'simurg_linkgizle_usergroups',
            'title' => $lang->simurg_linkgizle_grupbaslik ?? "İzinli Kullanıcı Grupları",
            'description' => $lang->simurg_linkgizle_grupbaslik_desc ?? "Harici linkleri görebilecek kullanıcı grupları.",
            'optionscode' => 'groupselect',
            'value' => '2,3,4,6',
            'disporder' => 3,
            'gid' => (int)$gid
        ],
        [
            'name' => 'simurg_linkgizle_haricforumlar',
            'title' => $lang->simurg_linkgizle_haricforumlar ?? "Hariç Tutulacak Forumlar",
            'description' => $lang->simurg_linkgizle_haricforumlar_desc ?? "Link gizlemenin uygulanmayacağı forumlar.",
            'optionscode' => 'forumselect',
            'value' => '',
            'disporder' => 4,
            'gid' => (int)$gid
        ],
        [
            'name' => 'simurg_linkgizle_minposts',
            'title' => $lang->simurg_linkgizle_minposts ?? "Minimum Gönderi Sayısı",
            'description' => $lang->simurg_linkgizle_minposts_desc ?? "Linkleri görebilmek için gereken minimum gönderi sayısı.",
            'optionscode' => 'numeric',
            'value' => '15',
            'disporder' => 5,
            'gid' => (int)$gid
        ],
        [
            'name' => 'simurg_linkgizle_ziyaretcimesaji',
            'title' => $lang->simurg_linkgizle_ziyaretcimsj ?? "Ziyaretçilere Mesaj",
            'description' => $lang->simurg_linkgizle_ziyaretcimsj_desc ?? "Ziyaretçilere gösterilecek mesaj.",
            'optionscode' => 'textarea',
            'value' => $lang->simurg_linkgizle_zmesaj ?? 'Linkleri görebilmek için <a href="member.php?action=login" rel="nofollow noopener" target="_blank" title="Giriş Yap"> giriş yapın </a>veya <a href="member.php?action=register" rel="nofollow noopener" target="_blank" title="Kayıt Ol">kayıt olun</a>.',
            'disporder' => 6,
            'gid' => (int)$gid
        ],
        [
            'name' => 'simurg_linkgizle_minposts_mesaji',
            'title' => $lang->simurg_linkgizle_minposts_msj ?? "Minimum Gönderi Sayısı",
            'description' => $lang->simurg_linkgizle_minposts_msj_desc ?? "Yeterli gönderiye sahip olmayanlara gösterilecek uyarı mesajı.",
            'optionscode' => 'textarea',
            'value' => $lang->simurg_linkgizle_minposts_mesaj ?? "Linkleri görmek için en az <strong>{1}</strong> gönderiniz olmalı.",
            'disporder' => 7,
            'gid' => (int)$gid
        ],
        [
            'name' => 'simurg_linkgizle_yetkisiz_grup_mesaji',
            'title' => $lang->simurg_linkgizle_yetkisiz_grup_msj ?? "Yetkisiz Gruplar için Mesaj",
            'description' => $lang->simurg_linkgizle_yetkisiz_grup_msj_desc ?? "İzinli kullanıcı gruplarında olmayan kullanıcılara gösterilecek uyarı mesajı.",
            'optionscode' => 'textarea',
            'value' => $lang->simurg_linkgizle_yetkisiz_grup_mesaj ?? "Linkleri görmek için yetkili bir gruba üye olmalısınız.",
            'disporder' => 8,
            'gid' => (int)$gid
        ],
        [
            'name' => 'simurg_linkgizle_reltag',
            'title' => $lang->simurg_linkgizle_reltag_title ?? "Rel Etiketlerini Ayarla",
            'description' => $lang->simurg_linkgizle_reltag_desc ?? "Harici linklere eklenecek rel etiketleri.",
            'optionscode' => 'text',
            'value' => 'nofollow noopener ugc external',
            'disporder' => 9,
            'gid' => (int)$gid
        ],
        [
            'name' => 'simurg_linkgizle_custom_css',
            'title' => $lang->simurg_linkgizle_custom_css_title ?? "Özel CSS",
            'description' => $lang->simurg_linkgizle_custom_css_desc ?? "Uyarı mesajları için özel CSS.",
            'optionscode' => 'textarea',
            'value' => ".simurg_linkgizle_uyari {\ndisplay: inline-flex;\nalign-items: center;\npadding: 8px 12px;\ngap: 3px;\nmargin: 10px 0px;\nbackground-color: #ffefc2;\ncolor: #7a4e00;\nborder: 1px solid #ffd042;\nborder-radius: 5px;\nfont-size: 14px;\nbox-shadow: 0 2px 4px rgba(0,0,0,0.1);\n}\n.simurg_linkgizle_uyari a {\nfont-weight:600;}",
            'disporder' => 10,
            'gid' => (int)$gid
        ],
        [
            'name' => 'simurg_linkgizle_izinli_alanadlari',
            'title' => $lang->simurg_lingizle_izinli_alandlari_title ?? "Muaf Tutulacak Domainler",
            'description' => $lang->simurg_lingizle_izinli_alandlari_desc ?? "Bu domainlere sahip linkler gizlenmeyecek. Sadece geçerli domain adlarını virgülle ayırarak girin (örneğin: google.com, mybb.pro). \'https://\' veya \'http://\' eklemeyin; otomatik olarak kaldırılır. Geçersiz domainler (örneğin, alanadi@.com, alanadi..com gibi boşluk içeren veya özel karakterli) kaydedilmez.",
            'optionscode' => 'text',
            'value' => '',
            'disporder' => 11,
            'gid' => (int)$gid
        ],
        [
            'name' => 'simurg_linkgizle_debug',
            'title' => $lang->simurg_linkgizle_debug ?? "Hata Ayıklama Modu",
            'description' => $lang->simurg_linkgizle_debug_desc ?? "Hata ayıklama için loglamayı etkinleştirir.",
            'optionscode' => 'onoff',
            'value' => '0',
            'disporder' => 12,
            'gid' => (int)$gid
        ]
    ];

    foreach ($settings as $setting) {
        $db->insert_query('settings', $setting);
    }
    rebuild_settings();
    simurg_linkgizle_update_css();
}

// CSS güncelleme
function simurg_linkgizle_update_css()
{
    global $db, $mybb;
    if (empty($mybb->settings['simurg_linkgizle_custom_css'])) {
        return;
    }

    $css_content = $db->escape_string(trim($mybb->settings['simurg_linkgizle_custom_css']));
    if (empty($css_content)) {
        return;
    }

    $query = $db->simple_select("themes", "tid");
    while ($theme = $db->fetch_array($query)) {
        $tid = (int)$theme['tid'];

        $existing = $db->fetch_array($db->simple_select(
            "themestylesheets",
            "sid",
            "tid='{$tid}' AND name='simurg_linkgizle.css'"
        ));
        if ($existing) {
            $db->update_query("themestylesheets", [
                "stylesheet" => $css_content,
                "lastmodified" => TIME_NOW
            ], "sid='{$existing['sid']}'");
        } else {
            $db->insert_query("themestylesheets", [
                'name' => 'simurg_linkgizle.css',
                'tid' => $tid,
                'attachedto' => '',
                'stylesheet' => $css_content,
                'cachefile' => 'simurg_linkgizle.css',
                'lastmodified' => TIME_NOW
            ]);
        }
        require_once MYBB_ADMIN_DIR . "inc/functions_themes.php";
        update_theme_stylesheet_list($tid);
    }
}

// Ayarları kaydetmeden önce temizleme ve doğrulama
function simurg_linkgizle_temizle_settings()
{
    global $mybb;
    if (isset($mybb->input['simurg_linkgizle_izinli_alanadlari'])) {
        $alanadlari = explode(',', $mybb->input['simurg_linkgizle_izinli_alanadlari']);
        $temizlenen_alanadlari = [];
        foreach ($alanadlari as $alanadi) {
            $temizle = simurg_linkgizle_temizle_alanadlari($alanadi);
            if (simurg_linkgizle_gecerli_alanadi($temizle)) {
                $temizlenen_alanadlari[] = $temizle;
            } else {
                if (!empty($mybb->settings['simurg_linkgizle_debug'])) {
                    error_log("simurg_linkgizle: Geçersiz domain reddedildi: " . $alanadi);
                }
            }
        }
        $temizlenen_alanadlari = array_filter($temizlenen_alanadlari);
        $mybb->input['simurg_linkgizle_izinli_alanadlari'] = implode(',', $temizlenen_alanadlari);
    }
}

// CSS güncelleme tetikleyici
function simurg_linkgizle_update_css_save()
{
    global $mybb;
    if (strpos($_SERVER['REQUEST_URI'], 'module=config-settings') !== false) {
        simurg_linkgizle_update_css();
    }
}

// Harici link kontrolü
function simurg_linkgizle_harici_linkler($url)
{
    $parsed = parse_url($url);
    if (!$parsed || empty($parsed['host'])) {
        return false;
    }
    $host = strtolower($parsed['host']);
    $server_host = strtolower($_SERVER['HTTP_HOST']);
    return $host !== $server_host && strpos($host, $server_host) === false;
}

function simurg_linkgizle_temizle_alanadlari($alanadi)
{
    $alanadi = trim($alanadi);
    $alanadi = preg_replace('#^https?://#i', '', $alanadi);
    return strtolower($alanadi);
}

// Domain doğrulama
function simurg_linkgizle_gecerli_alanadi($alanadi)
{
    if (empty($alanadi) || strlen($alanadi) < 3) {
        return false;
    }
    $pattern = '/^[a-z0-9]([a-z0-9-]*[a-z0-9])?(\.[a-z0-9]([a-z0-9-]*[a-z0-9])?)*$/i';
    return preg_match($pattern, $alanadi);
}

function simurg_linkgizle_filters(&$post)
{
    global $mybb;

    // Ayarları önbelleğe al
    static $settings_cache = null;
    if ($settings_cache === null) {
        $settings_cache = [
            'enabled' => !empty($mybb->settings['simurg_linkgizle_enabled']),
            'excluded_forums' => array_filter(array_map('intval', explode(',', $mybb->settings['simurg_linkgizle_haricforumlar'] ?? '')), function ($id) {
                return $id > 0;
            }),
            'ic_linkleri_gizle' => !empty($mybb->settings['simurg_linkgizle_ic_linkleri_gizle']),
            'izinli_alanadlari' => array_filter(
                array_map('simurg_linkgizle_temizle_alanadlari', explode(',', $mybb->settings['simurg_linkgizle_izinli_alanadlari'] ?? '')),
                'simurg_linkgizle_gecerli_alanadi'
            ),
            'reltag' => htmlspecialchars($mybb->settings['simurg_linkgizle_reltag'] ?? 'nofollow noopener ugc external', ENT_QUOTES, 'UTF-8'),
            'ziyaretci_mesaji' => $mybb->settings['simurg_linkgizle_ziyaretcimesaji'] ?? 'Linkleri görebilmek için <a href="member.php?action=login" rel="nofollow noopener" target="_blank" title="Giriş Yap"> giriş yapın </a>veya <a href="member.php?action=register" rel="nofollow noopener" target="_blank" title="Kayıt Ol">kayıt olun</a>.',
            'yetkisiz_grup_mesaji' => $mybb->settings['simurg_linkgizle_yetkisiz_grup_mesaji'] ?? 'Linkleri görmek için yetkili bir gruba üye olmalısınız.',
            'minposts_mesaji' => $mybb->settings['simurg_linkgizle_minposts_mesaji'] ?? "Linkleri görmek için en az {1} gönderiniz olmalı.",
            'min_posts' => max(0, (int)($mybb->settings['simurg_linkgizle_minposts'] ?? 15)),
            'debug' => !empty($mybb->settings['simurg_linkgizle_debug'])
        ];
    }

    // Eklenti etkin değilse çık
    if (!$settings_cache['enabled']) {
        return;
    }

    // Forum hariç tutulmuşsa çık
    if (in_array((int)$post['fid'], $settings_cache['excluded_forums'])) {
        return;
    }

    // Kullanıcı bilgilerini kontrol et ve gönderi sayısını belirle
    if (!is_array($mybb->user)) {
        $gonderi_sayisi = 0;
    } elseif (!array_key_exists('uid', $mybb->user)) {
        $gonderi_sayisi = 0;
    } elseif ($mybb->user['uid'] == 0) {
        $gonderi_sayisi = 0;
    } else {
        $gonderi_sayisi = isset($mybb->user['postnum']) ? (int)$mybb->user['postnum'] : 0;
    }

    // Kullanıcı yetki kontrolünü önbelleğe al
    static $gorebilir_mi_cache = null;
    static $kullanici_gruplari = null;
    if ($gorebilir_mi_cache === null) {
        $izinli_gruplar = array_filter(array_map('intval', explode(',', $mybb->settings['simurg_linkgizle_usergroups'] ?? '2,3,4,6')), function ($id) {
            return $id > 0;
        });
        $kullanici_gruplari = [(int)$mybb->user['usergroup']];
        if (!empty($mybb->user['additionalgroups'])) {
            $kullanici_gruplari = array_merge($kullanici_gruplari, array_map('intval', explode(',', $mybb->user['additionalgroups'])));
        }
        $giris_yapan_gorebilir = array_intersect($izinli_gruplar, $kullanici_gruplari);
        $gorebilir_mi_cache = !empty($giris_yapan_gorebilir) && ($mybb->user['uid'] == 0 || $gonderi_sayisi >= $settings_cache['min_posts']);
    }
    $gorebilir_mi = $gorebilir_mi_cache;

    // Mesaj içeriği
    $message_content = $post['message'];

    // Mesajda link yoksa çık
    if (strpos($message_content, '<a ') === false) {
        return;
    }

    // Parser nesnesini kontrol et ve gerekirse başlat
    if (!isset($mybb->parser) || !is_object($mybb->parser)) {
        require_once MYBB_ROOT . 'inc/class_parser.php';
        $mybb->parser = new postParser;
    }

    // Harici linkleri yakala (optimize edilmiş regex)
    $url_pattern = '#((?:<[^>]+>)*)<a\s+(?![^>]*class=["\'][^"\']*quick_jump[^"\']*["\'])href=["\']((?:https?://|//)[^\s<>"\']*?)["\'][^>]*>(.*?)</a>((?:<[^>]+>)*)#i';
    preg_match_all($url_pattern, $message_content, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
        $prefix_tags = $match[1];
        $url = $match[2];
        $link_text = $match[3];
        $suffix_tags = $match[4];
        $full_match = $match[0];

        // Harici link mi? iç link mi?
        if (!$settings_cache['ic_linkleri_gizle'] && !simurg_linkgizle_harici_linkler($url)) {
            continue;
        }
        if ($settings_cache['ic_linkleri_gizle'] || simurg_linkgizle_harici_linkler($url)) {
            $parsed = parse_url($url);
            $host = strtolower($parsed['host'] ?? '');
            if (in_array($host, $settings_cache['izinli_alanadlari'])) {
                continue;
            }
        }

        // Yetkili kullanıcı için linki yeniden oluştur
        if ($gorebilir_mi) {
            $link_pattern = '#<a\s+href=["\']' . preg_quote($url, '#') . '["\'][^>]*>#i';
            $updated_link = preg_replace($link_pattern, '<a href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '" rel="' . $settings_cache['reltag'] . '">', $full_match);
            $replacement = $updated_link;
        } else {
            // Yetkisiz kullanıcı için uyarı mesajı
            if ($mybb->user['uid'] == 0) {
                $uyari = $settings_cache['ziyaretci_mesaji'];
            } elseif (empty(array_intersect($izinli_gruplar, $kullanici_gruplari))) {
                $uyari = $settings_cache['yetkisiz_grup_mesaji'];
            } else {
                $minPosts = $settings_cache['min_posts'];
                $uyari = str_replace('{1}', $minPosts, $settings_cache['minposts_mesaji']);
            }
            // MyBB'nin parse_message fonksiyonu ile güvenli HTML işleme
            $parser_options = [
                'allow_html' => 1,
                'allow_mycode' => 0,
                'allow_smilies' => 0,
                'allow_imgcode' => 0,
                'filter_badwords' => 1
            ];
            $uyari = $mybb->parser->parse_message($uyari, $parser_options);
            $replacement = '<span class="simurg_linkgizle_uyari">' . $uyari . '</span>';

            // Hata ayıklama logu
            if ($settings_cache['debug']) {
                error_log("simurg_linkgizle: Link gizlendi: URL=" . $url . ", Kullanıcı UID=" . $mybb->user['uid'] . ", Grup=" . implode(',', $kullanici_gruplari) . ", Gönderi Sayısı=" . $gonderi_sayisi);
            }
        }

        // Mesajda linki değiştir
        $message_content = str_replace($full_match, $replacement, $message_content);
    }
    if ($settings_cache['ic_linkleri_gizle'] && $mybb->user['uid'] == 0) {
        $quick_pattern = '#<a\s+[^>]*class=["\']([^"\']*\s)?quick_jump(\s[^"\']*)?["\'][^>]*>.*?</a>#i';
        $message_content = preg_replace($quick_pattern, '', $message_content);
    }
    // Güncellenmiş mesajı geri yaz
    $post['message'] = $message_content;
}

// Eklentiyi kaldırma
function simurg_linkgizle_uninstall()
{
    global $db;
    $gid = (int)$db->fetch_field(
        $db->simple_select("settinggroups", "gid", "name = 'simurg_linkgizle_settings'"),
        "gid"
    );

    if ($gid > 0) {
        $db->delete_query("settings", "gid = '{$gid}'");
        $db->delete_query("settinggroups", "gid = '{$gid}'");
    }

    $query = $db->simple_select("themestylesheets", "sid, tid", "name = 'simurg_linkgizle.css'");
    while ($sheet = $db->fetch_array($query)) {
        $db->delete_query("themestylesheets", "sid = '{$sheet['sid']}'");
        require_once MYBB_ADMIN_DIR . "inc/functions_themes.php";
        update_theme_stylesheet_list($sheet['tid']);
    }

    rebuild_settings();
}

// Eklenti kurulu mu?
function simurg_linkgizle_is_installed()
{
    global $db;
    $query = $db->simple_select("settinggroups", "gid", "name = 'simurg_linkgizle_settings'");
    return (bool)$db->num_rows($query);
}
