<?php

/**
 * MyBB 1.8 Hide Links Plugin v1.0 Language File
 * Language: English
 * Created and Translated by Simurg
 * Support: https://mybb.pro
 * Last Update: 14.06.2025, 16:14 (GMT+3)
 */


$l['simurg_linkgizle_ad'] = "Hide Links";
$l['simurg_linkgizle_desc'] = "Allows you to hide external links in your forum's threads and posts and display a warning message in place of the hidden links.";
$l['simurg_linkgizle_ayarbaslik'] = "Hide Links Plugin Settings";
$l['simurg_linkgizle_ayarbaslik_desc'] = "You can configure the hide links plugin settings from this section.";
$l['simurg_linkgizle_aktifbaslik'] = "Activate Plugin?";
$l['simurg_linkgizle_aktifbaslik_desc'] = "You can determine whether the plugin is active or not from here.";
$l['simurg_linkgizle_ic_linkleri_gizle_title'] = "Hide Internal Links";
$l['simurg_linkgizle_ic_linkleri_gizle_desc'] = "If you select Yes, all links, including internal links, will be hidden. If you select No, only external (external) links will be hidden.";
$l['simurg_linkgizle_grupbaslik'] = "User Groups Allowed to View Links";
$l['simurg_linkgizle_grupbaslik_desc'] = "In this section, you can select the user groups that can view hidden links regardless of conditions. <strong>Default:</strong> <i>Registered Users, Administrators, Moderators, Super Moderators</i> are selected.";
$l['simurg_linkgizle_haricforumlar'] = "Excluded Forums";
$l['simurg_linkgizle_haricforumlar_desc'] = "You can select the forums where you do not want links to be hidden. External links in the selected forums will not be hidden. <i>Hold the <strong>CTRL</strong> key to make multiple selections.</i>";
$l['simurg_linkgizle_minposts'] = "Minimum Post Count to View Links";
$l['simurg_linkgizle_minposts_desc'] = "Specify the minimum number of posts required to view hidden links. The default value is set to <i>15</i>. Users with fewer posts than this value will not be able to see external links or internal links if the hide internal links option is enabled.";
$l['simurg_linkgizle_ziyaretcimsj'] = "Message for Visitors";
$l['simurg_linkgizle_ziyaretcimsj_desc'] = "You can edit the message shown to visitors who are not logged in when external links are hidden. <strong>Supports HTML.</strong>";
$l['simurg_linkgizle_zmesaj'] = "To view links, please <a href=\"member.php?action=login\" rel=\"nofollow noopener\" target=\"_blank\" title=\"Log In\">log in</a> or <a href=\"member.php?action=register\" rel=\"nofollow noopener\" target=\"_blank\" title=\"Register\">register</a>.";
$l['simurg_linkgizle_minposts_msj'] = "Insufficient Post Count Warning Message";
$l['simurg_linkgizle_minposts_msj_desc'] = "You can edit the message to be shown to users who do not meet the minimum post count requirement. <strong>Supports HTML.</strong> The <strong>{1}</strong> code displays the required minimum post count to users.";
$l['simurg_linkgizle_minposts_mesaj'] = "You must have at least <strong>{1}</strong> posts to view links.";
$l['simurg_linkgizle_reltag_title'] = "Set Rel Tags";
$l['simurg_linkgizle_reltag_desc'] = "The rel tags below will automatically be added to hidden external links. However, no rel tags are added to non-hidden external links.";
$l['simurg_linkgizle_custom_css_title'] = "Custom CSS";
$l['simurg_linkgizle_custom_css_desc'] = "You can find, edit, or write your own CSS codes for warning messages in this section.";
$l['simurg_lingizle_izinli_alandlari_title'] = "Excluded Domains";
$l['simurg_lingizle_izinli_alandlari_desc'] = "Links from these domains will not be hidden. Enter valid domain names separated by commas (e.g., google.com, mybb.pro). Do not include \"https://\" or \"http://\"; they will be automatically removed. Invalid domains (e.g., domain@.com, domain..com, or those containing spaces or special characters) will not be saved.";
$l['simurg_linkgizle_yetkisiz_grup_msj'] = "Warning Message for Unauthorized User Groups";
$l['simurg_linkgizle_yetkisiz_grup_msj_desc'] = "Enter the warning message to be shown in place of hidden links for users who are not in the permitted user groups.";
$l['simurg_linkgizle_yetkisiz_grup_mesaj'] = "You do not have permission to view links. Please contact <a href=\"showteam.php\" rel=\"nofollow noopener\" target=\"_blank\" title=\"Forum Administrators\">Forum Team</a>.";
$l['simurg_linkgizle_debug'] = "Debug Mode";
$l['simurg_linkgizle_debug_desc'] = "You can enable this setting for debugging purposes. Error logs will be recorded in the <strong>/error.log/</strong> file.";
