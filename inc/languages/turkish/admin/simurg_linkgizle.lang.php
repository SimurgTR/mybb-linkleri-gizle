<?php

/**
 *  MyBB 1.8 Linkleri Gizle Eklentisi v1.0 Dil Dosyası
 *  Language: Turkish
 */


$l['simurg_linkgizle_ad'] = "Linkleri Gizle";
$l['simurg_linkgizle_desc'] = "Forumunuzda ki konu ve gönderilerinizde bulunan dış bağlantıları gizlemenize ve gizlenen linklerin yerine bir uyarı mesajı göstermenizi sağlar.";
$l['simurg_linkgizle_ayarbaslik'] = "Linkleri Gizle Eklenti Ayarları";
$l['simurg_linkgizle_ayarbaslik_desc'] = "Linkleri gizle eklenti ayarlarını bu kısımdan gerçekleştirebilirsiniz.";
$l['simurg_linkgizle_aktifbaslik'] = "Eklenti Aktif Edilsin Mi?";
$l['simurg_linkgizle_aktifbaslik_desc'] = "Eklentinin aktif olup olmayacağını buradan belirleyebilirsiniz.";
$l['simurg_linkgizle_ic_linkleri_gizle_title'] = "İç Linkleri Gizle";
$l['simurg_linkgizle_ic_linkleri_gizle_desc'] = "Bu ayarı <i>Evet</i> olarak seçerseniz, forumunuzun kendi domainine ait iç linkler de harici linkler gibi gizlenir. <i>Hayır</i> seçilirse, sadece harici dış bağlantılar gizlenecektir.";
$l['simurg_linkgizle_grupbaslik'] = "Linkleri Görmesine İzin Verilen Kullanıcı Grupları";
$l['simurg_linkgizle_grupbaslik_desc'] = "Bu kısımda gizlenen linkleri koşullar ne olursa olsun görüntüleyebilecek kullanıcı gruplarını seçebilirsiniz. <strong>Varsayılan Olarak:</strong> <i>Kayıtlı Üye, Yöneticiler, Moderatörler, Süper Moderatörler</i> seçilidir.";
$l['simurg_linkgizle_haricforumlar'] = "Hariç Tutulacak Forumlar";
$l['simurg_linkgizle_haricforumlar_desc'] = "Linklerin gizlenmesini istemediğiniz forumları aşağıdan seçebilirsiniz.Burada seçilen forumlarda harici bağlantılı linkler gizlenmeyecektir. <i>Birden fazla seçim için <strong>CTRL</strong> tuşuna basılı tutarak seçim yapabilirsiniz.</i>";
$l['simurg_linkgizle_minposts'] = "Linkleri Görebilmek İçin Gereken Min. Gönderi Sayısı";
$l['simurg_linkgizle_minposts_desc'] = "Gizlenen linkleri görebilmek için gerekli olan minimum gönderi sayısını belirtin. Varsayılan değer <i>15</i> olarak ayarlanmıştır. Bu değerin altında gönderi sayısına sahip kullanıcılar harici linkleri ve eğer iç linkleri gizle özelliği aktif edilmiş ise linkleri göremezler.";
$l['simurg_linkgizle_ziyaretcimsj'] = "Ziyaretçilere Gösterilecek Mesaj";
$l['simurg_linkgizle_ziyaretcimsj_desc'] = "Forumda oturum açmamış, ziyaretçi durumunda olan kullanıcılara harici linkler gizlendiğinde gösterilecek olan mesajı aşağıdan düzenleyebilirsiniz. <strong>HTML Desteklemektedir.</strong>";
$l['simurg_linkgizle_zmesaj'] = "Linkleri görebilmek için <a href=\"member.php?action=login\" rel=\"nofollow noopener\" target=\"_blank\" title=\"Giriş Yap\">giriş yapın</a>veya<a href=\"member.php?action=register\" rel=\"nofollow noopener\" target=\"_blank\" title=\"Kayıt Ol\">kayıt olun</a>.";
$l['simurg_linkgizle_minposts_msj'] = "Yetersiz Min Gönderi Sayısı Uyarı Mesajı";
$l['simurg_linkgizle_minposts_msj_desc'] = "Minimum gönderi sayısını karşılamayan kullanıcılara göstermek istediğiniz mesajı aşağıdan düzenleyebilirsiniz. <strong>HTML Desteklemektedir.</strong> <strong>{1}</strong> kodu kullanıcılara gereken min. gönderi sayısını göstermenizi sağlar. ";
$l['simurg_linkgizle_minposts_mesaj'] = "Linkleri görebilmek için en az <strong>{1}</strong>gönderi sayısına sahip olmalısınız.";
$l['simurg_linkgizle_reltag_title'] = "Rel Etiketlerini Ayarla";
$l['simurg_linkgizle_reltag_desc'] = "Gizlenmiş olan harici bağlantılara otomatik olarak aşağıda ki rel etiketleri eklenecektir. Ancak, gizlenmemiş harici bağlantılara herhangi bir rel etiketi eklenmemektedir.";
$l['simurg_linkgizle_custom_css_title'] = "Özel CSS";
$l['simurg_linkgizle_custom_css_desc'] = "Bu kısımdan uyarı mesajları için kullanabileceğiniz CSS kodlarını bulabilir, düzenleyebilir veya kendinize özel CSS kodlarınızı buraya yazabilirsiniz.";
$l['simurg_lingizle_izinli_alandlari_title'] = "Muaf Tutulacak Alan Adları";
$l['simurg_lingizle_izinli_alandlari_desc'] = "Bu domainlere sahip linkler gizlenmeyecek. Sadece geçerli domain adlarını virgülle ayırarak girin (örneğin: google.com, mybb.pro). \"https://\" veya \"http://\" eklemeyin; otomatik olarak kaldırılır. Geçersiz domainler (örneğin, alanadi@.com, alanadi..com gibi boşluk içeren veya özel karakterli) kaydedilmez.";
$l['simurg_linkgizle_yetkisiz_grup_msj'] = "Yetkisiz Kullanıcı Grubunda Olanlar İçin Uyarı Mesajı";
$l['simurg_linkgizle_yetkisiz_grup_msj_desc'] = "İzin verilen kullanıcı grubunda olmayan kullanıcılar için gizlenen linkler yerine gösterilecek uyarı mesajını bu alana giriniz.";
$l['simurg_linkgizle_yetkisiz_grup_mesaj'] = "Linkleri görebilmek için yetkiniz yok. Lütfen,<a href=\"showteam.php\" rel=\"nofollow noopener\" target=\"_blank\" title=\"Forum Yöneticileri\">Forum Yönetimi</a> ile iletişime geçin.";
$l['simurg_linkgizle_debug'] = "Hata Ayıklama (Debug) Modu";
$l['simurg_linkgizle_debug_desc'] = "Hata ayıklama yapabilmek için bu ayarı aktif edebilirsiniz. Hata kayıtları <strong>/error.log/</strong> dosyasına kayıt edilir.";
